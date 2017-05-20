<?php

class Application_Resource_TipoProd extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tipoProd';
    protected $_primary  = 'tipologia';
    protected $_rowClass = 'Application_Resource_TipoProd_Item';
    
    public function init()
    {
    }
    
    public function getCats()
    {
        /*$cats=array("alimentari","elettronica");
        return $cats;*/
	$select = $this->select();
        return $this->fetchAll($select);
    }


}

