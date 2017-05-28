<?php

class Application_Form_Staff_Profilo extends Zend_Form
{
    protected $_staffModel;
    
    public function init()
    {
        $this->setMethod('post');
        $this->setName('profilo');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');   
    }
    
    public function setUser($user){ //per precompilare la form i valori vengono settati dopo l'init
        $this->addElement('hidden', 'username', array(
            'value' => $user,
            ));
        
        $this->addElement('submit', 'modoff', array(
            'label' => 'Modifica profilo',
		));
    }
}
