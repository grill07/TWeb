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
    
    public function getUtente($paged=null) 
    {
        return $this->getResource('Utenti')->getTable($paged);
    }
    
    public function getUtenteWAd($paged=null) 
    {
        return $this->getResource('Utenti')->getUtentiWAdmin($paged);
    }
    
    public function getUtenteWStaff() 
    {
        return $this->getResource('Utenti')->getUtWStaff();
    }
    
    public function getUtenteByUsername($username) 
    {
        return $this->getResource('Utenti')->getElement($username);
    }
    
    public function getAziende($paged=null)
    {
        return $this->getResource('Aziende')->getTable($paged);
    }
    
    public function getAziendaByNome($nome)
    {
        return $this->getResource('Aziende')->getElement($nome);
    }
    
    public function getFaq($paged=null)
    {
        return $this->getResource('Faq')->getTable($paged);
    }
    
    public function getFaqById($id)
    {
        return $this->getResource('Faq')->getElement($id);
    }
    
    public function getCategorie($paged=null)
    {
        return $this->getResource('Categorie')->getTable($paged);
    }
    
    public function getCategorieByCat($categoria)
    {
        return $this->getResource('Categorie')->getElement($categoria);
    }
    
    public function updateAzienda($data,$nomeaz){
        
        return $this->getResource('Aziende')->updateElement($data,$nomeaz);
    }
    
    public function getOfferte()
    {
        return $this->getResource('Offerte')->getTable();
    }
    
    public function getNumeroCoupon()
    {
        $contatore= $this->getResource('Coupon')->getCoupon();
        return $contatore;
        
    }
    
    public function getNumCouponUser($user)
    {
        $contatore= $this->getResource('Coupon')->getCouponUser($user);
        return $contatore;
        
    }
    
    public function getNumCouponProm($off)
    {
        $contatore= $this->getResource('Coupon')->getCouponProm($off);
        return $contatore;
        
    }
}