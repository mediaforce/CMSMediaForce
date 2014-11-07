<?php

namespace CmsMediaForce\Form;

use Zend\Form\Form;

class ArquivoTexto  extends Form
{

    public function __construct($name = 'arquivo-texto', array $categorias = null, $options = array()) {
        parent::__construct($name, $options);
        
        $this->setInputFilter(new PostFilter());
        $this->setAttribute('method', 'post');
        
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new \Zend\Form\Element\Text("descricao");
        $nome->setLabel("Descrição: ")
                ->setAttribute('placeholder','Entre com a descrição do arquivo')
                ->setAttribute('class', 'form-input');
        $this->add($nome);

        $checkbox = new \Zend\Form\Element\Checkbox('expirar');
        $checkbox->setLabel('Não Expirar Arquivo: ')
                    ->setUseHiddenElement(true)
                    ->setCheckedValue("nao")
                    ->setUncheckedValue("sim");
        $this->add($checkbox);
    
        $expirar = new \Zend\Form\Element\Date('expiresAt');
        $expirar
            ->setLabel('Expira Em:')
            ->setAttributes(array(
                'min'  => date("Y-m-d", mktime(0, 0, 0, date("m"),  date("d")+1,  date("Y"))),
                'max'  => date("Y-m-d", mktime(0, 0, 0, date("m"),  date("d"),  date("Y")+1)),
                'step' => '1', // days; default step interval is 1 day
            ))
            ->setOptions(array(
                'format' => 'Y-m-d'
            ));
        $this->add($expirar);

        $cats = new \Zend\Form\Element\Select();
        $cats->setLabel("Categoria: ")
                ->setName("categoria")
                ->setOptions(array('value_options' => $categorias));
        $this->add($cats);

        $arquivo = new \Zend\Form\Element\File('arquivo');
        $arquivo->setLabel('Escolha o Arquivo: ');
        $this->add($arquivo);
        
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
