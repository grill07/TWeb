<?php

class PublicController extends Zend_Controller_Action {
    protected $_authService;
    protected $_publicModel;
    protected $_form;
    protected $_form2;
    protected $_logger;

    public function init() {
        $this->_authService = new Application_Service_Auth();
        if($this->_authService->getIdentity() != false){
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));
        }
        $this->_helper->layout->setLayout('layout');
        $this->_logger = Zend_Registry::get('log');
        $this->_publicModel = new Application_Model_Public();
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registraForm = $this->getRegistraForm();
        $this->view->ricercaForm = $this->getRicercaForm();
    }

    public function indexAction() {
        $new=$this->_publicModel->getOfferteNew();
        $scaricate=$this->_publicModel->getOfferteScaricate();        
        $this->view->assign(array(
            		'new' => $new,
                        'scaricate' => $scaricate
                )
                );  
    }
    
    public function loginAction() {
        
    }
    
    public function autenticaAction(){        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $form = $this->_form2;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
        	    return $this->render('login');
        }
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->ruolo);
    }
        
    public function offerteAction() {
        $paged = $this->_getParam('page', 1);
        $offerte=$this->_publicModel->getOfferte($paged);
        $this->view->assign(array('offerte' => $offerte));
    }
    
    public function aziendeAction() {
        $paged = $this->_getParam('page', 1);
        $aziende=$this->_publicModel->getAziende($paged);
        $this->view->assign(array(
            		'aziende' => $aziende
                )
                );        
    }
    
    public function faqAction() {
        $faq=$this->_publicModel->getFaq();
        $this->view->assign(array(
            		'faq' => $faq
                )
                );
    }
      
    public function offsingAction() {
        $id = $this->_getParam('id');
        $id=intval($id); //converte la stringa in intero
        $offerta=$this->_publicModel->getOffById($id);
        $this->view->assign(array(
                        'offerta' => $offerta
                )
                );
    }
    
    public function registratiAction() {
        
    }
    
    public function risultatiAction(){
                if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form=$this->_form;
		if (!$form->isValid($_POST)) {
			return $this->render('offerte');
		}
                $values = $form->getValues();
                $cats=$values['categoria'];
                $azie=$values['azienda'];
                $desc=$values['nome'];
                $desc=explode(' ',$desc); //separa le parole della stringa e le mette in un array
                $paged = $this->_getParam('page', 1);
		$offerte=$this->_publicModel->getOfferteCercate($cats, $desc, $azie, $paged);
                $this->view->assign(array('offerte' => $offerte));
    }

    private function nuovoutenteAction() //registrare il nuovo utente sul db
    {
        
    }
    
    private function getLoginForm()
    {
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form2 = new Application_Form_Public_Auth_Login();
		$this->_form2->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'autentica'),
				'default'
				));
		return $this->_form2;              
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
				'action' => 'risultati'),
				'default'
				));
		return $this->_form;              
    }
    

}
