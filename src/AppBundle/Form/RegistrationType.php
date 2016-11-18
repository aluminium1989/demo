<?php
/**
 * ${description}
 *
 * @category   Oro
 * @package    Oro_
 * @copyright  Copyright (c) 2016 Oro Inc. DBA MageCore (http://www.magecore.com)
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Router;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dates = range(1880, 2010);

        $builder
            ->add('login', TextType::class)
            ->add('firstName', TextType::class, array('required' => false))
            ->add('lastName', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('confirm', TextType::class)
            ->add(
                'yob',
                ChoiceType::class,
                array('choices' => array_combine($dates, $dates), 'label' => 'Yer of birth', 'required' => false)
            )
            ->add('hasCat', CheckboxType::class, array('label' => 'Has a cat'))
            ->add('save', SubmitType::class, array('label' => 'Join'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Account'
        ));
    }
}
