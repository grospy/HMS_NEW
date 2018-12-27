<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Listener\Listener;

class IndexController extends AbstractActionController
{
    protected $applicationTable;
    protected $listenerObject;
    
    public function __construct()
    {
        $this->listenerObject = new Listener;
    }
    
    public function indexAction()
    {
    }
    
     /**
     * Function ajaxZXL
     * All JS Mesages to xl Translation
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function ajaxZxlAction()
    {
        $request  = $this->getRequest();
        $message  = $request->getPost()->msg;
        $array    = array('msg' => $this->listenerObject->z_xl($message));
        $return   = new JsonModel($array);
        return $return;
    }
    
    /**
     * Table Gateway
     *
     * @return type
     */
    public function getApplicationTable()
    {
        if (!$this->applicationTable) {
            $sm = $this->getServiceLocator();
            $this->applicationTable = $sm->get('Application\Model\ApplicationTable');
        }

        return $this->applicationTable;
    }
    
    /**
     * Search Mechanism
     * Auto Suggest
     *
     * @return string
     */
    public function searchAction()
    {
        $request      = $this->getRequest();
        $result       = $this->forward()->dispatch('Application\Controller\Index', array(
                                                      'action' => 'auto-suggest'
                                                 ));
        return $result;
    }
    
    public function autoSuggestAction()
    {
        $request      = $this->getRequest();
        $post         = $request->getPost();
        $keyword      = $request->getPost()->queryString;
        $page         = $request->getPost()->page;
        $searchType   = $request->getPost()->searchType;
        $searchEleNo  = $request->getPost()->searchEleNo;
        $searchMode   = $request->getPost()->searchMode;
        $limit        = 20;
        $result       = $this->getApplicationTable()->listAutoSuggest($post, $limit);
      /** disable layout **/
        $index        = new ViewModel();
        $index->setTerminal(true);
        $index->setVariables(array(
                                        'result'        => $result,
                                        'keyword'       => $keyword,
                                        'page'          => $page,
                                        'searchType'    => $searchType,
                                        'searchEleNo'   => $searchEleNo,
                                        'searchMode'    => $searchMode,
                                        'limit'         => $limit,
                                        'CommonPlugin'  => $this->CommonPlugin(),
                                        'listenerObject'=>$this->listenerObject,
                                    ));
        return $index;
    }
}
