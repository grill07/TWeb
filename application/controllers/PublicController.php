<?php

class PublicController extends Zend_Controller_Action {

    /*protected $_logger;*/

    public function init() {
        /*$this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get('log');*/
        $this->_publicModel = new Application_Model_Public();
    }

    public function indexAction() {
        
    }
    
    public function offerteAction() {
        $cats=$this->_publicModel->getCats();
        $this->view->assign(array(
            		'cats' => $cats,
            		'products' => $cats
            		)
        );

    }
    
    public function aziendeAction() {
        
    }
    
    public function faqAction() {
        
    }
    
    public function loginAction() {
        
    }
    
    public function offsingAction() {
        
    }
    
    public function registratiAction() {
        
    }

    

}