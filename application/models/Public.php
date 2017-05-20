<?php

class Application_Model_Public extends App_Model_Abstract
{ 

    public function __construct()
    {
        /*$this->_logger = Zend_Registry::get('log');*/
    }

    public function getCats()
    {
        return $this->getResource('TipoProd')->getCats();
    }
    
}