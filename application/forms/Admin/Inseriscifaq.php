<?php

class Application_Form_Admin_Inseriscifaq extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init() {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('admininsereriscifaq');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('textarea', 'domanda', array(
            'label' => 'Domanda',
                'cols' => '60', 'rows' => '8',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'risposta', array(
            'label' => 'Risposta',
                'cols' => '60', 'rows' => '8',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
		));
        
       
        $this->addElement('submit', 'insfaq', array(
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



