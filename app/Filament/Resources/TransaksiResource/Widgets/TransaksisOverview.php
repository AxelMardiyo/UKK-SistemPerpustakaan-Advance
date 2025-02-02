<?php

namespace App\Filament\Resources\TransaksiResource\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TransaksisOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $transaksiData = [10, 20, 50, 30, 60]; // Contoh data sementara

        return [
            Stat::make('Total Transaksi', Transaksi::count())
                ->chart($transaksiData)
                ->color('info'),
            Stat::make('Dikembalikan', Transaksi::where('fp', "1")->count())
                ->color('success')
                ->chart([45, 70, 85, 60, 90]),
            Stat::make('Belum Dikembalikan', Transaksi::where('fp', '0')->count())
                ->color('danger')
                ->chart([60, 55, 72, 80, 68]),
            Stat::make('Approved', Transaksi::where('status_request', 'approved')->count())
                ->color('info')
                ->chart([90, 88, 92, 85, 96]),
            Stat::make('Pending', Transaksi::where('status_request', 'pending')->count())
                ->color('warning')
                ->chart([35, 50, 60, 40, 45]),
            Stat::make('Rejected', Transaksi::where('status_request', 'rejected')->count())
                ->color('danger')
                ->chart([20, 35, 30, 25, 40]),
        ];
    }
}
