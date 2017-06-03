<?php

class Application_Form_Admin_Inseruser extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init() {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('admininseruser');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    
       $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
           'decorators' => $this->elementDecorators,
		));
        
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                        'M' => 'Maschile',
                        'F' => 'Femminile',
                        ),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'eta', array(
            'label' => 'Età',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Int',array('StringLength',true, array(1,2))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'mail', array(
            'label' => 'Email',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'telefono', array(
            'label' => 'N.telefono',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array ('digits',array('StringLength',true, array(1,12))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('StringLength',true, array(1,12))),
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,15))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('select', 'ruolo', array(
            'label' => 'Ruolo',
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                        'staff' => 'Staff'),
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('submit', 'modifica', array(
            'label' => 'Salva Modifiche',
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