<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestProducts extends BaseWidget
{
    protected static bool $isLazy = true;
    protected static ?string $heading = 'Produk Terbaru';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            // Optimasi Query: Pilih hanya kolom yang dibutuhkan
            ->query(
                Product::query()
                    ->select('id', 'image', 'nama_produk', 'created_at')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->size(60)
                    ->circular()
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->getStateUsing(fn ($record) => $record->image ? asset('storage/' . $record->image) : null),

                TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->color('gray'),
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Lihat & Edit')
                    ->url(fn (Product $record): string => ProductResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-o-pencil-square'),
            ]);
    }
}
