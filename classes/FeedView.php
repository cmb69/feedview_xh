<?php

/**
 * Copyright 2014-2023 Christoph M. Becker
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

namespace Feedview;

use Feedview\Infra\FeedReader;
use Feedview\Infra\View;
use Feedview\Logic\Util;
use Feedview\Value\Feed;

class FeedView
{
    /** @var string */
    private $cacheFolder;

    /** @var array<string,string> */
    private $conf;

    /** @var FeedReader */
    private $feedReader;

    /** @var View */
    private $view;

    /** @param array<string,string> $conf */
    public function __construct(string $cacheFolder, array $conf, FeedReader $feedReader, View $view)
    {
        $this->cacheFolder = $cacheFolder;
        $this->conf = $conf;
        $this->feedReader = $feedReader;
        $this->view = $view;
    }

    /** @param scalar $args */
    public function __invoke(string $url, ...$args): string
    {
        $args = Util::parseArgs($args, [(int) $this->conf["default_items"], "feedview"]);
        if ($args === null) {
            return $this->view->error("message_unsupported_args");
        }
        [$count, $template] = $args;
        $cache = $this->conf["cache_enabled"] ? $this->cacheFolder : null;
        if (!$this->feedReader->init($url, $cache, (int) $this->conf["cache_duration"])) {
            return $this->view->error("error_read_feed", $url);
        }
        $feed = $this->feedReader->read($count);
        return $this->view->render($template, [
            "title" => $feed->title(),
            "permalink" => $feed->permalink(),
            "description" => $feed->description(),
            "items" => $this->itemRecords($feed),
        ]);
    }

    /** @return list<array{title:string,permalink:string,description:string,date:string}> */
    private function itemRecords(Feed $feed): array
    {
        $items = [];
        foreach ($feed->items() as $item) {
            $items[] = [
                "title" => $item->title(),
                "permalink" => $item->permalink(),
                "description" => $item->description(),
                "date" => date($this->conf["format_date"], $item->timestamp()),
            ];
        }
        return $items;
    }
}
