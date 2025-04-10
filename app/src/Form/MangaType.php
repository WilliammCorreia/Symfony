<?php

namespace App\Form;

use App\Entity\Manga;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Tag;

class MangaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price')
            ->add('title')
            ->add('category')
            ->add('tags', EntityType::class, [
                'class' => Tag::class, // L'entité associée
                'choice_label' => 'name', // Le champ à afficher dans le formulaire
                'multiple' => true, // Permet de sélectionner plusieurs tags
                'expanded' => true, // Affiche les options sous forme de cases à cocher
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Manga::class,
        ]);
    }
}
