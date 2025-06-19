<?php

namespace App\Filament\Widgets;

use App\Models\Banner;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache; // <-- Tambahkan ini

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        // Cache statistik selama 10 menit
        $productCount = Cache::remember('stats_total_products', 600, fn () => Product::count());
        $bannerCount = Cache::remember('stats_total_banners', 600, fn () => Banner::count());
        $activeBannerCount = Cache::remember('stats_active_banners', 600, fn () => Banner::where('is_active', true)->count());

        return [
            Stat::make('Total Produk', $productCount)
                ->description('Jumlah semua produk yang terdaftar')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),

            Stat::make('Total Banner', $bannerCount)
                ->description('Jumlah semua banner yang tersedia')
                ->color('info')
                ->icon('heroicon-o-photo'),

            Stat::make('Banner Aktif', $activeBannerCount)
                ->description('Banner yang sedang tampil di website')
                ->color('primary')
                ->icon('heroicon-o-check-badge'),
        ];
    }
}
