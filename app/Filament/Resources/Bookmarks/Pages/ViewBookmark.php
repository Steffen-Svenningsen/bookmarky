<?php

namespace App\Filament\Resources\Bookmarks\Pages;

use App\Filament\Resources\Bookmarks\BookmarkResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBookmark extends ViewRecord
{
    protected static string $resource = BookmarkResource::class;

    public function getTitle(): string
    {
        return $this->record->title;
    }

    public function getBreadcrumbs(): array
    {
        return [
            BookmarkResource::getUrl() => BookmarkResource::getBreadcrumb(),
            $this->record->getKey() => $this->record->title,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
