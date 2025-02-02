<?php

namespace App\Filament\Widgets;

use App\Models\Anggota;
use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Anggota', Anggota::count())
                ->chart([10, 30, 10, 20, 50])
                ->color('success')
                ->description('Jumlah anggota'),
            Stat::make('Request Anggota', Anggota::where('fa', 'T')->count())
                ->chart([40, 20, 30, 10, 20])
                ->color('warning')
                ->description('Requst Anggota'),
            Stat::make('Total Transaksi', Transaksi::count())
                ->chart([20, 50, 10, 50, 60])
                ->color('info')
                ->description('Total Transaksi'),
            
        ];
    }
}
