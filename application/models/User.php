<?php

class Application_Model_User extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }
    
    public function getOffById($id)
    {
        return $this->getResource('Offerte')->getElement($id);
    }
    
    public function saveOfferta($offerta)
    {
    	return $this->getResource('Offerte')->addElement($offerta);
    }
    
    public function deleteOfferta($id)
    {
        return $this->getResource('Offerte')->deleteElement($id);
    }
    
    public function saveCoupon($coupon)
    {
    	return $this->getResource('Coupon')->addElement($coupon);
    }
    
    public function getCoupon($user, $off)
    {
    	return $this->getResource('Coupon')->getElementByUaO($user, $off);
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