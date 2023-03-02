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

class FakeFeedReader extends FeedReader
{
    public function __construct($options = [])
    {
        $this->simplePie = new FakeSimplePie($options);
    }
}

class FakeSimplePie
{
    private $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    public function set_cache_location($location) {}

    public function enable_cache($enable) {}

    public function set_feed_url($url) {}

    public function init()
    {
        return $this->options["init"] ?? true;
    }

    public function get_title()
    {
        return "The best Newsfeed!";
    }

    public function get_permalink()
    {
        return "http://example.com/feed";
    }

    public function get_description()
    {
        return "The most recent news are available only here.";
    }

    public function get_items($start, $end)
    {
        return [
            new FakeSimplePieItem(
                "Breaking News",
                "http://example.com/feed/breaking-news",
                "Something awesome happened just now!",
                1677761028
            ),
        ];
    }
}

class FakeSimplePieItem
{
    /** @var string */
    private $title;

    /** @var string */
    private $permalink;

    /** @var string */
    private $description;

    /** @var int */
    private $date;

    public function __construct(string $title, string $permalink, string $description, int $date)
    {
        $this->title = $title;
        $this->permalink = $permalink;
        $this->description = $description;
        $this->date = $date;
    }

    public function get_title()
    {
        return $this->title;
    }

    public function get_permalink()
    {
        return $this->permalink;
    }

    public function get_description()
    {
        return $this->description;
    }

    public function get_date(string $date_format)
    {
        return $this->date;
    }
}
