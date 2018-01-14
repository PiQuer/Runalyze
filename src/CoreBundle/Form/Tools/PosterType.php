<?php

namespace Runalyze\Bundle\CoreBundle\Form\Tools;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Runalyze\Bundle\CoreBundle\Entity\Account;
use Runalyze\Bundle\CoreBundle\Entity\Sport;
use Runalyze\Bundle\CoreBundle\Entity\SportRepository;
use Runalyze\Bundle\CoreBundle\Entity\TrainingRepository;
use Runalyze\Bundle\CoreBundle\Form\AbstractTokenStorageAwareType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PosterType extends AbstractTokenStorageAwareType
{
    /** @var TrainingRepository */
    protected $TrainingRepository;

    /** @var SportRepository */
    protected $SportRepository;

    public function __construct(
        SportRepository $sportRepository,
        TrainingRepository $trainingRepository,
        TokenStorage $tokenStorage
    )
    {
        $this->SportRepository = $sportRepository;
        $this->TrainingRepository = $trainingRepository;

        parent::__construct($tokenStorage);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postertype', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Circular' => 'circular',
                    'Calendar' => 'calendar',
                    'Grid'     => 'grid',
                    'Heatmap'  => 'heatmap'
                ],
                'attr' => ['class' => 'full-size']
            ])
            ->add('year', ChoiceType::class, [
                'choices' => $this->TrainingRepository->getActiveYearsFor($this->getAccount(), null, 2),
                'choice_label' => function($year, $key, $index) {
                    return $year;
                },
            ])
            ->add('title', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 15]
            ])
            ->add('athlete', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 14]
            ])
            ->add('sport', ChoiceType::class, [
                'choices' => $this->SportRepository->findWithDistancesFor($this->getAccount()),
                'choice_label' => function($sport, $key, $index) {
                    /** @var Sport $sport */
                    return $sport->getName();
                },
                'choice_value' => 'getId',
            ])
            ->add('size', ChoiceType::class, [
                'choices' => [
                    'DIN A4' => 4000,
                    'DIN A3' => 5000,
                    'DIN A2' => 7000,
                    'DIN A1' => 10000,
                    'DIN A0' => 14000
                 ],
            ])
            ->add('unit', ChoiceType::class, [
                'choices' => [
                    'metric' => 'metric',
                    'imperial' => 'imperial',
                ],
            ])
            ->add('backgroundColor', ColorType::class, [
                'data' => '#222222',
                'label' => 'Background'
            ])
            ->add('trackColor', ColorType::class, [
                'data' => '#4DD2FF',
                'label' => 'Activity'
            ])
            ->add('useTrackColorTwo', CheckboxType::class, [
                'required' => false,
                'label' => 'Use Gradient Coloring'
            ])
            ->add('trackColorTwo', ColorType::class, [
                'label' => 'Activity (Gradient Coloring)',
                'data' => '#4DD2FF',
            ])
            ->add('textColor', ColorType::class, [
                'data' => '#FFFFFF',
                'label' => 'Text'
            ])
            ->add('raceColor', ColorType::class, [
                'data' => '#FFFF00',
                'label' => 'Race'
            ])
            ->add('circularRings', CheckboxType::class, [
                'required' => false,
                'label' => 'Draw distance rings'
            ])
            ->add('circularRingColor', ColorType::class, [
                'data' => '#FFFF00',
                'label' => 'Color of distance rings'
            ])
            ->add('locationCenter', TextType::class, [
                'required' => false
            ])
            ->add('locationRadius', IntegerType::class, [
                'required' => false
            ])
        ;
    }
}
