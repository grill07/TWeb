<?php

class Application_Model_Public extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }

    public function getCats()
    {
        return $this->getResource('TipoProd')->getTable();
    }
    
    public function getFaq()
    {
        return $this->getResource('Faq')->getTable();
    }
    
    public function getUtenteByUser($user)
    {
        return $this->getResource('Utenti')->getElementByUser($user);
    }
    
    public function saveUtente($utente)
    {
    	return $this->getResource('Utenti')->addElement($utente);
    }
    
}