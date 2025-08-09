<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\video;
use App\Models\Produk;
use App\Models\Wisata;
use App\Models\Gallery;
use App\Models\Layanan;
use App\Models\Penduduk;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AllStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', Post::count())
                ->description('Semua layanan yang tersedia')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('secondary'),

            Stat::make('Total Produk', Produk::count())
                ->description('Semua produk yang tersedia')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),

            Stat::make('Total Layanan', Layanan::count())
                ->description('Semua layanan yang tersedia')
                ->descriptionIcon('heroicon-m-document')
                ->color('info'),

            Stat::make('Total Galeri', Gallery::count())
                ->description('Semua galeri yang tersedia')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning'),

            Stat::make('Total Video', video::count())
                ->description('Semua video yang tersedia')
                ->descriptionIcon('heroicon-m-camera')
                ->color('primary'),

            Stat::make('Total Wisata', Wisata::count())
                ->description('Semua wisata yang tersedia')
                ->descriptionIcon('heroicon-m-map')
                ->color('danger'),
        ];
    }
}
