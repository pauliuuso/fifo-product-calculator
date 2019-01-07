<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Class SellType
 */
class SellType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('count', IntegerType::class, [
                'label' => 'product.sell_count',
                'constraints' => [
                    new NotBlank([
                        'message' => 'generic.not_blank'
                    ]),
                    new Type([
                        'type' => 'int',
                        'message' => 'generic.integer'
                    ])
                ]
            ])
            ->add('price', NumberType::class, [
                'label' => 'product.sell_price',
                'constraints' => [
                    new NotBlank([
                        'message' => 'generic.not_blank'
                    ]),
                    new Type([
                        'type' => 'numeric',
                        'message' => 'generic.numeric'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class);
    }

}