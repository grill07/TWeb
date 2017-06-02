<?php
class Application_Form_Admin_Inserisci extends Zend_Form
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
		));
        
        $this->addElement('text', 'tipologia', array(
            'label' => 'Tipologia azienda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,50))),
		));
        
        $this->addElement('text', 'localizzazione', array(
            'label' => 'Sede azienda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
		));
        $this->addElement('text', 'ragione', array(
            'label' => 'Ragione',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,1000))),
		));
        
        
        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
		));
        $this->addElement('file', 'logo', array(
        	'label' => 'Immagine',
        	'destination' => APPLICATION_PATH . '/../public/img/aziende',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 102400),
        			array('Extension', false, array('jpg', 'gif', 'png'))),
                ));
        
        
        $this->addElement('submit', 'inserazienda', array(
            'label' => 'Inserisci',
		));
    }
}

