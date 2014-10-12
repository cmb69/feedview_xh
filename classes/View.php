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

/**
 * The views.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class Feedview_View
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
     * Whether HTML shall be generated (opposed to XHTML).
     *
     * @var bool
     */
    protected $isHtml;

    /**
     * Makes a new view object.
     *
     * @param string $template A template name.
     * @param array  $data     An array of data.
     *
     * @return Feedview_View
     */
    static public function make($template, $data)
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
     * @global array The configuration of the plugins.
     */
    protected function __construct($template, $data)
    {
        global $pth, $cf;

        $this->template = $pth['folder']['plugins'] . 'feedview/views/'
            . $template . '.php';
        $this->data = $data;
        $this->isHtml = !$cf['xhtml']['endtags'];
    }

    /**
     * Renders the template.
     *
     * @return string (X)HTML.
     */
    public function render()
    {
        extract($this->data);
        ob_start();
        include $this->template;
        $html = ob_get_clean();
        if ($this->isHtml) {
            $html = str_replace(' />', '>', $html);
        }
        return $html;
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

?>
