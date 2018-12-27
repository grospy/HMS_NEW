<?php


namespace OpenEMR\Admin\Controller;

use OpenEMR\Admin\Service\AdminMenuBuilder;
use OpenEMR\Core\Controller;


class AdminController extends Controller
{

    /** @var AdminMenuBuilder */
    public $menuBuilder;

    public function __construct()
    {
        parent::__construct();
        $this->menuBuilder = $this->container->get('admin.admin_menu_builder');

        $this->indexAction();
    }

    public function indexAction()
    {

        $this->menuBuilder->generateMainMenu();
    }
}
