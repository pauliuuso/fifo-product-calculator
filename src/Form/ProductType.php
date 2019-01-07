<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ProductType
 */
class ProductType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'product.title',
                'constraints' => [
                    new NotBlank([
                        'message' => 'generic.not_blank'
                    ]),
                    new Length([
                        'min' => 3,
                        'max' => 190
                    ])
                ]
            ])
            ->add('price', TextType::class, [
                'label' => 'product.price',
                'constraints' => [
                    new NotBlank([
                        'message' => 'generic.not_blank'
                    ])
                ]
            ])
            ->add('count', TextType::class, [
                'label' => 'product.count',
                'constraints' => [
                    new NotBlank([
                        'message' => 'generic.not_blank'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class
        ]);
    }

}