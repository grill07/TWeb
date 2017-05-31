<?php

class AdminController extends Zend_Controller_Action {
    
    protected $_adminModel;
    protected $_form;
    protected $_logger;

    public function init() {
        $this->_helper->layout->setLayout('layoutadmin');
        $this->_logger = Zend_Registry::get('log');
        $this->_publicModel = new Application_Model_Public();
        //$this->view->loginForm = $this->getLoginForm();
        //$this->view->registraForm = $this->getRegistraForm();
        //$this->view->ricercaForm = $this->getRicercaForm();
    }

    public function gestazieAction() {
        
    }
    
    public function insazieAction() {
        
    }
    
    public function modazieAction() {
        
    }
    
    public function gestuserAction() {
        
    }
    
    public function insuserAction() {
        
    }
    
    public function moduserAction() {
        
    }
    
    public function statuserAction() {
        
    }
    
    public function gesttipAction() {
        
    }
    
    public function aggfaqAction() {
        
    }
    
    public function statpromAction() {
        
    }

    

}