<?php

class Application_Model_Admin extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }
    
    public function saveFaq($faq)
    {
    	return $this->getResource('Faq')->addElement($faq);
    }
    
}