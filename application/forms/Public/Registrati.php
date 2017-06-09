<?php

class Application_Form_Public_Registrati extends Zend_Form
{
    protected $_publicModel;
    
    public function init()
    {
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('registrati');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'required' => true,
            'multiOptions' => array(
                        'M' => 'Maschile',
                        'F' => 'Femminile',
                        ),
		));
        
        $this->addElement('text', 'eta', array(
            'label' => 'Età',
            'filters' => array('StringTrim'),
            'required' => true,
	    'validators' => array('Int',array('StringLength',true, array(1,2))),
		));
        
        $this->addElement('text', 'mail', array(
            'label' => 'Email',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
		));
        
        $this->addElement('text', 'telefono', array(
            'label' => 'N.telefono',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array ('digits',array('StringLength',true, array(1,12))),
		));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(4,15)),
                array('Db_NoRecordExists',true, 
                array('table'   => 'utenti',
                      'field'   => 'username'))),
		));
        
        $this->addElement('password', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(4,15))),
		));
        
        $this->addElement('hidden', 'ruolo', array(
            'value' => 'user',
            ));
        
        $this->addElement('submit', 'add', array(
            'label' => 'Registrati',
		));
    }
}

