<?php

/**
 * The domain layer.
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
 * The feeds.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class Feedview_Feed
{
    /**
     * The feed title.
     *
     * @var string
     */
    private $_title;

    /**
     * The feed link.
     *
     * @var string
     */
    private $_link;

    /**
     * The feed items.
     *
     * @var array
     */
    private $_items;

    /**
     * Initializes a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_items = array();
    }

    /**
     * Returns the feed title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Sets the feed title.
     *
     * @param string $title A feed title.
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->_title = (string) $title;
    }

    /**
     * Returns the feed link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->_link;
    }

    /**
     * Sets the feed link.
     *
     * @param string $link A feed link.
     *
     * @return void
     */
    public function setLink($link)
    {
        $this->_link = (string) $link;
    }

    /**
     * Returns the feed items.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * Adds a feed item.
     *
     * @param Feedview_Item $item A feed item.
     *
     * @return void
     */
    public function addItem(Feedview_Item $item)
    {
        $this->_items[] = $item;
    }
}

/**
 * The feed items.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class Feedview_Item
{
    /**
     * The item title.
     *
     * @var string
     */
    private $_title;

    /**
     * The item link.
     *
     * @var string
     */
    private $_link;

    /**
     * The item description.
     *
     * @var string
     */
    private $_description;

    /**
     * Returns the item title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Sets the item title.
     *
     * @param string $title An item title.
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->_title = (string) $title;
    }

    /**
     * Returns the item link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->_link;
    }

    /**
     * Sets the item link.
     *
     * @param string $link An item link.
     *
     * @return void
     */
    public function setLink($link)
    {
        $this->_link = (string) $link;
    }

    /**
     * Returns the item description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Sets the item description.
     *
     * @param string $description An item description.
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->_description = (string) $description;
    }
}

?>
