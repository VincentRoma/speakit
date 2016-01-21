<?php

namespace EduSpeakBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array('required' => true))
        ->add('birthday', 'date', array(
            'widget' => 'choice',
            'input' => 'datetime',
            'format' => 'd/M/y',
            'years' => range(1950,2005),
            'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
            'pattern' => "{{ day }}/{{ month }}/{{ year }}"
        ))
        ->add('cityPrecision', 'text', array('required' => true))
        ->add('description', 'textarea', array('required' => true))
        // city a supprimer quand google donne la city la plus proche
        ->add('city', 'entity', array(
            'class' => 'GeoBundle:City',
            'property' => 'name',
            'required' => true
        ))
        ->add('interests', 'entity', array(
            'class' => 'ContentBundle:Interest',
            'choices' => $this->interests,
            'property' => 'name',
            'multiple' => true,
            'expanded' => true,
            'required' => true
        ));

        $builder->add('userLanguages', "collection", array(
                'type' => new UserLanguageType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            )
        )
        ->add('file', 'file', array('required' => !$this->hasFile))
        ->add('save', 'submit', array('label' => 'Modify Profile'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EduSpeakBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'user';
    }

    function __construct($hasFile, $interests)
    {
        $this->interests = $interests;
        $this->hasFile = $hasFile;
    }
}
