<?php

class Application_Resource_TipoProd extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tipoProd';
    protected $_primary  = 'tipologia';
    protected $_rowClass = 'Application_Resource_TipoProd_Item';
    
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
    
    /* da sistemare
    public function deleteElement($key)
    {
        $where=(_primary .' = ?', $key);
        $this->delete($where);
    }*/

}

