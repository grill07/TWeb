<?php

class Application_Resource_Aziendestaff extends Zend_Db_Table_Abstract
{
    protected $_name    = 'aziendestaff';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Aziendestaff_Item';
    
    public function init()
    {
    }
    
    public function getElement($key)
    {
        return $this->fetchRow($this->select()->where('id = ?', $key));
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
        return $this->delete("id = '" . $key . "'");
    }
    
    public function getStaffAzie($staff,$azienda)
    {
        $string1=("utente = '".$staff."'");
        $string2=("azienda = '".$azienda."'");
        $select= $this->select()->where($string1)
                                ->where($string2);
        $contatore=0;
        foreach($this->fetchAll($select) as $singolaselect){
            $contatore++;
        }
        return $contatore;
    }
    
    public function getOnlyAzie($staff,$azienda)
    {
        $string1=("utente != '".$staff."'");
        $string2=("azienda = '".$azienda."'");        
        $select= $this->select()->where($string1)
                                ->where($string2);
        $contatore=0;
        foreach($this->fetchAll($select) as $singolaselect){
            $contatore++;
        }
        return $contatore;
        
    }
    

}
