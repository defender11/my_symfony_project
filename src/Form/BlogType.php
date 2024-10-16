<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('title')
      ->add('description')
      ->add('text', TextareaType::class, ['required' => true])
      ->add('category', EntityType::class, [
        // looks for choices from this entity
        'class' => Category::class,
        
        // uses the User.username property as the visible option string
        'choice_label' => 'name',
        'required' => false,
        'empty_data' => null,
        
        // used to render a select box, check boxes or radios
        // 'multiple' => true,
        // 'expanded' => true,
      ]);
  }
  
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Blog::class,
    ]);
  }
}
