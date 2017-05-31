<?php

class Application_Form_Staff_Modprofilo extends Zend_Form
{
    protected $_staffModel;
    
    public function init()
    {
        $this->_staffModel = new Application_Model_Staff();
        $this->setMethod('post');
        $this->setName('staffprofilo');
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
                        'M' => 'Maschile',
                        'F' => 'Femminile',
                        ),
		));
        
        $this->addElement('text', 'eta', array(
            'label' => 'Età',
            'value' => $values['eta'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Int',array('StringLength',true, array(1,2))),
		));
        
        $this->addElement('text', 'mail', array(
            'label' => 'Email',
            'value' => $values['mail'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
		));
        
        $this->addElement('text', 'telefono', array(
            'label' => 'N.telefono',
            'value' => $values['telefono'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array ('digits',array('StringLength',true, array(1,12))),
		));
        
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'value' => $values['password'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,15))),
		));
               
        $this->addElement('hidden', 'username', array(
            'value' => $values['username'],
            ));
        
        $this->addElement('hidden', 'ruolo', array(
            'value' => $values['ruolo'],
            ));
        
        $this->addElement('submit', 'modifica', array(
            'label' => 'Salva Modifiche',
		)); 
    }
}