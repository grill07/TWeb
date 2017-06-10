<?php

class AdminController extends Zend_Controller_Action {
    
    protected $_authService;
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
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));
        $this->_helper->layout->setLayout('layoutadmin');
        $this->_logger = Zend_Registry::get('log');
        $this->_adminModel = new Application_Model_Admin();
        $this->view->modaziendaForm = $this->getModaziendaForm();
        $this->view->inserisciForm = $this->getInserisciForm();
        $this->view->modificafaqForm = $this->getModificafaqForm();
        $this->view->modutentiForm = $this->getModutentiForm();
        $this->view->inseruserForm = $this->getInseruserForm();
        $this->view->modtipologiaForm = $this->getModtipologiaForm();
        $this->view->inseriscitipForm = $this->getInseriscitipForm();
    }
    
    public function indexAction() {
        $username = $this->_authService->getIdentity()->username;
        $utente = $this->_adminModel->getUtenteByUsername($username);
        $this->view->assign(array('utente' => $utente));
    }

    public function logoutAction(){
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
    }
    
    public function gestazieAction() {
        $paged = $this->_getParam('page', 1);
        $aziende=$this->_adminModel->getAziende($paged);
        $elimina = $this->getParam('elimina');
        $modifica = $this->getParam('modifica');
        if($elimina){
            $azie = $this->getParam('azie');
            $this->view->assign(array('aziende' => $aziende,'azie' => $azie,'elimina' => $elimina));
        }else if($modifica){
            $azie = $this->getParam('azie');
            $this->view->assign(array('aziende' => $aziende,'azie' => $azie,'modifica' => $modifica)); 
        }else{
           $this->view->assign(array('aziende' => $aziende)); 
        }
         
    }
    
    public function eliminaAction(){
        $nome = $this->getParam('nome');
        $elimina = true;
        $this->_adminModel->deleteAzienda($nome);
        $this->_helper->redirector('gestazie','admin','default',array('azie'=>$nome, 'elimina'=>$elimina));
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
                            unset($values['logo']);
                            unset($values['nome']);
                            $this->_adminModel->updateAzienda($values,$nome);
                }
                else{
                $this->_adminModel->deleteAzienda($nome);
                $this->_adminModel->saveAzienda($values);
                }
                $modifica = true;             
                $this->_helper->redirector('gestazie','admin','default',array('azie'=>$nome,'modifica'=> $modifica));
                
    }


    public function insazieAction() {
        $inserita = $this->getParam('inserita');
        $esistente= $this->getParam('esistente');
        if($inserita){
            $azie = $this->getParam('azie');
            $this->view->assign(array('azie' => $azie,'inserita' => $inserita)); 
        }
        if($esistente){
            $azie = $this->getParam('azie');
            $this->view->assign(array('azie' => $azie,'esistente' => $esistente)); 
        }
        
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
                $azie = $values['nome'];
                $azienda = $this->_adminModel->getAziendaByNome($azie);
                $inserita = true;
                $esistente=true;
                if($azie==$azienda->nome){
                   $inserita=false;
                   $this->_helper->redirector('insazie','admin','default',array('azie'=>$azie,'inserita'=>$inserita,'esistente'=>$esistente));
		}
                else{
                   $esistente=false;
                   $this->_adminModel->saveAzienda($values);
                   $this->_helper->redirector('insazie','admin','default',array('azie'=>$azie,'inserita'=>$inserita,'esistente'=>$esistente));
                }
                
    }
    
    public function gestuserAction() {
        $paged = $this->_getParam('page', 1);
        $username=$this->_adminModel->getUtenteWAd($paged);
        $elimina = $this->getParam('elimina');
        $modifica = $this->getParam('modifica');
        if($elimina){
            $user = $this->getParam('user');
            $this->view->assign(array('utenti' => $username,'user' => $user,'elimina' => $elimina));
        }else if($modifica){
            $user = $this->getParam('user');
            $this->view->assign(array('utenti' => $username,'user' => $user,'modifica' => $modifica)); 
        }else{
            $this->view->assign(array('utenti' => $username));
        }
         
    }
    
    public function eliminauserAction(){
        $username = $this->getParam('username');
        $elimina = true;
        $this->_adminModel->deleteUtente($username);
        $this->_helper->redirector('gestuser','admin','default',array('user'=>$username, 'elimina'=>$elimina));
    }
    
    public function moduserAction() {
        $username = $this->getParam('username');
        $utente = $this->_adminModel->getUtenteByUsername($username);
        $this->_form4->setValues($utente);
        $this->view->modutentiForm = $this->_form4;
    }
    
    public function modutentiAction(){
        if (!$this->getRequest()->isPost()) {
		$this->_helper->redirector('gestuser','admin');
	}
                $form = $this->_form4;
                $form->setValues($_POST); //viene creata la form con gli elementi già compilati
		if (!$form->isValid($_POST)) {
                    $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			return $this->render('moduser');
		}   
                $values = $form->getValues();
                $username = $values['username'];
                $this->_adminModel->deleteUtente($username);
                $this->_adminModel->saveUtente($values);
                $modifica = true;
                $this->_helper->redirector('gestuser','admin','default',array('user'=>$username,'modifica'=> $modifica));
    }
    
    public function insuserAction() {
        $inserito = $this->getParam('inserito');
        if($inserito){
            $user = $this->getParam('user');
            $this->view->assign(array('user' => $user,'inserito' => $inserito)); 
        }
        
    }
    
    public function inseruserAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->_form5;
		if (!$form->isValid($_POST)) {
			return $this->render('insuser');
		}
		$values = $form->getValues();
                $user = $values['username'];
		$this->_adminModel->saveUtente($values);
                $inserito = true;
		$this->_helper->redirector('insuser','admin','default',array('user' => $user,'inserito' => $inserito));
                
    }
    
    
    public function gesttipAction() {
        $categorie=$this->_adminModel->getCategorie();
        $this->view->assign(array('categorie' => $categorie));  
    }
    
    public function eliminatipAction(){
        $categoria = $this->getParam('categoria');
        $this->_adminModel->deleteCategoria($categoria);
        $this->_helper->redirector('gesttip','admin');
    }
    
    public function modtipAction() {
        $cat = $this->getParam('categoria');
        $categoria = $this->_adminModel->getCategorieByCat($cat);
        $this->_form6->setValues($categoria);
        $this->view->modtipologiaForm = $this->_form6;
    }
    
    public function modtipologiaAction(){
        if (!$this->getRequest()->isPost()) {
		$this->_helper->redirector('gesttip','admin');
	}
                $form = $this->_form6;
                $form->setValues($_POST); //viene creata la form con gli elementi già compilati
		if (!$form->isValid($_POST)) {
                    $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			return $this->render('modtip');
		}   
                $values = $form->getValues();
                $vecchiacategoria = $values['tipologia'];
                unset($values['tipologia']);
                $this->_adminModel->deleteCategoria($vecchiacategoria);
                $this->_adminModel->saveCategoria($values);
                $this->_helper->redirector('gesttip','admin');          
    }
    
    public function instipAction() {
        
    }
    
    public function inseriscitipAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->_form7;
		if (!$form->isValid($_POST)) {
			return $this->render('instip');
		}
		$values = $form->getValues();
		$this->_adminModel->saveCategoria($values);
		$this->_helper->redirector('instip','admin');
                
    }
    
    
    
    
    public function statuserAction() {
        
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
    public function getInseruserForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form5 = new Application_Form_Admin_Inseruser();
		$this->_form5->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inseruser'),
				'default'
				));
		return $this->_form5;
    }
    
    public function getModtipologiaForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form6 = new Application_Form_Admin_Modtipologia();
		$this->_form6->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modtipologia'),
				'default'
				));
		return $this->_form6;
    }
    
    public function getInseriscitipForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form7 = new Application_Form_Admin_Inseriscitip();
		$this->_form7->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inseriscitip'),
				'default'
				));
		return $this->_form7;
    }
}