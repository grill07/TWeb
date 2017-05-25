<?php

class Application_Form_Public_Ricerca extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('Cerca');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Ricerca prodotto',
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,25))),
		));
        
        $this->addElement('submit', 'riceroff', array(
            'label' => 'Cerca',
		));
        
        $this->addElement('multiCheckbox', 'categoria', array(
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
        
        $this->addElement('multiCheckbox', 'azienda', array(
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

