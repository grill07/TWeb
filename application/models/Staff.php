<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }
    
    public function updateOfferta($data){
        return $this->getResource('Offerte')->updateElement($data);
    }
    
    public function getOffertaById($id){
        return $this->getResource('Offerte')->getElement($id);
    }
    
    public function getOfferte($paged=null){
        return $this->getResource('Offerte')->getTable($paged);
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
    
    public function getCategorie()
    {
        return $this->getResource('Categorie')->getTable();
    }
    
    public function getAziendeStaff()
    {
        return $this->getResource('Aziendestaff')->getTable();
    }
    
    public function getStaffAzienda($staff,$azienda)
    {
        return $this->getResource('Aziendestaff')->getStaffAzie($staff,$azienda);
    }
    
    public function getOnlyAzienda($staff,$azienda)
    {
        return $this->getResource('Aziendestaff')->getOnlyAzie($staff,$azienda);
    }
    
    public function getOffStaff($aziende,$paged=null)
    {
        return $this->getResource('Offerte')->getOfferteStaff($aziende,$paged);
    }
    
}
