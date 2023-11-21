<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Filament\Resources\PlaceResource\RelationManagers;
use App\Models\Place;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static ?string $navigationIcon = 'heroicon-o-location-marker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('File')
                ->relationship('file')
                ->saveRelationshipsWhenHidden()
                ->schema([
                    Forms\Components\Hidden::make('file_id'),
                    Forms\Components\FileUpload::make('filepath') 
                        ->required()
                        ->image()
                        ->maxSize(2048)
                        ->directory('uploads')
                        ->getUploadedFileNameForStorageUsing(function (\Illuminate\Http\UploadedFile $file): string {
                            return time() . '_' . $file->getClientOriginalName();
                        }),
                ]),
            Forms\Components\Fieldset::make('Place')
                ->schema([
                    Forms\Components\Select::make('author_id')
                        ->label('Author')
                        ->options(\App\Models\User::pluck('name', 'id')->all())
                        ->default(auth()->id()) 
                        ->required(),
                    Forms\Components\Hidden::make('file_id'),
                    // Camps recurs Post / Place...
                    Forms\Components\RichEditor::make('name')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->required(),
                // Forms\Components\TextInput::make('file_id')
                //     ->required(),
                Forms\Components\TextInput::make('latitude')
                    ->required(),
                Forms\Components\TextInput::make('longitude')
                    ->required(),
                // Forms\Components\TextInput::make('author_id')
                //     ->required(),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('file_id'),
                Tables\Columns\TextColumn::make('latitude'),
                Tables\Columns\TextColumn::make('longitude'),
                Tables\Columns\TextColumn::make('author_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }    
}
