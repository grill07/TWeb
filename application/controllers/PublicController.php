<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_publicModel;
    protected $_form;
    protected $_logger;

    public function init() {
        $this->_helper->layout->setLayout('layout');
        $this->_logger = Zend_Registry::get('log');
        $this->_publicModel = new Application_Model_Public();
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registraForm = $this->getRegistraForm();
        $this->view->ricercaForm = $this->getRicercaForm();
    }

    public function indexAction() {
 
    }
    
    public function offerteAction() {
        /*$mode = $this->_getParam('mode');
        if($mode=='ricerca'){
            $offerte=$this->_publicModel->getOfferteCercate($values->categoria, $values->nome);
        }
        else {*/
            $offerte=$this->_publicModel->getOfferte();
        //}
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
    
    public function offsingAction() {
        $id = $this->_getParam('id');
        $id=1;
        $offerta=$this->_publicModel->getOffById($id);
        echo $offerta->nome;
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
		$offerte=$this->_publicModel->getOfferteCercate($cats, $desc, $azie);
                $this->view->assign(array('offerte' => $offerte));
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
