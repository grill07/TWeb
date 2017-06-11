<?php

class Application_Form_Admin_Statisticheuser extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init()
    {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('adminstatuser');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    
        
        $nomi = array();
        $utenti = $this->_adminModel->getUtenteWStaff();
        foreach ($utenti as $utente){
           $nomi[$utente->username] = $utente->username; 
        }
        $this->addElement('select', 'utente', array(
            'label' => 'Utenti registrati',
            'required' => true,
                'multiOptions' => $nomi,
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('submit', 'statuser', array(
            'label' => 'Visualizza statistiche',
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


