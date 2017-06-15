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
        $this->addElement('select', 'ruolo', array(
            'label' => 'Ruolo',
            'value' => $values['ruolo'],
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                        'staff' => 'Staff',  'User' => 'User'  ),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'attribs' => array('readonly' => 'true'),
            'value' => $values['username'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(1,15))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'value' => $values['password'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(1,15))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'value' => $values['nome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'value' => $values['cognome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'value' => $values['genere'],
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                    'M' => 'Maschile', 'F' => 'Femminile' ),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'eta', array(
            'label' => 'Età',
            'value' => $values['eta'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Int',array('StringLength',true, array(1,11))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'mail', array(
            'label' => 'Email',
            'value' => $values['mail'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'telefono', array(
            'label' => 'Numero di telefono',
            'value' => $values['telefono'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('digits',array('StringLength',true, array(1,12))),
            'decorators' => $this->elementDecorators,
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