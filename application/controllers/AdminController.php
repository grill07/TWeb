<?php

class AdminController extends Zend_Controller_Action {
    
    protected $_adminModel;
    protected $_form1;
    protected $_form2;
    protected $_form3;
    protected $_form4;
    protected $_form5;
    protected $_form6;
    protected $_form7; 
    protected $_form8;
    protected $_form9;
    protected $_logger;
    protected $_values;

    public function init() {
        $this->_helper->layout->setLayout('layoutadmin');
        $this->_logger = Zend_Registry::get('log');
        $this->_adminModel = new Application_Model_Admin();
        $this->view->modaziendaForm = $this->getModaziendaForm();
        $this->view->inserisciForm = $this->getInserisciForm();
        $this->view->modificafaqForm = $this->getModificafaqForm();
        $this->view->modutentiForm = $this->getModutentiForm();
        
    }

    public function gestazieAction() {
        $aziende=$this->_adminModel->getAziende();
        $this->view->assign(array('aziende' => $aziende)); 
        
    }
    
    public function eliminaAction(){
        $nome = $this->getParam('nome');
        $this->_adminModel->deleteAzienda($nome);
        $this->_helper->redirector('gestazie','admin');
    }
    
    
    public function modazieAction() {
        $nome = $this->getParam('nome');
        $azienda = $this->_adminModel->getAziendaByNome($nome);
        $this->_form1->setValues($azienda);
        $this->view->modaziendaForm = $this->_form1;
    }
    
    public function modaziendaAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
                $form = $this->_form1;
                $form->setValues($_POST); //viene creata la form con gli elementi già compilati
		if (!$form->isValid($_POST)) {
                    $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			return $this->render('modazie');
		}
                $values = $form->getValues();
                $nome = $values['nome'];
                if($values['logo'] === null){
                    $values['logo']='';
                    $form->setDescription('Attenzione: immagine non inserita');
                    return $this->render('modazie');
                }
                else{
                $this->_adminModel->deleteAzienda($nome);
                $this->_adminModel->saveAzienda($values);
                $this->_helper->redirector('gestazie','admin');
                }
    }


    public function insazieAction() {
        
    }
    
    public function inserisciAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->_form2;
		if (!$form->isValid($_POST)) {
			return $this->render('insazie');
		}
		$values = $form->getValues();
                if($values['logo'] === null){
                    $values['logo']='';
                    $form->setDescription('Attenzione: immagine non inserita');
                    return $this->render('insazie');
                }
                else{
		$this->_adminModel->saveAzienda($values);
		$this->_helper->redirector('insazie','admin');
                }
    }
    
    
    
    public function gestuserAction() {
        $utenti=$this->_adminModel->getUtente();
        $this->view->assign(array('utenti' => $utenti)); 
    }
    
    public function insuserAction() {
        
    }
    
    public function moduserAction() {
        
    }
    
    public function statuserAction() {
        
    }
    
    public function gesttipAction() {
        
    }
    
    public function gestfaqAction(){
        $faq=$this->_adminModel->getFaq();
        $this->view->assign(array('faq' => $faq)); 
    }
    
    public function eliminafaqAction(){
        $id = $this->getParam('id');
        $this->_adminModel->deleteFaq($id);
        $this->_helper->redirector('gestfaq','admin');
    }
    
    public function modfaqAction() {
        $id = $this->getParam('id');
        $faq = $this->_adminModel->getFaqById($id);
        $this->_form3->setValues($faq);
        $this->view->modificafaqForm = $this->_form3;
    }
    
    public function modificafaqAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
                $form = $this->_form3;
                $form->setValues($_POST); //viene creata la form con gli elementi già compilati
		if (!$form->isValid($_POST)) {
                    $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			return $this->render('modfaq');
		}
                $values = $form->getValues();
                $id = $values['id'];
                $this->_adminModel->deleteFaq($id);
                $this->_adminModel->saveFaq($values);
                $this->_helper->redirector('gestfaq','admin');
                
    }
    
    
    
    public function statpromAction() {
        
    }

    public function getModaziendaForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form1 = new Application_Form_Admin_Modazienda();
		$this->_form1->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modazienda'),
				'default'
				));
		return $this->_form1;
    }
    
    public function getInserisciForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form2 = new Application_Form_Admin_Inserisci();
		$this->_form2->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserisci'),
				'default'
				));
		return $this->_form2;
    }
    
    public function getModificafaqForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form3 = new Application_Form_Admin_Modificafaq();
		$this->_form3->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificafaq'),
				'default'
				));
		return $this->_form3;
    }
    
        public function getModutentiForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form4 = new Application_Form_Admin_Modutenti();
		$this->_form4->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modutenti'),
				'default'
				));
		return $this->_form4;
    }

}