<?php

/**
 * The presentation layer.
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
 * The controllers.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class Feedview_Controller
{
    /**
     * Renders a feed.
     *
     * @param string $filename A feed filename.
     *
     * @return string (X)HTML.
     */
    public function renderFeed($filename)
    {
        $reader = new Feedview_Reader($filename);
        $feed = $reader->read();
        $result = '<h4><a href="' . $feed->getLink() . '">'
            . $feed->getTitle() . '</a></h4>'
            . '<ul class="feedview_items">';
        foreach ($feed->getItems() as $item) {
            $result .= $this->_renderFeedItem($item);
        }
        $result .= '</ul>';
        return $result;
    }

    /**
     * Renders a feed item.
     *
     * @param Feedview_Item $item A feed item.
     *
     * @return string (X)HTML.
     */
    private function _renderFeedItem(Feedview_Item $item)
    {
        return '<li>'
            . '<a href="' . $item->getLink() . '">' . $item->getTitle() . '</a>'
            . '<div>' . $item->getDescription() . '</div>'
            . '</li>';
    }
}

?>
