<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Textarea;

use Filament\Forms\Components\Card;
use App\Filament\Resources\SeoResource\Pages;
use App\Models\Seo;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class SeoResource extends Resource
{
    protected static ?string $model = Seo::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'SEO';

    protected static ?string $navigationGroup = 'сео оптимизация';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('page_id')
                        ->relationship('page', 'title')
                        ->label('мета заголовок.'),
                    TextInput::make('meta_title')
                        ->columnSpanFull()
                        ->maxLength(50)
                        ->label('мета описание.')
                        ->helperText('Ограничение в 50 символов.'),
                    TextInput::make('meta_description')
                        ->maxLength(150)
                        ->helperText('Ограничение в 150 символов.')
                        ->columnSpanFull(),
                    Textarea::make('meta_keywords')
                        ->label('мета ключевые слова.')
                        ->columnSpanFull(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page.title')
                    ->label('страница'),
                TextColumn::make('meta_title')
                    ->label('мета заголовок.'),
                TextColumn::make('meta_description')
                    ->label('мета описание.'),
                TextColumn::make('meta_keywords')
                    ->label('мета ключевые слова.'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeos::route('/'),
            'create' => Pages\CreateSeo::route('/create'),
            'edit' => Pages\EditSeo::route('/{record}/edit'),
        ];
    }
}
