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

class FeedItem
{
    /** @var string */
    private $title;

    /** @var string */
    private $permalink;

    /** @var string */
    private $description;

    /** @var string */
    private $date;

    public function __construct(string $title, string $permalink, string $description, string $date)
    {
        $this->title = $title;
        $this->permalink = $permalink;
        $this->description = $description;
        $this->date = $date;
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

    public function date(): string
    {
        return $this->date;
    }
}
