<?php

namespace EduSpeakBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    protected $interests;
    protected $hasFile;
    protected $languages;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', 'text', array('required' => true))
        ->add('birthday', 'date', array(
            'widget' => 'choice',
            'input' => 'datetime',
            'format' => 'd M y',
            'years' => range(1900,2010),
            'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
            'pattern' => "{{ day }} {{ month }} {{ year }}"
        ))
        ->add('description', 'textarea', array(
            'required' => true,
            'attr'   =>  array('cols'   => '50', 'rows' => '5')
        ))
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
        ))
        ->add('spokenLanguages', 'entity', array(
            'class' => 'GeoBundle:Language',
            'choices' => $this->languages,
            'property' => 'name',
            'multiple' => true,
            'expanded' => true,
            'required' => true
        ))
        ->add('learnLanguage', 'entity', array(
            'class' => 'GeoBundle:Language',
            'property' => 'name',
            'required' => true
        ))
        ->add('file', 'file', array('required' => !$this->hasFile))
        ->add('save', 'submit', array(
            'label' => 'Enregistrer mon profil',
            'attr'   =>  array('class'   => 'btn btn-edu')
            )
        );
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

    function __construct($hasFile, $interests, $languages)
    {
        $this->interests = $interests;
        $this->languages = $languages;
        $this->hasFile = $hasFile;
    }
}
