<?php

namespace App\Form\DataTransformer;

use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;

class TagTransformer implements DataTransformerInterface
{
  public function __construct(
    private EntityManagerInterface $entityManager,
    private TagRepository $tagRepository,
  )
  {
  
  }
  
  public function transform(mixed $value)
  {
    dd($value);
    if (null === $value) {
      return '';
    }
    
    return $value->getId();
  }
  
  public function reverseTransform(mixed $value)
  {
    if (null === $value) {
      return '';
    }
    
    return $this->tagRepository->findOneBy(['id' => $value]);
  }
}