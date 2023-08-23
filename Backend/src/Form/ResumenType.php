<?php

namespace App\Form;

use App\Entity\Resumen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResumenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('años')
            ->add('n_socios')
            ->add('n_voluntarios')
            ->add('gastos')
            ->add('ingresos')
            ->add('n_rrss')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Resumen::class,
        ]);
    }
}
