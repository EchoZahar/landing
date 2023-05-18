<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\RelationManagers\NavigationsRelationManager;
use Filament\Forms\Components\Card;
use App\Models\Page;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers\ContactFormsRelationManager;
use App\Filament\Resources\PageResource\RelationManagers\SeoRelationManager;
use Filament\Forms\Components\Textarea;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationGroup = 'Страницы';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'Секция страниц';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('title')
                        ->label('наименование страницы')
                        ->columnSpanFull(),
                    FileUpload::make('logotype')
                        ->label('логотип')
                        ->columnSpanFull(),
                    Textarea::make('description')
                        ->label('описание')
                        ->maxLength(100)
                        ->columnSpanFull(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logotype')
                    ->circular(),
                TextColumn::make('title'),
                TextColumn::make('description'),
                TextColumn::make('creator.name'),
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
            SeoRelationManager::class,
            NavigationsRelationManager::class,
            ContactFormsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'     => Pages\ListPages::route('/'),
            'create'    => Pages\CreatePage::route('/create'),
            'edit'      => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
