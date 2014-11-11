<?php

namespace CmsMediaForce\Form;

use Zend\Form\Form;

class Corretor  extends Form
{

    public function __construct($name = 'corretor', $options = array()) {
        parent::__construct($name, $options);
        
        $this->setUseAsBaseFieldset(false);

        $this->setInputFilter(new ArquivoTextoFilter());
        $this->setAttribute('method', 'post');
        
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Descrição: ")
                ->setAttribute('placeholder','Entre com o nome');
        $this->add($nome);

        $cargo = new \Zend\Form\Element\Text("cargo");
        $cargo->setLabel("Cargo: ")
                ->setAttribute('placeholder','Entre com o cargo');
        $this->add($cargo);

        $cargo = new \Zend\Form\Element\Text("E-mail");
        $cargo->setLabel("E-mail: ")
                ->setAttribute('placeholder','Entre com o e-mail');
        $this->add($cargo);

        $foto = new \Zend\Form\Element\File('foto');
        $foto->setLabel('Escolha Sua Foto: ');
        $this->add($foto);
        
        $csrf = new \Zend\Form\Element\Csrf("security");
        $this->add($csrf);
        
        $this->add(array(
            'name' => 'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes' => array(
                'value'=>'Publicar',
                'class' => 'btn-success'
            )
        ));
                
       
    }
    
}
