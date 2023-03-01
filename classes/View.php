<?php

/**
 * The views.
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Feedview
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2014 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @version   SVN: $Id$
 * @link      http://3-magi.net/?CMSimple_XH/Feedview_XH
 */

namespace Feedview;

/**
 * The views.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class View
{
    /**
     * The path of the template file.
     *
     * @var string
     */
    protected $template;

    /**
     * The data.
     *
     * @var array<string, *>
     */
    protected $data;

    /**
     * Makes a new view object.
     *
     * @param string $template A template name.
     * @param array  $data     An array of data.
     *
     * @return View
     */
    public static function make($template, $data)
    {
        return new self($template, $data);
    }

    /**
     * Initializes a new instance.
     *
     * @param string $template A template name.
     * @param array  $data     An array of data.
     *
     * @global array The paths of system files and folders.
     */
    protected function __construct($template, $data)
    {
        global $pth, $cf;

        $this->template = $pth['folder']['plugins'] . 'feedview/views/'
            . $template . '.php';
        $this->data = $data;
    }

    /**
     * Renders the template.
     *
     * @return string (X)HTML.
     *
     * @global array The configuration of the core.
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
     * Reports the missing template.
     *
     * @return string (X)HTML.
     *
     * @global array The localization of the plugins.
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
     * Renders the template.
     *
     * @return string XHTML.
     */
    protected function doRender()
    {
        extract($this->data);
        ob_start();
        include $this->template;
        return ob_get_clean();
    }

    /**
     * Dummy to prevent direct access of template files.
     *
     * @return void
     */
    protected function preventAccess()
    {
        // pass
    }
}
