<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $pluralModelLabel = 'Produk';

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag'; // Icon yang lebih relevan

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Menggunakan layout grid untuk membagi form menjadi 2 bagian
                Grid::make(3)->schema([
                    // Bagian kiri untuk detail utama produk (lebih lebar)
                    Section::make('Detail Produk')
                        ->schema([
                            TextInput::make('nama_produk')
                                ->label('Nama Produk')
                                ->required()
                                ->maxLength(255)
                                ->autofocus(),

                            RichEditor::make('deskripsi')
                                ->required()
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsDirectory('attachments')
                                ->columnSpanFull(), // Rich editor memakai lebar penuh
                        ])
                        ->columnSpan(2),

                    // Bagian kanan untuk atribut tambahan dan gambar
                    Section::make('Atribut & Gambar')
                        ->schema([
                            TextInput::make('no_whatsapp')
                                ->label('Nomor WhatsApp')
                                ->prefix('+62')
                                ->numeric()
                                ->helperText('Contoh: 81234567890 (tanpa 0 di depan)')
                                ->required(),

                            FileUpload::make('image')
                                ->label('Gambar Utama')
                                ->image()
                                ->disk('public')
                                ->directory('images')
                                ->required()
                                ->imageEditor(), // Menambahkan image editor bawaan

                            // Mengelompokkan gambar pendukung
                            Grid::make(2)->schema([
                                FileUpload::make('image2')
                                    ->label('Gambar 2')
                                    ->image()->disk('public')->directory('images'),
                                FileUpload::make('image3')
                                    ->label('Gambar 3')
                                    ->image()->disk('public')->directory('images'),
                                FileUpload::make('image4')
                                    ->label('Gambar 4')
                                    ->image()->disk('public')->directory('images'),
                            ]),

                        ])
                        ->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom gambar utama, ini akan menjadi dasar tumpukan
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->size(60)
                    ->disk('public')
                    ->circular() // Membuat gambar utama bulat
                    ->limit(3) // Tampilkan gambar utama + 2 tumpukan, sisanya jadi angka (+1)
                    ->limitedRemainingText(), // Tampilkan sisa gambar sebagai teks (misal: "+1")

                // Gambar-gambar berikutnya ditambahkan ->stacked() agar menumpuk di belakang gambar utama
                ImageColumn::make('image2')
                    ->stacked()
                    ->disk('public')
                    ->circular(),

                ImageColumn::make('image3')
                    ->stacked()
                    ->disk('public')
                    ->circular(),

                ImageColumn::make('image4')
                    ->stacked()
                    ->disk('public')
                    ->circular(),

                TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Product $record): string => Str::limit(strip_tags($record->deskripsi), 40)),

                TextColumn::make('deskripsi')->hidden(),

                TextColumn::make('no_whatsapp')
                    ->label('WhatsApp')
                    ->searchable()
                    ->icon('heroicon-s-phone')
                    ->prefix('wa.me/+62')
                    ->copyable()
                    ->copyableState(fn (Product $record): string => "62{$record->no_whatsapp}"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
