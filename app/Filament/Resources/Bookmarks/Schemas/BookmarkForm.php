<?php

namespace App\Filament\Resources\Bookmarks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookmarkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title'),
                TextInput::make('url')
                    ->url()
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
            ]);
    }
}
