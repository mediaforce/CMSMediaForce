<?php

namespace CmsMediaForce\Form;

use Zend\Form\Form;

class Link  extends Form
{

    public function __construct($name = 'user', array $categorias = null, $options = array()) {
        parent::__construct($name, $options);
        
        $this->setInputFilter(new LinkFilter());
        $this->setAttribute('method', 'post');
        
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new \Zend\Form\Element\Text("descricao");
        $nome->setLabel("Descrição: ")
                ->setAttribute('placeholder','Entre com a descrição do link')
                ->setAttribute('class', 'form-input');
        $this->add($nome);

        $href = new \Zend\Form\Element\Url('href');
        $href->setLabel('Url do Link: ')
            ->setAttribute('placeholder','Entre com a url do link');
        $this->add($href);
        
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
