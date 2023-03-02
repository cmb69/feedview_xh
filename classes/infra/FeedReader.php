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
use Feedview\Value\FeedItem;
use SimplePie\SimplePie;

class FeedReader
{
    /** @var SimplePie|null */
    protected $simplePie = null;

    /** @codeCoverageIgnore */
    public function __construct()
    {
        $this->simplePie = new SimplePie;
    }

    public function init(string $url, ?string $cache, int $cacheDuration): bool
    {
        if ($cache !== null) {
            $this->simplePie->set_cache_location($cache);
        } else {
            $this->simplePie->enable_cache(false);
        }
        $this->simplePie->set_cache_duration($cacheDuration);
        $this->simplePie->set_feed_url($url);
        return $this->simplePie->init();
    }

    public function read(int $itemCount): Feed
    {
        assert($this->simplePie !== null);
        $items = [];
        foreach ($this->simplePie->get_items(0, $itemCount) as $item) {
            $items[] = new FeedItem(
                $item->get_title(),
                $item->get_permalink(),
                $item->get_description(),
                $item->get_date("U")
            );
        }
        return new Feed(
            $this->simplePie->get_title(),
            $this->simplePie->get_permalink(),
            $this->simplePie->get_description(),
            $items
        );
    }
}
