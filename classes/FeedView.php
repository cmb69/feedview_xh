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

use Feedview\Infra\View;
use Feedview\Value\Feed;
use Feedview\Value\FeedItem;
use SimplePie;

class FeedView
{
    /** @var array<string,string> */
    private $conf;

    /** @var array<string,string> */
    private $text;

    /** @var SimplePie */
    private $simplePie;

    /** @var View */
    private $view;

    /**
     * @param array<string,string> $conf
     * @param array<string,string> $text
     */
    public function __construct(array $conf, array $text, SimplePie $simplePie, View $view)
    {
        $this->conf = $conf;
        $this->text = $text;
        $this->simplePie = $simplePie;
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

        if ($this->conf['cache_enabled']) {
            $this->simplePie->set_cache_location(
                $pth['folder']['plugins'] . 'feedview/cache/'
            );
        } else {
            $this->simplePie->enable_cache(false);
        }
        $this->simplePie->set_feed_url($filename);
        if (!$this->simplePie->init()) {
            return $this->view->error("error_read_feed", $filename);
        }
        $view = $this->view;
        return $view->render($template, [
            "feed" => $this->feed(),
            "ptx" => $this->text,
        ]);
    }

    /** @return Feed */
    private function feed(): Feed
    {
        $items = [];
        foreach ($this->simplePie->get_items(0, (int) $this->conf["default_items"]) as $item) {
            $items[] = new FeedItem(
                $item->get_title(),
                $item->get_permalink(),
                $item->get_description(),
                $item->get_date($this->text["format_date"])
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
