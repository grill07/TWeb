<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_publicModel;
    protected $_form;
    /*protected $_logger;*/

    public function init() {
        /*$this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get('log');*/
        $this->_publicModel = new Application_Model_Public();
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registraForm = $this->getRegistraForm();
        $this->view->ricercaForm = $this->getRicercaForm();
    }

    public function indexAction() {
        /* serve per provare l'inserimento nel db
        $utente=array(
            		'nome' => 'Giacomo',
            		'cognome' => 'Grilli',
                        'genere' => 'M',
            		'eta' => '23',
                        'mail' => 'guev',
            		'telefono' => '143432',
                        'username' => 'gg2',
            		'password' => 'gg2',
                        'tipo' => '2'
            		);
        $this->_publicModel->saveUtente($utente);*/
        
        
        /*$this->_adminModel = new Application_Model_Admin();
        $faq=array(
            'domanda' => 'Qual è la differenza tra mi piaci e ti amo?',
            'risposta' => 'Quando ti piace un fiore lo prendi, quando ami un fiore lo annaffi ogni giorno'
        );
        $this->_adminModel->saveFaq($faq);*/
        
        
        /*$this->_adminModel = new Application_Model_Admin();
        $faq='6';
        $this->_adminModel->deleteFaq($faq);*/
    }
    
    public function offerteAction() {
        /* serve per richiamere il model e passare le variabili alla view
        $cats=$this->_publicModel->getCategorie();
        $this->view->assign(array(
            		'categorie' => $categorie
            		)
        );*/       
        $offerte=$this->_publicModel->getOfferte();
        $this->view->assign(array('offerte' => $offerte));
    }
    
    public function aziendeAction() {
        $aziende=$this->_publicModel->getAziende();
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
    
    public function loginAction() {
        
    }
    
    public function offsingAction(/*$id*/) {
        /*$off=$this->_publicModel->getOffById($id);
        $this->view->assign(array(
                        'offerta' => $off
                )
                );*/
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
                $nome = $form->getValue('nome');
		$offerta=$this->_publicModel->getOffertaByNome($nome);
		$this->view->assign(array('offerta' => $offerta ));        
    }
    
    private function checkAction() //controllo su db delle credenziali
    {
        
    }
    
    private function nuovoutenteAction() //registrare il nuovo utente sul db
    {
        
    }
    
    private function getLoginForm()
    {
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Public_Login();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'check'),
				'default'
				));
		return $this->_form;              
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
