<?php

class Application_Resource_Offerte extends Zend_Db_Table_Abstract
{
    protected $_name    = 'offerte';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Offerte_Item';
    
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
        return $this->delete('id = ' . $key);
    }
    
    public function getOfferteCercate($cats, $desc, $azie)
    {
        if(count($cats)==0){$string1=("categoria like '%'");} //se l'utente non ha selezionato nessuna categoria vanno bene tutte
        else{
            $string1=("categoria = ''");
            foreach ($cats as $c) {$string1.=" or categoria = '".$c."' ";}
            }
        $string2=("descrizione like '%'");
              foreach ($desc as $d) {$string2.=" and descrizione like '%".$d."%' ";}
        if(count($azie)==0){$string3=("azienda like '%'");} //se l'utente non ha selezionato nessuna azienda vanno bene tutte
        else{
            $string3=("azienda = ''");
            foreach ($azie as $a) {$string3.=" or azienda = '".$a."' ";}
            }
        $where=$this->select()->where($string1)
                              ->where($string2)
                              ->where($string3);
        return $this->fetchAll($where);
    }
    
    public function getOfferteScaricate()
    {
        $select = $this->select();
        return $this->fetchAll($select);
    }
    
    public function getOfferteNew()
    {
        $select = $this->select()
                       ->order(id);
        return $this->fetchAll($select);
    }

}
