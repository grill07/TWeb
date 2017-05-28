<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }
    
    public function getOffertaById($id){
        return $this->getResource('Offerte')->getElement($id);
    }
    
    public function getOfferte(){
        return $this->getResource('Offerte')->getTable();
    }
    
    public function saveOfferta($offerta)
    {
    	return $this->getResource('Offerte')->addElement($offerta);
    }
    
    public function deleteOfferta($id)
    {
        return $this->getResource('Offerte')->deleteElement($id);
    }
    
    public function getUtenteByUser($user)
    {
        return $this->getResource('Utenti')->getElement($user);
    }
    
    public function saveUtente($user)
    {
    	return $this->getResource('Utenti')->addElement($user);
    }
    
    public function deleteUtente($user)
    {
        return $this->getResource('Utenti')->deleteElement($user);
    }
    
    public function getAziende()
    {
        return $this->getResource('Aziende')->getTable();
    }
}
