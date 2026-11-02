<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPengguna = Pengguna::count();

        $genderCounts = Pengguna::query()
            ->select('jenis_kelamin')
            ->selectRaw('COUNT(*) AS total')
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');

        $genderBreakdown = collect([
            ['label' => 'Perempuan', 'count' => (int) ($genderCounts['Perempuan'] ?? 0), 'color' => '#7baee3'],
            ['label' => 'Laki-laki', 'count' => (int) ($genderCounts['Laki-laki'] ?? 0), 'color' => '#bd9ae9'],
        ])->map(function (array $item) use ($totalPengguna) {
            $item['percent'] = $totalPengguna > 0 ? ($item['count'] / $totalPengguna) * 100 : 0;

            return $item;
        });

        $interestCounts = Pengguna::query()
            ->select('minat')
            ->selectRaw('COUNT(*) AS total')
            ->groupBy('minat')
            ->orderByDesc('total')
            ->get()
            ->reduce(function (array $counts, Pengguna $row) {
                $label = trim((string) $row->minat) !== '' ? trim($row->minat) : 'Belum diisi';
                $counts[$label] = ($counts[$label] ?? 0) + (int) $row->total;

                return $counts;
            }, []);

        arsort($interestCounts);
        $palette = ['#b8ef72', '#7baee3', '#bd9ae9', '#d69a60', '#e58c80', '#65c6ad', '#d5d76e'];
        $offset = 0.0;
        $colorIndex = 0;
        $interestBreakdown = collect($interestCounts)
            ->map(function (int $count, $label) use ($totalPengguna, $palette, &$offset, &$colorIndex) {
                $label = (string) $label;
                $percent = $totalPengguna > 0 ? ($count / $totalPengguna) * 100 : 0;
                $start = $offset;
                $offset += $percent;
                $color = $palette[$colorIndex % count($palette)];
                $colorIndex++;

                return [
                    'label' => $label,
                    'count' => $count,
                    'percent' => $percent,
                    'color' => $color,
                    'start' => $start,
                    'end' => $offset,
                ];
            })
            ->values();

        $genderOffset = 0.0;
        $genderSegments = $genderBreakdown->map(function (array $item) use (&$genderOffset) {
            $start = $genderOffset;
            $genderOffset += $item['percent'];

            return sprintf('%s %.2f%% %.2f%%', $item['color'], $start, $genderOffset);
        });
        $genderGradient = $totalPengguna > 0
            ? 'conic-gradient(' . $genderSegments->implode(', ') . ')'
            : 'conic-gradient(#30322c 0 100%)';

        $knownInterests = $interestBreakdown->reject(fn (array $item) => $item['label'] === 'Belum diisi');
        $topInterest = $knownInterests->first();
        $latestPengguna = Pengguna::query()
            ->orderByDesc('id_pengguna')
            ->limit(5)
            ->get();

        $interestGradient = $interestBreakdown->isEmpty()
            ? 'conic-gradient(#30322c 0 100%)'
            : 'conic-gradient(' . $interestBreakdown
                ->map(fn (array $item) => sprintf('%s %.2f%% %.2f%%', $item['color'], $item['start'], $item['end']))
                ->implode(', ') . ')';

        $today = now('Asia/Jakarta')->startOfDay();
        $weekStart = $today->copy()->subDays(6);
        $weekEnd = $today->copy()->endOfDay();

        $dailyCounts = Pengguna::query()
            ->selectRaw('DATE(tanggal_daftar) AS tanggal, COUNT(*) AS total')
            ->whereBetween('tanggal_daftar', [$weekStart->toDateTimeString(), $weekEnd->toDateTimeString()])
            ->groupByRaw('DATE(tanggal_daftar)')
            ->pluck('total', 'tanggal');

        $registrationDays = collect(range(6, 0))
            ->map(fn (int $daysAgo) => $today->copy()->subDays($daysAgo))
            ->map(function ($date) use ($dailyCounts) {
                $key = $date->toDateString();

                return [
                    'date' => $key,
                    'label' => $date->format('d/m'),
                    'count' => (int) ($dailyCounts[$key] ?? 0),
                ];
            })
            ->values();

        $registrationTotal = $registrationDays->sum('count');
        $dailyMaximum = (int) $registrationDays->max('count');
        $chartScaleMax = max(4, (int) (ceil($dailyMaximum / 4) * 4));
        $chartPoints = $registrationDays->map(function (array $day, int $index) use ($chartScaleMax) {
            $x = (int) round($index * 700 / 6);
            $y = round(160 - (($day['count'] / $chartScaleMax) * 140), 2);

            return [
                'x' => $x,
                'y' => $y,
                'label' => $day['label'],
                'count' => $day['count'],
            ];
        });

        $chartLinePath = $chartPoints
            ->map(fn (array $point, int $index) => ($index === 0 ? 'M ' : 'L ') . $point['x'] . ' ' . $point['y'])
            ->implode(' ');
        $chartAreaPath = $chartLinePath . ' L 700 180 L 0 180 Z';
        $chartYLabels = [
            $chartScaleMax,
            (int) round($chartScaleMax * 0.75),
            (int) round($chartScaleMax * 0.5),
            (int) round($chartScaleMax * 0.25),
            0,
        ];

        return view('admin.dashboard', [
            'totalPengguna' => $totalPengguna,
            'genderBreakdown' => $genderBreakdown,
            'genderGradient' => $genderGradient,
            'interestBreakdown' => $interestBreakdown,
            'interestGradient' => $interestGradient,
            'topInterest' => $topInterest,
            'topInterestPercent' => $topInterest && $totalPengguna > 0
                ? ($topInterest['count'] / $totalPengguna) * 100
                : 0,
            'registrationDays' => $registrationDays,
            'registrationTotal' => $registrationTotal,
            'chartPoints' => $chartPoints,
            'chartLinePath' => $chartLinePath,
            'chartAreaPath' => $chartAreaPath,
            'chartYLabels' => $chartYLabels,
            'latestPengguna' => $latestPengguna,
        ]);
    }
}