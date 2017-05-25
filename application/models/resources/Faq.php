<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'faq';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Faq_Item';
    
    public function init()
    {
    }
    
    public function getTable()
    {
	$select = $this->select();
        return $this->fetchAll($select);
    }
    
    public function addElement($el)
    {
    	return $this->insert($el);
    }

}
