<?php

namespace Runalyze\Bundle\CoreBundle\Form\Settings;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ClientSettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, [
                'label' => 'Sync activities after this date',
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'html5' => false,
                'required' => false,
                'attr' => ['class' => 'pick-a-date small-size', 'placeholder' => 'dd.mm.YYYY']
            ])
            ->add('enabled', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => true,
                    'No' => false
                ),
                'label' => 'Sync enabled'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Runalyze\Bundle\CoreBundle\Entity\AccountClientSettings'
        ));
    }
}
