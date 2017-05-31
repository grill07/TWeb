<?php

class Application_Model_User extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }
    
    public function saveCoupon($coupon)
    {
    	return $this->getResource('Coupon')->addElement($coupon);
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
}