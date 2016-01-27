<?php

namespace GeoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CountryAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('language', 'sonata_type_model_list', array(
                'btn_add'       => 'Add Language',
                'btn_list'      => 'Language list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No language selected'
            ))
            ->add('flag', 'sonata_type_model_list', array(
                'btn_add'       => 'Add Flag',
                'btn_list'      => 'Flag list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No flag selected'
            ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('language')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('language.name')
            ->add('flag')
        ;
    }
}