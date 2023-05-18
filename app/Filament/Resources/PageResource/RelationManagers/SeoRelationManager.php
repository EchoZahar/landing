<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class SeoRelationManager extends RelationManager
{
    protected static string $relationship = 'seo';

    protected static ?string $recordTitleAttribute = 'meta_title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('meta_title')
                    ->label('мета заголовок.')
                    ->columnSpanFull()
                    ->maxLength(50)
                    ->helperText('Ограничение в 50 символов.'),
                TextInput::make('meta_description')
                    ->maxLength(150)
                    ->label('мета описание.')
                    ->helperText('Ограничение в 150 символов.')
                    ->columnSpanFull(),
                Textarea::make('meta_keywords')
                    ->label('мета ключевые слова.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
