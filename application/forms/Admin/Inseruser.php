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
    
    
        $this->addElement('textarea', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'genere', array(
            'label' => 'Genere',
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                    'M' => 'Maschile',
                'F' => 'Femminile' ),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'eta', array(
            'label' => 'età',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'mail', array(
            'label' => 'Mail',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'telefono', array(
            'label' => 'Numero di telefono',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'username', array(
            'label' => 'Username',
            'attribs' => array('readonly' => 'true'),
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'ruolo', array(
            'label' => 'Ruolo',
            'filters' => array('StringTrim'),
            'required' => true,
            'option' => 'staff',
            'decoretors' => $this->elementDecorators,
		));
        
        $this->addElement('submit', 'inseruser', array(
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