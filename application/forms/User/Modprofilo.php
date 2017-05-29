<?php

class Application_Form_User_Modprofilo extends Zend_Form
{
    protected $_userModel;
    
    public function init()
    {
        $this->_userModel = new Application_Model_User();
        $this->setMethod('post');
        $this->setName('utenteprofilo');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
    }
    
    public function setValues($values){ //bisogna fare così per avere la form precompilata
       $this->addElement('text', 'nome', array(
            'label' => 'Nome',
           'value' => $values['nome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
		));
        
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'value' => $values['cognome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'value' => $values['genere'],
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                        'Maschile' => 'M',
                        'Femminile' => 'F',
                        ),
		));
        
        $this->addElement('text', 'eta', array(
            'label' => 'Età',
            'value' => $values['eta'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Int'),
		));
        
        $this->addElement('text', 'mail', array(
            'label' => 'Email',
            'value' => $values['mail'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
		));
        
        $this->addElement('text', 'telefono', array(
            'label' => 'N.telefono',
            'value' => $values['telefono'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array ('int'),
		));
        
        $this->addElement('hidden', 'username', array(
            'value' => 'user1',
            ));
        
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'value' => $values['password'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,15))),
		));
                
        $this->addElement('submit', 'modifica', array(
            'label' => 'Salva Modifiche',
		)); 
    }
}

