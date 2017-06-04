<?php

class App_Controller_Helper_Dbhelp extends Zend_Controller_Action_Helper_Abstract
{
    public function timedb($data,$formato){
        if($formato=='dd-mm-yyyy'){
            $zend = new Zend_Date($data,$formato,'en');
            $zend = $zend->get('YYYY-MM-dd');
        }
        if($formato=='yyyy-mm-dd'){
            $zend = new Zend_Date($data,$formato,'en');
            $zend = $zend->get('dd-MM-YYYY');
        }
        return $zend;
    }
}
