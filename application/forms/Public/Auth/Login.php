<?php

class Application_Form_Public_Auth_Login extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(1,15)),
                array('Db_RecordExists',true, 
                array('table'   => 'utenti',
                      'field'   => 'username'))),
		));
        
        $this->addElement('password', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(1,15)),
                array('Db_RecordExists',true, 
                array('table'   => 'utenti',
                      'field'   => 'password'))),
		));
        
        $this->addElement('submit', 'entra', array(
            'label' => 'Entra',
		));
    }
}
