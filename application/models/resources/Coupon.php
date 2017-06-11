<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract
{
    protected $_name    = 'coupon';
    protected $_primary  = 'id';
    protected $_rowClass = 'Application_Resource_Coupon_Item';
    
    public function init()
    {
    }
    
    public function getElement($key)
    {
        return $this->fetchRow($this->select()->where('id = ?', $key));
    }
    
    public function getElementByUaO($user, $off)
    {
        return $this->fetchRow($this->select()->where('utente = ?', $user)->where('offerta = ?', $off));
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
    
    public function getCoupon()
    {
	$select = $this->select();
        $contatore=0;
        foreach ($this->fetchAll($select) as $singolocoupon){
            $contatore++;
        }
        return $contatore;
    }
    
    public function getCouponUser($user)
    {
        $select= $this->select()->where('utente = ?', $user);
        $contatore=0;
        foreach ($this->fetchAll($select) as $singolocoupon){
            $contatore++;
        }
        return $contatore;
    }
    
    public function getCouponProm($off)
    {
        $select= $this->select()->where('offerta = ?', $off);
        $contatore=0;
        foreach ($this->fetchAll($select) as $singolocoupon){
            $contatore++;
        }
        return $contatore;
    }
    

}