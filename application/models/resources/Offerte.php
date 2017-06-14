<?php

class Application_Resource_Offerte extends Zend_Db_Table_Abstract
{
    protected $_name    = 'offerte';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Offerte_Item';
    
    public function init()
    {
    }
    
    public function updateElement($data){
        $data['inizio']= date('Y-m-d', strtotime($data['inizio']));
        $data['fine']= date('Y-m-d', strtotime($data['fine']));
        $this->update($data, 'id='.$data['id']);
    }
    
    public function getElement($key)
    {
        $offerta = $this->fetchRow($this->select()->where('id = ?', $key));
        $offerta['inizio']= date('d-m-Y', strtotime($offerta['inizio']));
        $offerta['fine']= date('d-m-Y', strtotime($offerta['fine']));
        return $offerta;
    }
    
    public function getTable($paged=null)
    {
	$select = $this->select();
        if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(9)
		          	  ->setCurrentPageNumber((int) $paged);
                        foreach ($paginator as $offerta){
                                   $offerta['inizio']= date('d-m-Y', strtotime($offerta['inizio']));
                                   $offerta['fine']= date('d-m-Y', strtotime($offerta['fine']));
                        }
			return $paginator;
		}
        $offerte = $this->fetchAll($select);
        foreach ($offerte as $offerta){
            $offerta['inizio']= date('d-m-Y', strtotime($offerta['inizio']));
            $offerta['fine']= date('d-m-Y', strtotime($offerta['fine']));
        }
        return $offerte;
    }
    
    public function getOfferteAttive($paged=null)
    {
        $date = new Zend_Date();
	$select = $this->select()
                       ->where("'".$date->get('YYYY-MM-dd')."' <= fine");
        if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(9)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    }

    public function addElement($el)
    {
        $el['inizio']= date('Y-m-d', strtotime($el['inizio']));
        $el['fine']= date('Y-m-d', strtotime($el['fine']));
    	$this->insert($el);
    }
    
    public function deleteElement($key)
    {
        return $this->delete('id = ' . $key);
    }
    
    public function getOfferteCercate($cats, $desc, $azie, $paged=null)
    {
        $date = new Zend_Date();
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
        $select=$this->select()->where($string1)
                               ->where($string2)
                               ->where($string3)
                               ->where("'".$date->get('YYYY-MM-dd')."' <= fine");
        if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
                        $paginator->setItemCountPerPage(9)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    }
    
    public function getOfferteStaff($azie, $paged=null)
    {
        $string=("azienda = ''");
        foreach ($azie as $a) {$string.=" or azienda = '".$a."' ";}
        $select=$this->select()->where($string);
        if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
                        $paginator->setItemCountPerPage(4)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    }
    
    public function getOfferteScaricate()
    {
        $date = new Zend_Date();
        $select = $this->select()
                       ->where("'".$date->get('YYYY-MM-dd')."' <= fine")
                       ->order('quantita DESC')
                       ->limit(8);
        return $this->fetchAll($select);
    }
    
    public function getOfferteNew()
    {
        $date = new Zend_Date();
        $select = $this->select()
                       ->where("'".$date->get('YYYY-MM-dd')."' <= fine")
                       ->order('id DESC')
                       ->limit(8);
        return $this->fetchAll($select);
    }

}
