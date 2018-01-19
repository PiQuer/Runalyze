<?php

namespace Runalyze\Bundle\CoreBundle\Form\Settings\Zones;

use Runalyze\Bundle\CoreBundle\Form\Settings\Zones\HeartrateZoneCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\NotBlank;

class HeartrateZoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ranges', CollectionType::class, [
                'entry_type' => HeartrateZoneCollectionType::class,
                'mapped' => true,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }

    /**
     * @param  mixed $value
     * @return array
     */
    public function transform($value)
    {
        if (!($value instanceof Round)) {
            return null;
        }

        /* @var Round $value */

        return [
            'distance' => $value->getDistance(),
            'duration' => $value->getDuration(),
            'isActive' => $value->isActive()
        ];
    }

    /**
     * @param  mixed $value
     * @return null|Round
     */
    public function reverseTransform($value)
    {
        if (is_array($value) && isset($value['duration']) && array_key_exists('distance', $value)) {
            return new Round(
                $value['distance'],
                $value['duration'],
                (bool)$value['isActive']
            );
        }

        return null;
    }

}