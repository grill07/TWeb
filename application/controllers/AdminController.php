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
    protected $_form10;
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
        $this->view->inseriscifaqForm = $this->getInseriscifaqForm();
        $this->view->statisticheuserForm = $this->getStatisticheuserForm();
        $this->view->gestionestaffForm = $this->getGestionestaffForm();
    }
    
    public function indexAction() {
        $username = $this->_authService->getIdentity()->username;
        $statistiche=$this->_adminModel->getNumeroCoupon();
        $this->view->assign(array('statistiche' => $statistiche)); 
    }

    public function logoutAction(){
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
    }
    
    public function geststatAction() {
        $statistiche=$this->_adminModel->getNumeroCoupon();
        $this->view->assign(array('statistiche' => $statistiche)); 
   
    }
    
    public function statpromAction() {
        $paged = $this->_getParam('page', 1);
        $offerte=$this->_adminModel->getOfferte($paged);
        $statistiche=array();
        foreach ($offerte as $offerta){
            $couponoff=$this->_adminModel->getNumCouponProm($offerta->id);
            $statistiche[$offerta->id]=$couponoff;
        }
        $this->view->assign(array('offerte' => $offerte,'statistiche'=>$statistiche));
        
    }
    
    public function statuserAction() {
        $user=$this->getParam('utente');
        $statistiche=$this->getParam('statistiche');
        $visualizza=$this->getParam('visualizza');
        if($visualizza){
            $this->view->assign(array('utente' => $user,'statistiche'=>$statistiche,'visualizza'=>$visualizza));
        }
        
    }
    
    public function statisticheuserAction() {
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
                $form = $this->_form9;
		if (!$form->isValid($_POST)) {
                    return $this->render('statuser');
		}
                $values = $form->getValues();
                $user=$values['utente'];
                $statistiche=$this->_adminModel->getNumCouponUser($user);
                $visualizza = true;             
                $this->_helper->redirector('statuser','admin','default',array('utente'=>$user,'statistiche'=>$statistiche,'visualizza'=>$visualizza));
        
        
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
        elseif($esistente){
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
                if(strcasecmp($azie,$azienda->nome) == 0){
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
        $this->_adminModel->deleteMembroStaff($username);
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
                    return $this->render('moduser');
		}   
                $values = $form->getValues();
                $username = $values['username'];
                $this->_adminModel->deleteUtente($username);
                if($values['ruolo'] == 'user'){
                    $this->_adminModel->deleteMembroStaff($username);
                }
                $this->_adminModel->saveUtente($values);
                $modifica = true;
                $this->_helper->redirector('gestuser','admin','default',array('user'=>$username,'modifica'=> $modifica));
    }
    
    public function insuserAction() {
        $inserito = $this->getParam('inserito');
        $esistente= $this->getParam('esistente');
        if($inserito){
            $user = $this->getParam('user');
            $this->view->assign(array('user' => $user,'inserito' => $inserito)); 
        }
        elseif($esistente){
            $user = $this->getParam('user');
            $this->view->assign(array('user' => $user,'esistente' => $esistente)); 
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
                $utente =$this->_adminModel->getUtenteByUsername($user);
                $inserito = true;
                $esistente=true;
                if(strcasecmp($user,$utente->username) == 0){
                   $inserito=false;
                   $this->_helper->redirector('insuser','admin','default',array('user'=>$user,'inserito'=>$inserito,'esistente'=>$esistente));
		}
                else{
                   $esistente=false;
                   $this->_adminModel->saveUtente($values);
                   $this->_helper->redirector('insuser','admin','default',array('user'=>$user,'inserito'=>$inserito,'esistente'=>$esistente));
                }
                
    }
    
    
    public function gesttipAction() {
        $paged = $this->_getParam('page', 1);
        $categorie=$this->_adminModel->getCategorie($paged);
        $elimina = $this->getParam('elimina');
        $modifica = $this->getParam('modifica');
        if($elimina){
            $cat = $this->getParam('cat');
            $this->view->assign(array('categorie' => $categorie,'cat' => $cat,'elimina' => $elimina));
        }else if($modifica){
            $cat = $this->getParam('cat');
            $vecchiacat = $this->getParam('vecchiacat');
            $this->view->assign(array('categorie' => $categorie,'cat' => $cat, 'vecchiacat'=> $vecchiacat, 'modifica' => $modifica)); 
        }else{
           $this->view->assign(array('categorie' => $categorie));  
        }
         
    }
    
    public function eliminatipAction(){
        $categoria = $this->getParam('categoria');
        $elimina = true;
        $this->_adminModel->deleteCategoria($categoria);        
        $this->_helper->redirector('gesttip','admin','default',array('cat'=>$categoria, 'elimina'=>$elimina));
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
                    return $this->render('modtip');
		}   
                $values = $form->getValues();
                $vecchiacategoria = $values['tipologia'];
                unset($values['tipologia']);
                $modifica = true;  
                $this->_adminModel->deleteCategoria($vecchiacategoria);
                $this->_adminModel->saveCategoria($values);                
                $this->_helper->redirector('gesttip','admin','default',array('cat'=>$values, 'vecchiacat'=> $vecchiacategoria,'modifica'=> $modifica));          
    }
    
    public function instipAction() {
        $inserita = $this->getParam('inserita');
        $esistente= $this->getParam('esistente');
        if($inserita){
            $cat = $this->getParam('cat');
            $this->view->assign(array('cat' => $cat,'inserita' => $inserita)); 
        }
        elseif($esistente){
            $cat = $this->getParam('cat');
            $this->view->assign(array('cat' => $cat,'esistente' => $esistente)); 
        }
        
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
                $categoria = $this->_adminModel->getCategorieByCat($values);
                $inserita = true;
                $esistente=true;
                if(strcasecmp($values['categoria'], $categoria->categoria) == 0){
                   $inserita=false;
                   $this->_helper->redirector('instip','admin','default',array('cat'=>$values,'inserita'=>$inserita,'esistente'=>$esistente));
		}
                else{
                   $esistente=false;
                   $this->_adminModel->saveCategoria($values);
                   $this->_helper->redirector('instip','admin','default',array('cat'=>$values,'inserita'=>$inserita,'esistente'=>$esistente));
                }
                  
                
    }
   
    
    
    public function gestfaqAction(){
        $paged = $this->_getParam('page', 1);
        $faq=$this->_adminModel->getFaq($paged);
        $elimina = $this->getParam('elimina');
        $modifica = $this->getParam('modifica');
        if($elimina){
            $this->view->assign(array('faq' => $faq, 'elimina' => $elimina));
        }else if($modifica){
            $this->view->assign(array('faq' => $faq, 'modifica' => $modifica)); 
        }else{
           $this->view->assign(array('faq' => $faq)); 
        }
    }
    
    public function eliminafaqAction(){
        $id = $this->getParam('id');
        $elimina = true;
        $this->_adminModel->deleteFaq($id);
        $this->_helper->redirector('gestfaq','admin','default',array('elimina'=>$elimina));
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
                    return $this->render('modfaq');
		}
                $values = $form->getValues();
                $id = $values['id'];
                $this->_adminModel->deleteFaq($id);
                $this->_adminModel->saveFaq($values);
                $modifica = true;
                $this->_helper->redirector('gestfaq','admin','default',array('modifica'=> $modifica));
                
    }
    
    public function insfaqAction(){
        $inserita = $this->getParam('inserita');
        if($inserita){
            $this->view->assign(array('inserita' => $inserita)); 
        }
                
    }
    
    public function inseriscifaqAction(){
                if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->_form8;
		if (!$form->isValid($_POST)) {
			return $this->render('insfaq');
		}
		$values = $form->getValues();
                $inserita = true;
                $this->_adminModel->saveFaq($values);
                $this->_helper->redirector('insfaq','admin','default',array('inserita'=>$inserita));
                
    }
    
    public function geststaffAction(){
        $assegnata=$this->getParam('assegnata');
        $esistente=$this->getParam('esistente');
        $staff=$this->getParam('staff');
        $azienda=$this->getParam('azienda');
        $this->view->assign(array('staff'=>$staff,'azienda'=>$azienda,'assegnata'=>$assegnata,'esistente'=>$esistente));
        
        
    }
    
    public function gestionestaffAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
                $form = $this->_form10;
		if (!$form->isValid($_POST)) {
                    return $this->render('geststaff');
		}
                $values = $form->getValues();
                $staff=$values['utente'];
                $azienda=$values['azienda'];
                $aziendestaff=$this->_adminModel->getAziendeStaff();
                $assegnata=true;
                $esistente=false;
                foreach($aziendestaff as $azstaff){
                    if(strcasecmp($values['utente'], $azstaff->utente) == 0){
                        if(strcasecmp($values['azienda'], $azstaff->azienda) == 0){       
                            $assegnata=false;
                            $esistente=true;
                        }
                    }
                }
                if($esistente){
                    $this->_helper->redirector('geststaff','admin','default',array('staff'=>$staff,'azienda'=>$azienda,'assegnata'=>$assegnata,'esistente'=>$esistente));
                }
                elseif($assegnata){
                    $this->_adminModel->saveAziendaStaff($values);
                    $this->_helper->redirector('geststaff','admin','default',array('staff'=>$staff,'azienda'=>$azienda,'assegnata'=>$assegnata,'esistente'=>$esistente));
                }
                
        
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
    
    public function getInseriscifaqForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form8 = new Application_Form_Admin_Inseriscifaq();
		$this->_form8->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inseriscifaq'),
				'default'
				));
		return $this->_form8;
    }
    
    public function getStatisticheuserForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form9 = new Application_Form_Admin_Statisticheuser();
		$this->_form9->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'statisticheuser'),
				'default'
				));
		return $this->_form9;
    }
    
    public function getGestionestaffForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form10 = new Application_Form_Admin_Gestionestaff();
		$this->_form10->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'gestionestaff'),
				'default'
				));
		return $this->_form10;
    }

}