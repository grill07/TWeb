<?php

class Application_Form_Admin_Modutenti extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init() {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('adminusermod');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    }
    
    public function setValues($values) {
        $this->addElement('textarea', 'nome', array(
            'label' => 'Nome',
            'value' => $values['nome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'cognome', array(
            'label' => 'Cognome',
            'value' => $values['cognome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'genere', array(
            'label' => 'Genere',
            'value' => $values['genere'],
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                    'M' => 'Maschile', 'F' => 'Femminile' ),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'eta', array(
            'label' => 'età',
            'value' => $values['eta'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'mail', array(
            'label' => 'Mail',
            'value' => $values['nome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'telefono', array(
            'label' => 'Numero di telefono',
            'value' => $values['telefono'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'username', array(
            'label' => 'Username',
            'attribs' => array('readonly' => 'true'),
            'value' => $values['username'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'password', array(
            'label' => 'Password',
            'value' => $values['password'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'ruolo', array(
            'label' => 'Ruolo',
            'value' => $values['ruolo'],
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                        'staff' => 'Staff',  'User' => 'User'  ),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('submit', 'moduser', array(
            'label' => 'Modifica',
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