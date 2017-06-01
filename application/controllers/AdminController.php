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
    protected $_logger;
    protected $_values;

    public function init() {
        $this->_helper->layout->setLayout('layoutadmin');
        $this->_logger = Zend_Registry::get('log');
        $this->_adminModel = new Application_Model_Admin();
        $this->view->modaziendaForm = $this->getModaziendaForm();
        $this->view->inserisciForm = $this->getInserisciForm();
        
        
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
			return $this->render('modazie');
		}
                $values = $form->getValues();
                $nome = $values['nome'];
                if($values['logo'] === null){
                            $values['logo']='';
                }
                $this->_adminModel->deleteAzienda($nome);
                $this->_adminModel->saveAzienda($values);
                $this->_helper->redirector('gestazie','admin');
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
		$this->_adminModel->saveAzienda($values);
		$this->_helper->redirector('insazie','admin');
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
    

}