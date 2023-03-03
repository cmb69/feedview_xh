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

class Url
{
    /** @var string */
    private $page;

    /** @var array<string|array<string>> */
    private $params;

    /** @param array<string|array<string>> $params */
    public function __construct(string $page, array $params)
    {
        $this->page = $page;
        $this->params = $params;
    }

    public function withOffset(int $serial, int $offset): self
    {
        $that = clone $this;
        if ($offset === 0) {
            unset($that->params["feedview_start"][$serial]);
            return $that;
        }
        $that->params["feedview_start"][$serial] = (string) $offset;
        return $that;
    }

    /** @return string|array<string>|null */
    public function param(string $key)
    {
        return $this->params[$key] ?? null;
    }

    public function relative(): string
    {
        $params = http_build_query($this->params, "", "&", PHP_QUERY_RFC3986);
        $params = preg_replace('/=(?=&|$)/', '', $params);
        if ($params !== "") {
            $params = "&" . $params;
        }
        $query = $this->page . $params;
        if ($query !== "") {
            $query = "?" . $query;
        }
        return CMSIMPLE_URL . $query;
    }
}
