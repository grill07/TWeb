<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

    public function __construct()
    {
       
    }
    
    public function saveOfferta($offerta)
    {
        return $this->getResource('Offerte')->addElement($offerta);
    }
}
