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
            'description' => 'Il tuo nome utente',
            'validators' => array(array('StringLength',true, array(4,15))),
		));
        
        $this->addElement('password', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'description' => 'La tua password',
            'validators' => array(array('StringLength',true, array(4,15))),
		));
        
        $this->addElement('submit', 'entra', array(
            'label' => 'Entra',
		));
    }
}