<?php

namespace Runalyze\Bundle\CoreBundle\Form\Settings\Zones;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Runalyze\Bundle\CoreBundle\Form\Type\HeartRateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HeartrateZoneCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true
            ])
            ->add('range_from', HeartRateType::class, [
                'required' => false
            ])
            ->add('range_to', HeartRateType::class, [
                'required' => false
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
