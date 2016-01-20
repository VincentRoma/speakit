<?php

namespace GeoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserLanguageAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('score', 'text', array('label' => 'Score'))
            ->add('spoken', 'choice', array(
                'choices' => array('yes' => true, 'no' => false),
                'choices_as_values' => true,
            ))
            ->add('user', 'sonata_type_model_list', array(
                'btn_add'       => 'Add User',
                'btn_list'      => 'User list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No user selected'
            ))
            ->add('language', 'sonata_type_model_list', array(
                'btn_add'       => 'Add Language',
                'btn_list'      => 'Language list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No language selected'
            ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('user.username')
            ->add('user.email')
            ->add('language')
            ->add('score')
            ->add('spoken', null, array(
                'operator_type' => 'sonata_type_boolean'
            ))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('user.username')
            ->add('user.email')
            ->add('language.name')
            ->add('score')
            ->add('spoken', 'boolean')
        ;
    }
}