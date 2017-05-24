<?php

class Application_Form_Public_Ricerca extends Zend_Form
{
    public function init()
    {
        //$this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('Cerca');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'Ricerca', array(
            'label' => 'Ricerca prodotto',
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('submit', 'cercaprodotto', array(
            'label' => 'Cerca',
		));
        
        $this->addElement('multiCheckbox', 'categorie', array(
            'label' => 'Categorie prodotti',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => array(
                        'prima' => 'Elettronica',
                        'seconda' => 'Abbigliamento', 
                        'terza' => 'Alimenti',
                        'quarta' => 'Giardinaggio',
                        )
		));
        
        $this->addElement('multiCheckbox', 'aziende', array(
            'label' => 'Aziende',
            'required' => false,
            'checked_value' => 'good',
            'unchecked_value' => 'bad',
            'multiOptions' => array(
                        'prima' => 'Asus',
                        'seconda' => 'Zara', 
                        'terza' => 'Barilla',
                        'quarta' => 'Boh',
                        )
		));
    }
}

