<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ReorderAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BannerResource extends Resource
{
    protected static ?string $navigationLabel = 'Banner';

    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $pluralModelLabel = 'Banner';
    protected static ?int $navigationSort = 2; // Urutkan menu di sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Menggunakan Grid untuk layout 2 kolom
                Grid::make(3)
                    ->schema([
                        // Kolom utama untuk konten
                        Section::make('Konten Utama')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Judul Banner'),

                                TextInput::make('url')
                                    ->label('URL (Link)')
                                    ->url()
                                    ->nullable()
                                    ->placeholder('https://contoh.com/produk/promo')
                                    ->helperText('Biarkan kosong jika banner tidak memiliki link.'),

                                FileUpload::make('image_path')
                                    ->required()
                                    ->image()
                                    ->imageEditor() // Tambahkan image editor bawaan Filament
                                    ->imagePreviewHeight('150')
                                    ->disk('public')
                                    ->directory('banners')
                                    ->label('Gambar Banner')
                                    ->helperText('Rekomendasi ukuran: 1200x400 pixels.'),
                            ])
                            ->columnSpan(2), // Kolom ini mengambil 2 dari 3 slot grid

                        // Sidebar untuk pengaturan
                        Section::make('Pengaturan')
                            ->schema([
                                Toggle::make('is_active')
                                    ->required()
                                    ->default(true)
                                    ->label('Aktifkan Banner')
                                    ->helperText('Hanya banner yang aktif akan ditampilkan.'),

                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Urutan Tampilan')
                                    ->helperText('Angka lebih kecil akan ditampilkan lebih dulu.'),
                            ])
                            ->columnSpan(1), // Kolom ini mengambil 1 dari 3 slot grid
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menggunakan ToggleColumn agar status bisa diubah langsung dari tabel
                ToggleColumn::make('is_active')
                    ->label('Status Aktif'),

                ImageColumn::make('image_path')
                    ->disk('public')
                    ->label('Gambar')
                    ->height(80)
                    ->width(120) // Lebar lebih besar cocok untuk banner
                    ->rounded('md'), // Sedikit lengkungan di sudut

                TextColumn::make('title')
                    ->searchable()
                    ->label('Judul Banner')
                    // Menampilkan URL di bawah judul untuk informasi tambahan
                    ->description(fn (Banner $record): string => $record->url ? 'Link: ' . $record->url : 'Tanpa Link'),

                TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Urutan')
                    // Sembunyikan secara default untuk tampilan lebih bersih, bisa dimunculkan
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Dibuat Pada')
                    // Sembunyikan secara default
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc') // Urutkan berdasarkan sort_order menaik
            ->reorderable('sort_order') // Aktifkan fitur drag-and-drop untuk mengubah urutan
            ->filters([
                // Filter canggih untuk status aktif/tidak aktif
                TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif')
                    ->native(false),
            ])
            ->actions([
                // Mengelompokkan action agar lebih rapi
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
