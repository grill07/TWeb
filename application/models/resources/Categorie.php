<?php

class Application_Resource_Categorie extends Zend_Db_Table_Abstract
{
    protected $_name    = 'categorie';
    protected $_primary  = 'categoria';
    protected $_rowClass = 'Application_Resource_Categorie_Item';
    
    public function init()
    {
    }
    
    public function getElement($key)
    {
        return $this->fetchRow($this->select()->where('categoria = ?', $key));
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
    
    public function deleteElement($key)
    {
        $this->delete("categoria = '".$key."'");
    }

}

