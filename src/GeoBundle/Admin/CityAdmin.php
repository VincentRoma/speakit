<?php

namespace GeoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CityAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('slider', 'choice', array(
                'choices' => array('yes' => true, 'no' => false),
                'choices_as_values' => true,
            ))
            ->add('country', 'sonata_type_model_list', array(
                'btn_add'       => 'Add Country',
                'btn_list'      => 'Country list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No country selected'
            ))
            ->add('picture', 'sonata_type_model_list', array(
                'btn_add'       => 'Add Picture',
                'btn_list'      => 'Picture list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No picture selected'
            ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('slider', null, array(
                'operator_type' => 'sonata_type_boolean'
            ))
            ->add('country')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('slider', 'boolean')
            ->add('country.name')
            ->add('picture')
        ;
    }
}