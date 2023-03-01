<?php

/**
 * Copyright 2014 Christoph M. Becker
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

class View
{
    /**
     * @var string
     */
    protected $template;

    /**
     * @var array<string, *>
     */
    protected $data;

    /**
     * @param string $template
     * @param array  $data
     * @return View
     */
    public static function make($template, $data)
    {
        return new self($template, $data);
    }

    /**
     * @param string $template
     * @param array  $data
     */
    protected function __construct($template, $data)
    {
        global $pth, $cf;

        $this->template = $pth['folder']['plugins'] . 'feedview/views/'
            . $template . '.php';
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function render()
    {
        global $cf;

        if (!file_exists($this->template)) {
            return $this->reportMissingTemplate();
        }
        $html = $this->doRender();
        if (!$cf['xhtml']['endtags']) {
            $html = str_replace(' />', '>', $html);
        }
        return $html;
    }

    /**
     * @return string
     */
    protected function reportMissingTemplate()
    {
        global $plugin_tx;

        return XH_message(
            'fail',
            $plugin_tx['feedview']['message_template_missing'],
            $this->template
        );
    }

    /**
     * @return string
     */
    protected function doRender()
    {
        extract($this->data);
        ob_start();
        include $this->template;
        return ob_get_clean();
    }

    /**
     * @return void
     */
    protected function preventAccess()
    {
        // pass
    }
}
