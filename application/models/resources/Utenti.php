<?php

class Application_Resource_Utenti extends Zend_Db_Table_Abstract
{
    protected $_name    = 'utenti';
    protected $_primary  = 'username';
    protected $_rowClass = 'Application_Resource_Utenti_Item';
    
    public function init()
    {
    }
    
    public function getElement($key)
    {
        return $this->fetchRow($this->select()->where('username = ?', $key));
    }
    
    public function getTable($paged=null)
    {
	$select = $this->select();
        if (null !==$paged) {
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
                $paginator = new Zend_Paginator($adapter);
                $paginator->setItemCountPerPage(5)
                        ->setCurrentPageNumber((int) $paged);
                return $paginator;
        }
        return $this->fetchAll($select);
    }

    public function addElement($el)
    {
    	$this->insert($el);
    }
    
    public function deleteElement($key)
    {
        return $this->delete('username ="' . $key.'"');
    }
    
    public function getUtentiWAdmin($paged=null)
    {
	$select = $this->select()->where("ruolo != 'admin'");
        if (null !==$paged) {
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
                $paginator = new Zend_Paginator($adapter);
                $paginator->setItemCountPerPage(5)
                        ->setCurrentPageNumber((int) $paged);
                return $paginator;
        }
        return $this->fetchAll($select);
    }
    
    public function getUtWStaff()
    {
	$select = $this->select()->where("ruolo != 'admin' and ruolo != 'staff'");               
        return $this->fetchAll($select);
    }
    
    public function getOnlyStaff()
    {
	$select = $this->select()->where("ruolo != 'admin' and ruolo != 'user'");               
        return $this->fetchAll($select);
    }

}

