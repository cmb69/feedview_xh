<?php

/**
 * The data source layer.
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
 * The feed readers.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class Feedview_Reader
{
    /**
     * Initializes a new instance.
     *
     * @param string $filename A feed filename.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->_filename = (string) $filename;
    }

    /**
     * Reads a feed.
     *
     * @return Feedview_Feed
     */
    public function read()
    {
        $result = new Feedview_Feed();
        $feed = simplexml_load_file($this->_filename);
        $result->setTitle($feed->channel->title);
        $result->setLink($feed->channel->link);
        foreach ($feed->channel->children() as $child) {
            if ($child->getName() == 'item') {
                $item = new Feedview_Item();
                $item->setTitle($child->title);
                $item->setLink($child->link);
                $item->setDescription($child->description);
                $result->addItem($item);
            }
        }
        return $result;
    }
}

?>
