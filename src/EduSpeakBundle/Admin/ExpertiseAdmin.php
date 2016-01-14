<?php

namespace EduSpeakBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ExpertiseAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('score', 'text', array('label' => 'Score'))
            ->add('user', 'sonata_type_model_list', array(
                'btn_add'       => 'Add User',
                'btn_list'      => 'User list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No user selected'
            ))
            ->add('country', 'sonata_type_model_list', array(
                'btn_add'       => 'Add Country',
                'btn_list'      => 'Country list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No country selected'
            ))
            ->add('city', 'sonata_type_model_list', array(
                'btn_add'       => 'Add City',
                'btn_list'      => 'City list',
                'btn_delete'    => false,
            ), array(
                'placeholder' => 'No city selected'
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
            ->add('country')
            ->add('city')
            ->add('score')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('user.username')
            ->add('user.email')
            ->add('country.name')
            ->add('city.name')
            ->add('score')
        ;
    }
}