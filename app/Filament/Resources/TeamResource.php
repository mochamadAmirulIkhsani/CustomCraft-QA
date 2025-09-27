<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?string $navigationLabel = 'Team Members';
    
    protected static ?string $modelLabel = 'Team Member';
    
    protected static ?string $pluralModelLabel = 'Team Members';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Team Member Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter full name'),
                            
                        Forms\Components\TextInput::make('position')
                            ->label('Position/Role')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Creative Director'),
                            
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->rows(4)
                            ->placeholder('Brief description about team member')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Photo & Settings')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Profile Photo')
                            ->image()
                            ->directory('team')
                            ->imageEditor()
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('300')
                            ->imageResizeTargetHeight('300')
                            ->helperText('Upload square image for best results. Leave empty to use initials.'),
                            
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Only active members will be displayed'),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Social Media Links')
                    ->schema([
                        Forms\Components\Repeater::make('social_links')
                            ->label('Social Media')
                            ->schema([
                                Forms\Components\Select::make('platform')
                                    ->label('Platform')
                                    ->options([
                                        'linkedin' => 'LinkedIn',
                                        'instagram' => 'Instagram',
                                        'twitter' => 'Twitter',
                                        'facebook' => 'Facebook',
                                        'github' => 'GitHub',
                                        'behance' => 'Behance',
                                        'dribbble' => 'Dribbble',
                                    ])
                                    ->required(),
                                    
                                Forms\Components\TextInput::make('url')
                                    ->label('URL')
                                    ->url()
                                    ->placeholder('https://...')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add Social Link')
                            ->reorderable(false)
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(function ($record) {
                        return 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=ffffff&background=7f1d1d';
                    }),
                    
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                    
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->boolean()
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only')
                    ->native(false),
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
            ])
            ->defaultSort('sort_order', 'asc')
            ->poll('60s');
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'view' => Pages\ViewTeam::route('/{record}'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
