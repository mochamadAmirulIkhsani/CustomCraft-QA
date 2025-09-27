<?php

namespace App\Filament\Widgets;

use App\Models\Banner;
use App\Models\Contact;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomCraftStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('Total products in catalog')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([7, 12, 8, 15, 18, 22, 25]),

            Stat::make('Active Banners', Banner::where('is_active', true)->count())
                ->description('Currently active banners')
                ->descriptionIcon('heroicon-m-photo')
                ->color('success')
                ->chart([5, 8, 6, 10, 12, 8, 15]),

            Stat::make('Portfolio Projects', Portfolio::where('is_active', true)->count())
                ->description('Completed projects showcase')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info')
                ->chart([3, 6, 9, 12, 15, 18, 21]),

            Stat::make('New Messages', Contact::unread()->count())
                ->description('Unread contact messages')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning')
                ->chart([2, 4, 6, 3, 8, 5, 10])
                ->url(route('filament.admin.resources.contacts.index')),

            Stat::make('Total Messages', Contact::count())
                ->description('All contact messages')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('gray')
                ->chart([10, 15, 20, 25, 30, 35, 40]),

            Stat::make('System Users', User::count())
                ->description('Total registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([1, 2, 2, 3, 3, 4, 4]),
        ];
    }
}
