<?php


namespace OpenEMR\Admin\Event;

use Symfony\Component\EventDispatcher\Event;


class MenuEvent extends Event
{

    /** @var array The menu list */
    private $menu;

    public function __construct($menu = [])
    {
        $this->menu = $menu;
    }

    /**
     * Get a list of menu items
     *
     * @return array Array of menu items
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Add a menu item.
     *
     * Used by listeners to add their menu item
     *
     * @param string $name Text displayed to user. Must already be translated
     * @param string $link Href to the view
     */
    public function addMenuItem($name, $link)
    {
        $item = ['name' => $name, 'link' => $link];
        $this->menu[] = $item;
    }
}
