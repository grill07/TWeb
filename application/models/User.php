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
}