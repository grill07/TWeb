<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_publicModel;
    protected $_form;
    /*protected $_logger;*/

    public function init() {
        /*$this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get('log');*/
        $this->_publicModel = new Application_Model_Public();
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registraForm = $this->getRegistraForm();
        $this->view->ricercaForm = $this->getRicercaForm();
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
    
    private function checkAction() //controllo su db delle credenziali
    {
        
    }
    
    private function nuovoutenteAction() //registrare il nuovo utente sul db
    {
        
    }
    
    private function cercaprodottoAction(){
        
    }
    
    private function getLoginForm()
    {
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Public_Login();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'check'),
				'default'
				));
		return $this->_form;              
    }
    
    private function getRegistraForm()
    {
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Public_Registrati();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'nuovoutente'),
				'default'
				));
		return $this->_form;              
    }
    
    private function getRicercaForm()
    {
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Public_Ricerca();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'cercaprodotto'),
				'default'
				));
		return $this->_form;              
    }
    

}