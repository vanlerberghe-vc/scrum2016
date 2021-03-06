<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservatieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datum', 'date',
                array(
                    'attr' => array('class' => 'datepicker'),
                    'widget' => 'single_text',
                    'required' => true,
                    'label' => 'Datum'
                )
            )
            ->add('naam', TextType::class,
                array(
                    'required' => true,
                    'label' => 'Naam'
                )
            )
            ->add('opdrachtgever', TextType::class,
                array(
                    'required' => false,
                    'label' => 'Opdrachtgever'
                )
            )
            ->add('aantalDeelnemers', TextType::class,
                array(
                    'required' => true,
                    'label' => 'Aantal deelnemers'
                )
            )
            ->add('aanvang', 'time',
                array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                //    'date_format' => 'HH:mm',
                    'with_seconds' => false,
                    'view_timezone' => 'Europe/Brussels',
                    'model_timezone' => 'Europe/Brussels',
                    'required' => true,
                    'label' => 'Aankomstuur',
                    'placeholder' => array(
                        'hour' => 'Uur', 'minute' => 'Minuten',
                    )
                )
            )
            ->add('commentaar', 'textarea',
                array(
                    'required' => false
                )
            )
            ->add('afdeling', TextType::class,
                array(
                    'required' => false,
                    'label' => 'Afdeling'
                    )
                )
            ->add('product', TextType::class,
                array(
                    'required' => false,
                    'label' => 'Product'
                )
            )
            ->add('project', TextType::class,
                array(
                    'required' => false,
                    'label' => 'Project'
                )
            )
            ->add('rekening', TextType::class,
                array(
                    'required' => false,
                    'label' => 'Rekening'
                )
            )
            ->add('reservatie_regels')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reservatie'
        ));
    }
}
