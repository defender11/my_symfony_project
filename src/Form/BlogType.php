<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Category;
use App\Form\DataTransformer\TagTransformer;
use App\Repository\BlogRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogType extends AbstractType
{
  public function __construct(
    private readonly TagTransformer $tagTransformer,
  )
  {
  
  }
  
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('title')
      ->add('description')
      ->add('text', TextareaType::class, ['required' => true])
      ->add('category', EntityType::class, [
        'class' => Category::class,
        'choice_label' => 'name',
        'required' => false,
        'empty_data' => null,
      ])
      ->add('tags', TextType::class, [
        'label' => 'Tags',
        'required' => false,
      ])
    ;
    
    $builder->get('tags')
      ->addModelTransformer($this->tagTransformer);
  }
  
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Blog::class,
    ]);
  }
}
