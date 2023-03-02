<?php

/**
 * Copyright 2023 Christoph M. Becker
 *
 * This file is part of Feedview_XH.
 *
 * Feedview_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Feedview_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Feedview_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Feedview\Infra;

use Feedview\Value\Feed;

class FakeFeedReader extends FeedReader
{
    public function init(string $url, ?string $cache): bool
    {
        return true;
    }

    public function read(int $itemCount): Feed
    {
        return new Feed(
            "The best Newsfeed!",
            "http://example.com/feed",
            "The most recent news are available only here.",
            []
        );
    }
}
