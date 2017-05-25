<?php

class Application_Form_Staff_Inserisci extends Zend_Form
{
    protected $_staffModel;
    
    public function init()
    {
        $this->_staffModel = new Application_Model_Staff();
        $this->setMethod('post');
        $this->setName('staffinser');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome prodotto',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
		));
        
        
        $this->addElement('text', 'descrizione', array(
            'label' => 'Descrizione prodotto',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
		));
        
        $this->addElement('text', 'categoria', array(
            'label' => 'Categoria prodotto',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('text', 'azienda', array(
            'label' => 'Azienda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,30))),
		));
        
        $this->addElement('text', 'immagine', array(
            'label' => 'Immagine prodotto',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('text', 'inizio', array(
            'label' => 'Data inizio offerta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('MM/dd/yyyy'))),
		));
        
        $this->addElement('text', 'fine', array(
            'label' => 'Data fine offerta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('MM/dd/yyyy'))),
		));
        
        $this->addElement('text', 'prezzo', array(
            'label' => 'Prezzo originale',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('Float')),
		));
        
        $this->addElement('text', 'tipologia', array(
            'label' => 'Sconto da applicare',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('Int')),
		));
        
        $this->addElement('submit', 'inserofferta', array(
            'label' => 'Inserisci',
		));
    }
}
