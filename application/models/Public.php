<?php

class Application_Model_Public extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }

    public function getAziende()
    {
        return $this->getResource('Aziende')->getTable();
    }
    
    public function getCategorie()
    {
        return $this->getResource('Categorie')->getTable();
    }
    
    public function getFaq()
    {
        return $this->getResource('Faq')->getTable();
    }
    
    public function getOffById($id)
    {
        return $this->getResource('Offerte')->getElement($id);
    }
    
    public function getUtenteByUser($user)
    {
        return $this->getResource('Utenti')->getElement($user);
    }
    
    public function saveUtente($utente)
    {
    	return $this->getResource('Utenti')->addElement($utente);
    }
    
}