<?php

class Application_Form_Staff_Modofferta extends Zend_Form
{
    protected $_staffModel;
    
    public function init()
    {
        $this->_staffModel = new Application_Model_Staff();
        $this->setMethod('post');
        $this->setName('staffmodoff');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');    
    }
    
    public function setValues($values){ //per precompilare la form i valori vengono settati dopo l'init
        $this->addElement('text', 'nome', array(
            'label' => 'Nome prodotto',
            'value' => $values['nome'],
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,30))),
		));
        
        
        $this->addElement('text', 'descrizione', array(
            'label' => 'Descrizione prodotto',
            'value' => $values['descrizione'],
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,2000))),
		));
        
        $this->addElement('text', 'categoria', array(
            'label' => 'Categoria prodotto',
            'value' => $values['categoria'],
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,20))),
		));
        
        $nomi = array();
        $aziende = $this->_staffModel->getAziende();
        foreach ($aziende as $azienda){
           $nomi[$azienda->nome] = $azienda->nome; 
        }
        $this->addElement('select', 'azienda', array(
            'label' => 'Azienda',
            'value' => $values['azienda'],
            'required' => false,
        	'multiOptions' => $nomi,
        ));
        
        $this->addElement('text', 'immagine', array(
            'label' => 'Immagine prodotto',
            'value' => $values['immagine'],
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('text', 'inizio', array(
            'label' => 'Data inizio offerta',
            'value' => $values['inizio'],
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array (array('date', false, array('MM/dd/yyyy'))),
		));
        
        $this->addElement('text', 'fine', array(
            'label' => 'Data fine offerta',
            'value' => $values['fine'],
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array (array('date', false, array('MM/dd/yyyy'))),
		));
        
        $this->addElement('text', 'prezzo', array(
            'label' => 'Prezzo originale',
            'value' => $values['prezzo'],
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('Float')),
		));
        
        $this->addElement('text', 'tipologia', array(
            'label' => 'Sconto da applicare',
            'value' => $values['tipologia'],
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('Int')),
		));
        
        $this->addElement('hidden', 'quantita', array(
            'value' => $values['quantita'],
            ));
        
        $this->addElement('hidden', 'id', array(
            'value' => $values['id'],
            ));
        
        $this->addElement('submit', 'modoff', array(
            'label' => 'Modifica',
		));
    }
}