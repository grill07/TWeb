<?php

class Application_Form_Admin_Gestionestaff extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init()
    {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('admingeststaff');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    
        
        $staff = array();
        $utenti = $this->_adminModel->getStaff();
        foreach ($utenti as $utente){
           $staff[$utente->username] = $utente->username; 
        }
        $this->addElement('select', 'utente', array(
            'label' => 'Membro dello staff',
            'required' => true,
                'multiOptions' => $staff,
            'decorators' => $this->elementDecorators,
		));
        
        $azienda = array();
        $aziende = $this->_adminModel->getAziende();
        foreach ($aziende as $az){
           $azienda[$az->nome] = $az->nome; 
        }
        $this->addElement('select', 'azienda', array(
            'label' => 'Azienda',
            'required' => true,
                'multiOptions' => $azienda,
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('submit', 'azstaff', array(
            'label' => 'Assegna azienda',
            'decorators' => $this->buttonDecorators,
		));
        
        $this->setDecorators(array(
			'FormElements',
			array('HtmlTag', array('tag' => 'table')),
			array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
			'Form'
		));
    }
}

