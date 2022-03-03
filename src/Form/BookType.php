<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $category = CategoryRepository::class;
        $builder
            ->add('title', TextType::class,[
                'label' => "Entrez le nom du livre"
            ])
            ->add('isAvailable', ChoiceType::class, [
                'label' => 'Le livre est :',
                'choices' => [
                    'indisponible' => false,
                    'disponible' => true
                ]
            ])
            ->add('category', EntityType::class,[
                'class' =>Category::class,
                'choice_label' => 'title'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
