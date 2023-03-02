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

namespace Feedview\Value;

class Feed
{
    /** @var string */
    private $title;

    /** @var string */
    private $permalink;

    /** @var string */
    private $description;

    /** @var list<FeedItem> */
    private $items;

    /** @param list<FeedItem> $items */
    public function __construct(string $title, string $permalink, string $description, array $items)
    {
        $this->title = $title;
        $this->permalink = $permalink;
        $this->description = $description;
        $this->items = $items;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function permalink(): string
    {
        return $this->permalink;
    }

    public function description(): string
    {
        return $this->description;
    }

    /** @return list<FeedItem> */
    public function items(): array
    {
        return $this->items;
    }
}
