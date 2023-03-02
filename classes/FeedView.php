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
use Feedview\Value\Feed;

class FeedView
{
    /** @var array<string,string> */
    private $conf;

    /** @var array<string,string> */
    private $text;

    /** @var FeedReader */
    private $feedReader;

    /** @var View */
    private $view;

    /**
     * @param array<string,string> $conf
     * @param array<string,string> $text
     */
    public function __construct(array $conf, array $text, FeedReader $feedReader, View $view)
    {
        $this->conf = $conf;
        $this->text = $text;
        $this->feedReader = $feedReader;
        $this->view = $view;
    }

    /**
     * @param string $filename
     * @param string $template
     * @return string
     */
    public function __invoke($filename, $template)
    {
        global $pth;

        $cache = $this->conf['cache_enabled'] ? $pth['folder']['plugins'] . 'feedview/cache/' : null;
        if (!$this->feedReader->init($filename, $cache)) {
            return $this->view->error("error_read_feed", $filename);
        }
        $feed = $this->feedReader->read((int) $this->conf["default_items"]);
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
                "date" => date($this->text["format_date"], $item->timestamp()),
            ];
        }
        return $items;
    }
}
