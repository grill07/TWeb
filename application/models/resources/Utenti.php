<?php

class Application_Resource_Utenti extends Zend_Db_Table_Abstract
{
    protected $_name    = 'utenti';
    protected $_primary  = 'username';
    protected $_rowClass = 'Application_Resource_Utenti_Item';
    
    public function init()
    {
    }
    
    public function getElementByUser($user)
    {
        return $this->fetchRow($this->select()->where('username = ?', $user));
    }
    
    public function getTable()
    {
	$select = $this->select();
        return $this->fetchAll($select);
    }

    public function addElement($el)
    {
    	$this->insert($el);
    }

}

