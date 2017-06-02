<?php

class Application_Form_Admin_Modazienda extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init()
    {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('adminmodaz');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data'); 
        
         
    }
    
    public function setValues($values){ //per precompilare la form i valori vengono settati dopo l'init
        $this->addElement('text', 'nome', array(
            'label' => 'Nome azienda',
            'attribs' => array('readonly' => 'true'),
            'value' => $values['nome'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
		));
        
        
        $this->addElement('text', 'tipologia', array(
            'label' => 'Tipologia azienda',
            'value' => $values['tipologia'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,50))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'localizzazione', array(
            'label' => 'Sede azienda',
            'value' => $values['localizzazione'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'ragione', array(
            'label' => 'Ragione',
            'value' => $values['ragione'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,1000))),
            'decorators' => $this->elementDecorators,
		));
        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione',
                'cols' => '60', 'rows' => '8',
            'value' => $values['descrizione'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('file', 'logo', array(
        	'label' => 'Immagine',
        	'destination' => APPLICATION_PATH . '/../public/img/aziende',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 102400),
        			array('Extension', false, array('jpg', 'gif', 'png'))),
            'decorators' => $this->fileDecorators,
                ));
        $this->addElement('submit', 'modaz', array(
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



