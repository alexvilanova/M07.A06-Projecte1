<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

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
                Forms\Components\Fieldset::make('Post')
                    ->schema([
                        Forms\Components\Select::make('author_id')
                            ->label('Author')
                            ->options(\App\Models\User::pluck('name', 'id')->all())
                            ->default(auth()->id()) 
                            ->required(),
                        Forms\Components\Hidden::make('file_id'),
                        // Camps recurs Post / Place...
                        Forms\Components\RichEditor::make('title') 
                            ->required(),
                        Forms\Components\RichEditor::make('description') 
                            ->required(),                       
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('author_id'),
                Tables\Columns\TextColumn::make('file_id'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }    
}
