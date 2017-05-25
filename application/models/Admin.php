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
    
    public function saveFaq($faq)
    {
    	return $this->getResource('Faq')->addElement($faq);
    }
    
    public function deleteFaq($id)
    {
        return $this->getResource('Faq')->deleteElement($id);
    }
    
}