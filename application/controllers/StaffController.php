<?php

class StaffController extends Zend_Controller_Action {
    protected $_staffModel;
    protected $_form1;
    protected $_form2;
    protected $_form3;
    protected $_form4;
    protected $_form5;
    protected $_logger;
    protected $_values;
    
    public function init(){
        $this->_helper->layout->setLayout('layoutstaff');
        $this->_staffModel = new Application_Model_Staff();    
        $this->view->inserisciForm = $this->getInserisciForm();
        $this->view->modprofiloForm = $this->getModprofiloForm();
        $this->view->modoffertaForm = $this->getModoffertaForm();
        $this->view->gestioneForm = $this->getGestioneForm();
        $this->view->profiloForm = $this->getProfiloForm();
    }
    
    public function areapersAction() {
        $utente = $this->_staffModel->getUtenteByUser('staff1');
        $this->view->assign(array('utente' => $utente));
    }
    
    public function moddatiAction() {
        
    }
    
    public function gestpromAction() {
        $offerte=$this->_staffModel->getOfferte();
        $this->view->assign(array('offerte' => $offerte));        
    }
    
    public function inspromAction() {
        
    }
    
    public function modpromAction() {
        
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
		$this->_staffModel->saveOfferta($values);
		$this->_helper->redirector('insprom','staff');
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
		$this->_helper->redirector('areapers','staff');
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
                $this->_staffModel->deleteOfferta($id);
		$this->_staffModel->saveOfferta($values);
		$this->_helper->redirector('gestprom','staff');
    }
      
    public function gestioneAction(){
                if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$id = $_POST['id'];
                if(isset($_POST['modoff'])){
                    $values = $this->_staffModel->getOffertaById($id);
                    $this->_form3->setValues($values);
                    $this->view->modoffertaForm = $this->_form3;
                    $this->render('modprom');
                }
                if(isset($_POST['elimoff'])){ 
                    $this->_staffModel->deleteOfferta($id);
                    $this->_helper->redirector('gestprom','staff');
                    
                }
    }
    
    public function profiloAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$user = $_POST['username'];
                $values = $this->_staffModel->getUtenteByUser($user);
                $this->_form2->setValues($values);
                $this->view->modprofiloForm = $this->_form2;
                $this->render('moddati');
                
               
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
    
    public function getGestioneForm(){//è una form speciale che serve a passare l'id del prodotto, che andrebbe perduto altrimenti
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form4 = new Application_Form_Staff_Gestione();
		$this->_form4->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'gestione'),
				'default'
				));
		return $this->_form4;
    }
    
    public function getProfiloForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form5 = new Application_Form_Staff_Profilo();
		$this->_form5->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'profilo'),
				'default'
				));
		return $this->_form5;
    }
}
