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

namespace Feedview\Infra;

class View
{
    /** @var string */
    private $folder;

    /** @var array<string,string> */
    private $text;

    /** @param array<string,string> $text */
    public function __construct(string $folder, array $text)
    {
        $this->folder = $folder;
        $this->text = $text;
    }

    /** @param scalar $args */
    public function text(string $key, ...$args): string
    {
        return sprintf($this->text[$key], ...$args);
    }

    /** @param array<string,mixed> $_data */
    public function render(string $_template, array $_data): string
    {
        $_filename = $this->folder . $_template . ".php";
        if (!file_exists($_filename)) {
            return $this->error("message_template_missing", $_filename);
        }
        extract($_data);
        ob_start();
        include $_filename;
        return (string) ob_get_clean();
    }

    /** @param array<scalar> $args */
    public function error(string $key, ...$args): string
    {
        return XH_message("fail", $this->text[$key], ...$args);
    }
}
