<?php

class Application_Resource_Offerte extends Zend_Db_Table_Abstract{
    
    protected $_name    = 'offerte';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Offerte_Item';
    
    public function init(){
        
    }
    
    public function getTable(){
        $select = $this->select();
        return $this->fetchAll($select);
    }
    
    public function getOffertaByNome($nome)
    {
        return $this->fetchRow($this->select()->where('nome = ?', $nome));
    }
    
    public function addElement($offerta){
        $this->insert($offerta);
    }
}

