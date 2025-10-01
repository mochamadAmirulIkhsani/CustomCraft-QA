<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Messages';

    protected static ?string $pluralModelLabel = 'Contact Messages';

    protected static ?string $navigationGroup = 'Communication';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::unread()->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::unread()->exists() ? 'warning' : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Contact Information')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('first_name')
                                ->label('First Name')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('last_name')
                                ->label('Last Name')
                                ->required()
                                ->maxLength(255),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required()
                                ->maxLength(255),

                            TextInput::make('phone')
                                ->label('Phone')
                                ->maxLength(20),
                        ]),

                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('message')
                            ->label('Message')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(2),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_read')
                            ->label('Mark as Read')
                            ->default(false)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $set('read_at', now());
                                } else {
                                    $set('read_at', null);
                                }
                            }),

                        DateTimePicker::make('read_at')
                            ->label('Read At')
                            ->disabled()
                            ->visible(fn (callable $get) => $get('is_read')),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->sortable(),

                TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable()
                    ->description(fn (Contact $record): string => $record->email),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->description(fn (Contact $record): string => $record->created_at->diffForHumans()),

                TextColumn::make('read_at')
                    ->label('Read At')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->trueLabel('Read')
                    ->falseLabel('Unread')
                    ->native(false),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('mark_as_read')
                    ->label('Mark as Read')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Contact $record) => !$record->is_read)
                    ->action(fn (Contact $record) => $record->markAsRead())
                    ->requiresConfirmation(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Mark as Read')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->markAsRead();
                        })
                        ->requiresConfirmation(),
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
            'index' => Pages\ListContacts::route('/'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // Disable create from admin, contacts only from frontend form
    }
}
