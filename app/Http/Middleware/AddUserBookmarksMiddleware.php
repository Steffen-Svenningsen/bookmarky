<?php

namespace App\Http\Middleware;

use App\Filament\Resources\Bookmarks\BookmarkResource;
use Closure;
use Filament\Navigation\NavigationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AddUserBookmarksMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return $next($request);
        }

        if (! filament()->getCurrentPanel()) {
            return $next($request);
        }

        $itemsList = [];

        $bookmarks = Auth::user()->bookmarks;

        foreach ($bookmarks as $bookmark) {
            $itemsList[] = NavigationItem::make($bookmark->title)
                ->icon('heroicon-o-bookmark')
                ->group('My Bookmarks')
                ->url(BookmarkResource::getUrl('view', ['record' => $bookmark]));
        }

        filament()->getCurrentPanel()
            ->navigationItems($itemsList);

        return $next($request);
    }
}
