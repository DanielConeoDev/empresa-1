<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcategoriaResource\Pages;
use App\Models\Subcategoria;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class SubcategoriaResource extends Resource
{
    protected static ?string $model = Subcategoria::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Etiquetas';
    protected static ?string $modelLabel = 'Subcategoría';
    protected static ?string $pluralModelLabel = 'Subcategorías';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('categoria_id')
                ->label('Categoría')
                ->relationship('categoria', 'nombre')
                ->required()
                ->searchable(),

            TextInput::make('nombre')
                ->label('Nombre de la subcategoría')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

            TextInput::make('slug')
                ->label('Slug')
                ->disabled()
                ->dehydrated()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('categoria.nombre')
                ->label('Categoría')
                ->sortable()
                ->searchable(),

            TextColumn::make('nombre')
                ->label('Subcategoría')
                ->sortable()
                ->searchable(),

            TextColumn::make('slug')
                ->label('Slug'),

            TextColumn::make('created_at')
                ->label('Creado')
                ->dateTime(),
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // Aquí puedes registrar RelationManagers si deseas mostrar sub-relaciones.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubcategorias::route('/'),
            'create' => Pages\CreateSubcategoria::route('/create'),
            'edit' => Pages\EditSubcategoria::route('/{record}/edit'),
        ];
    }
}
