<?php

class Application_Form_Admin_Inseriscitip extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init() {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('admininsereriscitip');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'categoria', array(
            'label' => 'Nuova categoria',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
            ));

        $this->addElement('submit', 'inserisci', array(
            'label' => 'Inserisci',
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
