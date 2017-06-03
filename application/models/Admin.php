<?php

class Application_Model_Admin extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }
    
    public function saveAzienda($azienda)
    {
    	return $this->getResource('Aziende')->addElement($azienda);
    }
    
    public function saveCategoria($categoria)
    {
    	return $this->getResource('Categorie')->addElement($categoria);
    }
    
    public function saveUtente($username) {
        return $this->getResource('Utenti')->addElement($username);
    }
    
    public function saveFaq($faq)
    {
    	return $this->getResource('Faq')->addElement($faq);
    }
    
    public function deleteAzienda($nome)
    {
        return $this->getResource('Aziende')->deleteElement($nome);
    }
    
    public function deleteCategoria($cat)
    {
        return $this->getResource('Categorie')->deleteElement($cat);
    }
    
    public function deleteFaq($id)
    {
        return $this->getResource('Faq')->deleteElement($id);
    }
    
    public function deleteUtente($username)
    {
        return $this->getResource('Utenti')->deleteElement($username);
    }
    
    public function getUtente() 
    {
        return $this->getResource('Utenti')->getTable();
    }
    
    public function getUtenteByUsername($username) 
    {
        return $this->getResource('Utenti')->getElement($username);
    }
    
    public function getAziende()
    {
        return $this->getResource('Aziende')->getTable();
    }
    public function getAziendaByNome($nome)
    {
        return $this->getResource('Aziende')->getElement($nome);
    }
    public function getFaq()
    {
        return $this->getResource('Faq')->getTable();
    }
    public function getFaqById($id)
    {
        return $this->getResource('Faq')->getElement($id);
    }
}