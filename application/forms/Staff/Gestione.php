<?php

class Application_Form_Staff_Gestione extends Zend_Form
{
    protected $_staffModel;
    
    public function init()
    {
        $this->setMethod('post');
        $this->setName('gestione');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');   
    }
    
    public function setId($id){ //per precompilare la form i valori vengono settati dopo l'init
        $this->addElement('hidden', 'id', array(
            'value' => $id,
            ));
        
        $this->addElement('submit', 'modoff', array(
            'label' => 'Modifica',
		));
        
        $this->addElement('submit', 'elimoff', array(
            'label' => 'Elimina',
		));  
    }
}