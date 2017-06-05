<?php
class Application_Form_Admin_Inserisci extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init()
    {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('admininser');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome azienda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'tipologia', array(
            'label' => 'Tipologia azienda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,50))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'localizzazione', array(
            'label' => 'Sede azienda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'ragione', array(
            'label' => 'Ragione',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,1000))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione',
                'cols' => '60', 'rows' => '8',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('file', 'logo', array(
        	'label' => 'Immagine',
                'required' => true,
        	'destination' => APPLICATION_PATH . '/../public/img/aziende',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 102400),
        			array('Extension', false, array('jpg', 'gif', 'png'))),
                'decorators' => $this->fileDecorators,
                ));
        
        
        $this->addElement('submit', 'inserazienda', array(
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

