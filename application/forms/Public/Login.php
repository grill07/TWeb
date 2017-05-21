<?php

class Application_Form_Public_Login extends Zend_Form
{
    public function init()
    {
        //$this->_publicModel = new Application_Model_Public(); da aggiungere quando il model è completo
        $this->setMethod('post');
        $this->setName('Login');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => 'Il tuo nome utente',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => 'La tua password',
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        $this->addElement('submit', 'add', array(
            'label' => 'Entra',
		));
    }
}
