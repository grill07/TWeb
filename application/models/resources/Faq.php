<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'faq';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Faq_Item';

    public function init()
    {
    }
    
    public function getElement($key)
    {
        return $this->fetchRow($this->select()->where('id = ?', $key));
    }
    
    public function getTable($paged=null)
    {
	$select = $this->select();
	if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(3)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    }
    
    public function addElement($el)
    {
    	return $this->insert($el);
    }
    
    public function deleteElement($key)
    {
        return $this->delete('id = ' . $key);
    }

}

