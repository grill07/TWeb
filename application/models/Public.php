<?php

class Application_Model_Public extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }

    public function getAziende($paged=null)
    {
        return $this->getResource('Aziende')->getTable($paged);
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
    
    public function getOffertaByNome($nome){
        return $this->getResource('Offerte')->getOffertaByNome($nome);    
    }
    
    public function getOfferte($paged=null){
        return $this->getResource('Offerte')->getTable($paged);
    }
    
    public function getOfferteCercate($cats, $desc, $azie, $paged=null){
        return $this->getResource('Offerte')->getOfferteCercate($cats, $desc, $azie, $paged);
    }
    
    public function getOfferteScaricate(){
        return $this->getResource('Offerte')->getOfferteScaricate();
    }
    
    public function getOfferteNew(){
        return $this->getResource('Offerte')->getOfferteNew();
    }
    
    public function saveUtente($utente)
    {
    	return $this->getResource('Utenti')->addElement($utente);
    }
    
}
