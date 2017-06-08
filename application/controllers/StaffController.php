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
        $modifica = $this->getParam('modifica');
        if($modifica){
            $this->view->assign(array('utente' => $utente,'modifica' => $modifica));
        }else{
        $this->view->assign(array('utente' => $utente));
        }
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
        $paged = $this->_getParam('page', 1);
        $offerte=$this->_staffModel->getOfferte($paged);
        $elimina = $this->getParam('elimina');
        $modifica = $this->getParam('modifica');
        if($elimina){
            $off = $this->getParam('off');
            $this->view->assign(array('offerte' => $offerte,'off' => $off,'elimina' => $elimina));
        }else if($modifica){
            $off = $this->getParam('off');
            $this->view->assign(array('offerte' => $offerte,'off' => $off,'modifica' => $modifica)); 
        }else{
           $this->view->assign(array('offerte' => $offerte)); 
        }
    }
    
    public function inspromAction() {
        $inserita = $this->getParam('inserita');
        if($inserita){
            $off = $this->getParam('off');
            $this->view->assign(array('off' => $off,'inserita' => $inserita)); 
        }
    }
    
    public function modpromAction() {
        $id = $this->getParam('id');
        $offerta = $this->_staffModel->getOffertaById($id);
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
                if($values['immagine'] === null){
                            $values['immagine']='immagineBase.png';
                }
		$this->_staffModel->saveOfferta($values);
                $off = $values['nome'];
                $inserita = true;
		$this->_helper->redirector('insprom','staff','default',array('off' => $off,'inserita' => $inserita));
    }
    
    public function eliminaAction(){
        $id = $this->getParam('id');
        $off = $this->getParam('nome');
        $elimina = true;
        $this->_staffModel->deleteOfferta($id);
        $this->_helper->redirector('gestprom','staff','default',array('off' => $off,'elimina' => $elimina));
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
                $modifica = true;
		$this->_helper->redirector('index','staff','default',array('modifica' => $modifica));
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
                if($values['immagine'] === null){
                            $values['immagine']=$values['imm'];
                }
                unset($values['imm']);
                $this->_staffModel->deleteOfferta($id);
                $this->_staffModel->saveOfferta($values);
                $off = $values['nome'];
                $modifica = true;
                $this->_helper->redirector('gestprom','staff','default',array('off' => $off,'modifica' => $modifica));
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
}
