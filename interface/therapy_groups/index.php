<?php



require_once dirname(__FILE__) . '/../globals.php';
require_once dirname(__FILE__) . '/therapy_groups_controllers/therapy_groups_controller.php';
require_once dirname(__FILE__) . '/therapy_groups_controllers/participants_controller.php';

$method = $_GET['method'];

switch ($method) {
    case 'addGroup':
        $controller = new TherapyGroupsController();
        $controller->index();
        break;

    case 'listGroups':
        $controller = new TherapyGroupsController();
        $controller->listGroups();
        break;

    case 'groupDetails':
        if (!isset($_GET['group_id'])) {
            die('Missing group ID');
        }

        $controller = new TherapyGroupsController();
        if ($_GET['group_id'] == 'from_session') {
            $controller->index($therapy_group);
        } else {
            $controller->index($_GET['group_id']);
        }
        break;
    case 'groupParticipants':
        if (!isset($_GET['group_id'])) {
            die('Missing group ID');
        }

        $controller = new ParticipantsController();
        $controller->index($_GET['group_id']);
        break;
    case 'addParticipant':
        $controller = new ParticipantsController();
        $controller->add($_GET['group_id']);
        break;
}
