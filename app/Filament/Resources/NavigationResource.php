<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavigationResource\RelationManagers\CardsRelationManager;
use Filament\Tables\Columns\TextColumn;
use App\Models\Page;
use App\Filament\Resources\NavigationResource\Pages;
use App\Models\Navigation;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NavigationResource extends Resource
{
    protected static ?string $model = Navigation::class;

    protected static ?string $navigationGroup = 'Навигация страниц - меню';

    // protected static ?string $navigationIcon = '';

    protected static ?string $navigationLabel = 'Секция навигации для страниц';

    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('page_id')
                        ->relationship('page', 'title')
                        ->required(),
                    TextInput::make('name')->required(),
                    Textarea::make('description'),
                    FileUpload::make('icon')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page.title')->label('заголовок страницы'),
                ImageColumn::make('icon')
                    ->label('иконка')
                    ->circular(),
                TextColumn::make('name')
                    ->label('наименование меню'),
                TextColumn::make('author.name')
                    ->label('автор')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CardsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNavigations::route('/'),
            'create' => Pages\CreateNavigation::route('/create'),
            'edit' => Pages\EditNavigation::route('/{record}/edit'),
        ];
    }
}
