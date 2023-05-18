<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use Closure;
use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use Pages\EditNavigation;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class NavigationsRelationManager extends RelationManager
{
    protected static string $relationship = 'navigations';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('page_id')
                    ->relationship('page', 'title')
                    // ->options(Page::select('id', 'title')->get()->pluck('title', 'id'))
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(60)->reactive()->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state, '_'));
                    }),
                TextInput::make('slug'),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->maxLength(120),
                FileUpload::make('icon')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')->label('иконка'),
                TextColumn::make('name')->label('наименование'),
                TextColumn::make('description')->label('описсание'),
                TextColumn::make('author.name')->label('автор'),
                TextColumn::make('created_at')->label('дата'),
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

    // public static function getPages(): array
    // {
    //     return [
    //         // 'index' => Pages\ListNavigations::route('/'),
    //         // 'create' => Pages\CreateNavigation::route('/create'),
    //         'edit' => EditNavigation::route('/{record}/edit'),
    //     ];
    // }
}
