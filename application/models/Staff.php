<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }
    
    public function saveOfferta($offerta)
    {
    	return $this->getResource('Offerte')->addElement($offerta);
    }
}
