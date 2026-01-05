<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GirlResource\Pages;
use App\Filament\Resources\GirlResource\RelationManagers;
use App\Models\Girl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GirlResource extends Resource
{
    protected static ?string $model = Girl::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\RichEditor::make('intro')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Physical Stats')
                    ->schema([
                        Forms\Components\TextInput::make('age'),
                        Forms\Components\TextInput::make('height'),
                        Forms\Components\TextInput::make('dress_size'),
                        Forms\Components\TextInput::make('bust_size'),
                        Forms\Components\TextInput::make('eyes'),
                        Forms\Components\TextInput::make('hair'),
                        Forms\Components\TextInput::make('nationality'),
                    ])->columns(4),

                Forms\Components\Section::make('Services & Tags')
                    ->schema([
                        Forms\Components\TagsInput::make('services')
                            ->placeholder('New service...')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->directory('girls')
                            ->image()
                            ->imageEditor(),
                        Forms\Components\FileUpload::make('gallery_images')
                            ->directory('girls/gallery')
                            ->multiple()
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Schedule')
                    ->schema([
                        Forms\Components\CheckboxList::make('availability')
                            ->options([
                                'Monday' => 'Monday',
                                'Tuesday' => 'Tuesday',
                                'Wednesday' => 'Wednesday',
                                'Thursday' => 'Thursday',
                                'Friday' => 'Friday',
                                'Saturday' => 'Saturday',
                                'Sunday' => 'Sunday',
                            ])
                            ->columns(4)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('hair')
                    ->options(Girl::whereNotNull('hair')->pluck('hair', 'hair')->unique()->toArray()),
                Tables\Filters\SelectFilter::make('nationality')
                    ->options(Girl::whereNotNull('nationality')->pluck('nationality', 'nationality')->unique()->toArray()),
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGirls::route('/'),
        ];
    }
}
