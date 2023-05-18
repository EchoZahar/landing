<?php

namespace App\Filament\Resources\NavigationResource\RelationManagers;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Closure;
use App\Models\Navigation;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CardsRelationManager extends RelationManager
{
    protected static string $relationship = 'cards';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255)->columnSpanFull()->required(),
                TextInput::make('email')->required()->email()->columnSpanFull()->required(),
                Select::make('navigation_id')->relationship('navigation', 'name')->required(),
                FileUpload::make('icon'),
                TextInput::make('full_text')->reactive()->afterStateUpdated(function (Closure $set, $state) {
                    $set('short_text', Str::limit($state, 57));
                })->columnSpanFull()->required(),
                TextInput::make('short_text')->maxLength(60)->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('short_text'),
                TextColumn::make('created_at'),
                TextColumn::make('author.name'),
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
