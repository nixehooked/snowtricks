<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('groups')
            ->add('video', CollectionType::class, array(
                'entry_type'   => VideoType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'required' => false
            ))
                ->add('image', CollectionType::class, array(
                    'entry_type'   => ImageType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'required' => false
                ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
