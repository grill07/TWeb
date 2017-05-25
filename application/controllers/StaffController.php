<?php

class StaffController extends Zend_Controller_Action {
    
    public function init(){
        $this->_staffModel = new Application_Model_Staff();
        $this->view->inserisciForm = $this->getInserisciForm();
    }
    
    public function areapersAction() {
        
    }
    
    public function moddatiAction() {
        
    }
    
    public function gestpromAction() {
        
    }
    
    public function inspromAction() {
        
    }
    
    public function modpromAction() {
        
    }
    
    public function inserisciAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form=$this->_form;
		if (!$form->isValid($_POST)) {
			return $this->render('insprom');
		}
		$values = $form->getValues();
		$this->_staffModel->saveOfferta($values);
		$this->_helper->redirector('insprom','staff');
    }
    
    public function getInserisciForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Staff_Inserisci();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'inserisci'),
				'default'
				));
		return $this->_form;
    }

}