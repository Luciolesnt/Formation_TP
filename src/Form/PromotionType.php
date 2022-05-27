<?php

namespace App\Form;

use App\Entity\Promotion;
use App\Entity\Formateur;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('formation')
            ->add(
                'formateur',
                EntityType::class,
                [
                    'class' => Formateur::class,
                    // 'query_builder' => function (FormateurRepository $er) {
                    //     return $er->getAllWithoutPromotion();
                    // },
                    'choice_label' => 'nom',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
