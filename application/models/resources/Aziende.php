<?php

class Application_Resource_Aziende extends Zend_Db_Table_Abstract
{
    protected $_name    = 'aziende';
    protected $_primary  = 'nome';
    protected $_rowClass = 'Application_Resource_Aziende_Item';
    
    public function init()
    {
    }
    
    public function getElement($key)
    {
        return $this->fetchRow($this->select()->where('nome = ?', $key));
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
    
    public function deleteElement($key)
    {
        return $this->delete('nome = ' . $key);
    }

}