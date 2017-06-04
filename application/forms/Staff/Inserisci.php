<?php

class Application_Form_Staff_Inserisci extends App_Form_Abstract
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
            'decorators' => $this->elementDecorators,
		));
        
        
        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione prodotto',
               'cols' => '60', 'rows' => '8',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
		));
        
        $cat = array();
        $categorie = $this->_staffModel->getCategorie();
        foreach ($categorie as $categoria){
           $cat[$categoria->categoria] = $categoria->categoria; 
        }
        $this->addElement('select', 'categoria', array(
            'label' => 'Categoria prodotto',
            'required' => true,
                'multiOptions' => $cat,
            'decorators' => $this->elementDecorators,
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
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('file', 'immagine', array(
        	'label' => 'Immagine',
        	'destination' => APPLICATION_PATH . '/../public/img/prodotti',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 102400),
        			array('Extension', false, array('jpg', 'png'))),
                'decorators' => $this->elementDecorators,
                ));
        
        $this->addElement('text', 'inizio', array(
            'label' => 'Data inizio offerta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('dd/MM/yyyy'))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'fine', array(
            'label' => 'Data fine offerta',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('dd/MM/yyyy'))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'prezzo', array(
            'label' => 'Prezzo originale',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('Float',true,array('locale' => 'en')),array('StringLength',true, array(1,10))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'tipologia', array(
            'label' => 'Sconto da applicare',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,10))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('hidden', 'quantita', array(
            'value' => 0,
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('submit', 'inserofferta', array(
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
