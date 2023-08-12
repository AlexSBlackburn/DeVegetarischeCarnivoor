<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->autofocus()
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state): void {
                        if ((string) $get('slug') !== Str::slug($old)) {
                            return; // The user has manually changed the slug.
                        }

                        $set('slug', Str::slug($state));
                    }),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('body')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles'
                    ])
                    ->columnSpan(2),

                Forms\Components\Fieldset::make('Recipe details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('cook_time')
                            ->placeholder('15')
                            ->suffix('minutes'),

                        Forms\Components\TextInput::make('servings')
                            ->placeholder('2'),
                    ]),

                Forms\Components\Repeater::make('ingredients')
                    ->addActionLabel('Add ingredient')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->required(),

                        Forms\Components\TextInput::make('unit')
                            ->placeholder('grams'),

                        Forms\Components\TextInput::make('name')
                            ->required(),
                    ])
                    ->columns(3)
                    ->columnSpan(2),

                Forms\Components\Repeater::make('steps')
                    ->addActionLabel('Add step')
                    ->schema([
                        Forms\Components\TextInput::make('description')
                            ->required(),
                    ])
                    ->columns(1)
                    ->columnSpan(2),

                Forms\Components\Repeater::make('notes')
                    ->addActionLabel('Add note')
                    ->schema([
                        Forms\Components\TextInput::make('note')
                            ->prefix('Tip:'),
                    ])
                    ->columns(1)
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
