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
        
        
        $this->addElement('textarea', 'descrizione', array(
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
        
        $nomi = array();
        $aziende = $this->_staffModel->getAziende();
        foreach ($aziende as $azienda){
           $nomi[$azienda->nome] = $azienda->nome; 
        }
        $this->addElement('select', 'azienda', array(
            'label' => 'Azienda',
            'required' => true,
        	'multiOptions' => $nomi,
        ));
        
        $this->addElement('file', 'immagine', array(
        	'label' => 'Immagine',
        	'destination' => APPLICATION_PATH . '/../public/img/prodotti',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 102400),
        			array('Extension', false, array('jpg', 'gif'))),
                ));
        
        $this->addElement('text', 'inizio', array(
            'label' => 'Data inizio offerta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('dd/MM/yyyy'))),
		));
        
        $this->addElement('text', 'fine', array(
            'label' => 'Data fine offerta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('dd/MM/yyyy'))),
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
            'validators' => array(array('StringLength',true, array(1,10))),
		));
        
        $this->addElement('hidden', 'quantita', array(
            'value' => 0,
            ));
        
        $this->addElement('submit', 'inserofferta', array(
            'label' => 'Inserisci',
		));
    }
}
