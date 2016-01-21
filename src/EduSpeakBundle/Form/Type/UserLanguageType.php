<?php

namespace EduSpeakBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserLanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id');
        $builder->add('languages', "collection", array(
                'type' => new LanguageType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GeoBundle\Entity\UserLanguage',
        ));
    }

    public function getName()
    {
        return 'userlanguage';
    }
}
