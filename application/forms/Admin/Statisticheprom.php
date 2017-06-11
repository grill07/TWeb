<?php

class Application_Form_Admin_Statisticheprom extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init()
    {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('adminstatprom');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    
        
        $nomi = array();
        $offerte = $this->_adminModel->getOfferte();
        foreach ($offerte as $offerta){
           $nomi[$offerta->id] = $offerta->id; 
        }
        $this->addElement('select', 'offerta', array(
            'label' => 'Offerte attive e non',
            'required' => true,
                'multiOptions' => $nomi,
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('submit', 'statprom', array(
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
