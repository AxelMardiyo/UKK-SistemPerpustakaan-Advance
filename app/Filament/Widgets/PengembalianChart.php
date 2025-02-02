<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;


class PengembalianChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Pengembalian per Bulan';
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $data = Trend::model(Transaksi::class)
            ->between(
                start: now()->subMonth(6),
                end: now(),
            )
            ->dateColumn('tgl_pengembalian')
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengembalian',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    // 'backgroundColor' => '#36A2EB',
                    // 'borderColor' => 'danger',
                    'fill' => 'start',
                ]
            ],
                'labels' => $data->map(fn (TrendValue $value) => $value->date),        
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }
}
