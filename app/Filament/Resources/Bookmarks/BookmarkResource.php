<?php

namespace App\Filament\Resources\Bookmarks;

use App\Filament\Resources\Bookmarks\Pages\CreateBookmark;
use App\Filament\Resources\Bookmarks\Pages\EditBookmark;
use App\Filament\Resources\Bookmarks\Pages\ListBookmarks;
use App\Filament\Resources\Bookmarks\Pages\ViewBookmark;
use App\Filament\Resources\Bookmarks\Schemas\BookmarkForm;
use App\Filament\Resources\Bookmarks\Tables\BookmarksTable;
use App\Models\Bookmark;
use BackedEnum;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BookmarkResource extends Resource
{
    protected static ?string $model = Bookmark::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return BookmarkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookmarksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Details')
                    ->inlineLabel()
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Title')
                                    ->columnSpan(2),
                                TextEntry::make('category.name')
                                    ->label('Category')
                                    ->columnSpan(2),
                                TextEntry::make('url')
                                    ->label('URL')
                                    ->url(fn ($record) => $record->url)
                                    ->tooltip('Go to website')
                                    ->badge()
                                    ->columnSpan(1)
                                    ->alignStart(),
                            ]),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookmarks::route('/'),
            'create' => CreateBookmark::route('/create'),
            'edit' => EditBookmark::route('/{record}/edit'),
            'view' => ViewBookmark::route('/{record}'),
        ];
    }
}
