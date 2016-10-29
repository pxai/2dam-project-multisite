<?php

namespace ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use ApiBundle\Entity\ChatGroup;

class MessageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                        ->add('Message', EntityType::class, array (
                               "class" => "ApiBundle:Message"
                           )
               );
           // ->add('content', HiddenType::class)
           // ->add('group', EntityType::class, array (
           //                     "class" => "ApiBundle:ChatGroup"
           //                 )
           //     );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ApiBundle\Entity\Message',
            'csrf_protection' => false,
        ));
    }

    public function getName() {
        return 'message';
    }
}
