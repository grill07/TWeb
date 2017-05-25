<?php

class Application_Form_Public_Registrati extends Zend_Form
{
    public function init()
    {
        //$this->_publicModel = new Application_Model_Public(); da aggiungere quando il model è completo
        $this->setMethod('post');
        $this->setName('Registrati');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => '',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => '',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'required' => true,
        		'description' => '',
            'required' => true,
			'multiOptions' => array('Maschile','Femminile'),
		));
        
        $this->addElement('select', 'eta', array(
            'label' => 'Età',
            'required' => true,
        		'description' => '',
            'required' => true,
			'multiOptions' => array('1','2'),
		));
        
        $this->addElement('text', 'email', array(
            'label' => 'Email',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => '',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('text', 'telefono', array(
            'label' => 'Telefono',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => '',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => '',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => '',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('submit', 'add', array(
            'label' => 'Registrati',
		));
    }
}

