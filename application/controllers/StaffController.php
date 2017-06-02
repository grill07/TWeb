<?php

class StaffController extends Zend_Controller_Action { 
    
    protected $_authService;
    protected $_staffModel;
    protected $_form1;
    protected $_form2;
    protected $_form3;
    protected $_logger;
    protected $_values;
    
    public function init(){
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));
        $this->_helper->layout->setLayout('layoutstaff');
        $this->_staffModel = new Application_Model_Staff();    
        $this->view->inserisciForm = $this->getInserisciForm();
        $this->view->modprofiloForm = $this->getModprofiloForm();
        $this->view->modoffertaForm = $this->getModoffertaForm();
    }
    
    public function indexAction() {
        $user = $this->_authService->getIdentity()->username;
        $utente = $this->_staffModel->getUtenteByUser($user);
        $this->view->assign(array('utente' => $utente));
    }
    
    public function logoutAction(){
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
    }
    
    public function moddatiAction() {
        $user = $this->getParam('username');
        $utente = $this->_staffModel->getUtenteByUser($user);
        $this->_form2->setValues($utente);
        $this->view->modprofiloForm = $this->_form2;
    }
    
    public function gestpromAction() {
        $offerte=$this->_staffModel->getOfferte();
        foreach ($offerte as $offerta){
            $offerta['inizio']= $this->timedb($offerta['inizio'],'yyyy-mm-dd');
            $offerta['fine']= $this->timedb($offerta['fine'],'yyyy-mm-dd');
        }
        $this->view->assign(array('offerte' => $offerte));        
    }
    
    public function inspromAction() {
        
    }
    
    public function modpromAction() {
        $id = $this->getParam('id');
        $offerta = $this->_staffModel->getOffertaById($id);
        $offerta['inizio']= $this->timedb($offerta['inizio'],'yyyy-mm-dd');
        $offerta['fine']= $this->timedb($offerta['fine'],'yyyy-mm-dd');
        $this->_form3->setValues($offerta);
        $this->view->modoffertaForm = $this->_form3;
    }

    public function inserisciAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->_form1;
		if (!$form->isValid($_POST)) {
			return $this->render('insprom');
		}
		$values = $form->getValues();
                $values['inizio']= $this->timedb($values['inizio'],'dd-mm-yyyy');
                $values['fine']= $this->timedb($values['fine'],'dd-mm-yyyy');
		$this->_staffModel->saveOfferta($values);
		$this->_helper->redirector('insprom','staff');
    }
    
    public function eliminaAction(){
        $id = $this->getParam('id');
        $this->_staffModel->deleteOfferta($id);
        $this->_helper->redirector('gestprom','staff');
    }
    
    public function modprofiloAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->_form2;
                $form->setValues($_POST);
		if (!$form->isValid($_POST)) {
			return $this->render('moddati');
		}
		$values = $form->getValues();
                $el = $values['username'];
                $this->_staffModel->deleteUtente($el);
		$this->_staffModel->saveUtente($values);
		$this->_helper->redirector('index','staff');
    }
    
    public function modoffertaAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
                $form = $this->_form3;
                $form->setValues($_POST); //viene creata la form con gli elementi già compilati
		if (!$form->isValid($_POST)) {
			return $this->render('modprom');
		}
                $values = $form->getValues();
                $id = $values['id'];
                $values['inizio']= $this->timedb($values['inizio'],'dd-mm-yyyy');
                $values['fine']= $this->timedb($values['fine'],'dd-mm-yyyy');
                if($values['immagine'] === null){
                            $values['immagine']=$values['imm'];
                }
                unset($values['imm']);
                $this->_staffModel->deleteOfferta($id);
                $this->_staffModel->saveOfferta($values);
                $this->_helper->redirector('gestprom','staff');
    }
     
    public function getInserisciForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form1 = new Application_Form_Staff_Inserisci();
		$this->_form1->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'inserisci'),
				'default'
				));
		return $this->_form1;
    }

    public function getModprofiloForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form2 = new Application_Form_Staff_Modprofilo();
		$this->_form2->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'modprofilo'),
				'default'
				));
		return $this->_form2;
    }
    
    public function getModoffertaForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form3 = new Application_Form_Staff_Modofferta();
		$this->_form3->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'modofferta'),
				'default'
				));
		return $this->_form3;
    }
    
    public function timedb($data,$formato){
        if($formato=='dd-mm-yyyy'){
            $zend = new Zend_Date($data,$formato,'en');
            $zend = $zend->get('YYYY-MM-dd');
        }
        if($formato=='yyyy-mm-dd'){
            $zend = new Zend_Date($data,$formato,'en');
            $zend = $zend->get('dd-MM-YYYY');
        }
        return $zend;
    }
}
