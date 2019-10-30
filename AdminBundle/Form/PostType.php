<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title')
        ->add('body')
        ->add('slug')
        ->add('datePublish', DateType::class,array(
                'widget'=>'single_text',
                'format'  =>'yyyy-MM-dd',
                'data'  => new \DateTime()

        ))
        ->add('categories', EntityType::class, array(
            'class'=>'AdminBundle\Entity\Category', //ina entity ola table ghadi ntbasaw 3liha
            'choice_label'=>"libelle", //chno bghiti ijib liya mn had table o chno ghadi iban liya f select
            'expanded'=>false,
            'multiple'=>true, //wach selection ghadi ikon multiple ola la 
        ))
        ->add('image', FileType::class, array('label'=>'image png ou jpeg'));

        
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_post';
    }


}
