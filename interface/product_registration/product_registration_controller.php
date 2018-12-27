<?php




$ignoreAuth=true;
require_once("../globals.php");
require_once($GLOBALS['fileroot'] . "/interface/main/exceptions/invalid_email_exception.php");
require_once($GLOBALS['fileroot'] . "/interface/product_registration/exceptions/generic_product_registration_exception.php");
require_once($GLOBALS['fileroot'] . "/interface/product_registration/exceptions/duplicate_registration_exception.php");

use OpenEMR\Common\Http\HttpResponseHelper;
use OpenEMR\Entities\ProductRegistration;
use OpenEMR\Services\ProductRegistrationService;

class ProductRegistrationController
{
    private $productRegistrationService;

    public function __construct()
    {
        $this->productRegistrationService = new ProductRegistrationService();

        // (note this is here until we use Zend Framework)
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $this->post();
                break;
            case 'GET':
                $this->get();
                break;
        }
    }

    public function get()
    {
        $statusPayload = $this->productRegistrationService->getProductStatus();

        HttpResponseHelper::send(200, $statusPayload, 'JSON');
    }

    public function post()
    {
        $response = null;
        $status = 500;

        try {
            $response = new ProductRegistration();
            $registrationId = $this->productRegistrationService->registerProduct($_POST['email']);
            $response->setRegistrationId($registrationId);
            $response->setEmail($_POST['email']);
            $status = 201;
        } catch (InvalidEmailException $emailException) {
            $response = $emailException->errorMessage();
        } catch (DuplicateRegistrationException $duplicateRegistrationException) {
            $response = $duplicateRegistrationException->errorMessage();
        } catch (GenericProductRegistrationException $genericProductRegistrationException) {
            $response = $genericProductRegistrationException->errorMessage();
        }

        HttpResponseHelper::send($status, $response, 'JSON');
    }
}

// Initialize self (note this is here until we use Zend Framework)
$productRegistrationController = new ProductRegistrationController();
