<?php

class UserController extends Zend_Controller_Action {
    protected $_userModel;
    protected $_form;
    public function init(){
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));
        $this->_helper->layout->setLayout('layoutuser');
        $this->_userModel = new Application_Model_User(); 
        $this->view->modprofiloForm = $this->getModprofiloForm();
    }
    
    public function couponAction() {
        
    }
    
    public function indexAction() {
        $user = $this->_authService->getIdentity()->username;
        $utente = $this->_userModel->getUtenteByUser($user);
        $this->view->assign(array('utente' => $utente));
    }
    
    public function logoutAction(){
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
    }
    
    public function moddatiAction() {
        $user = $this->getParam('username');
        $utente = $this->_userModel->getUtenteByUser($user);
        $this->_form->setValues($utente);
        $this->view->modprofiloForm = $this->_form;
    }
    
    public function modprofiloAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->_form;
                $form->setValues($_POST);
		if (!$form->isValid($_POST)) {
			return $this->render('moddati');
		}
		$values = $form->getValues();
                $el = $values['username'];
                $this->_userModel->deleteUtente($el);
		$this->_userModel->saveUtente($values);
		$this->_helper->redirector('index','user');
    }
    
    public function getModprofiloForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_User_Modprofilo();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'user',
				'action' => 'modprofilo'),
				'default'
				));
		return $this->_form;
    }
}