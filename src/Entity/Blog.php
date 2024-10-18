<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;
  
    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private Category|null $category = null;
  
  
  /**
   * @var Collection
   */
  #[ORM\JoinTable(name: 'tags_to_blog')]
  #[ORM\JoinColumn(name: 'blog_id', referencedColumnName: 'id')]
  #[ORM\InverseJoinColumn(name: 'tag_id', referencedColumnName: 'id', unique: true)]
  #[ORM\ManyToMany(targetEntity: Tag::class)]
  private Collection $tags;
  
  public function __construct() {
    $this->tags = new ArrayCollection();
  }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }
  
    public function getDescription(): ?string
    {
      return $this->description;
    }
    
    public function setDescription(?string $description): static
    {
      $this->description = $description;
      
      return $this;
    }
  
  public function getCategory(): ?Category
  {
    return $this->category;
  }
  
  public function setCategory(?Category $category): static
  {
    $this->category = $category;
    
    return $this;
  }
  
  
  public function getTags(): Collection
  {
    return $this->tags;
  }
  
  public function setTags(Collection $tags): static
  {
    $this->tags = $tags;
    
    return $this;
  }
  
  public function addTag(Tag $tag): void
  {
    if (!$this->tags->contains($tag)) {
      $this->tags[] = $tag;
    }
  }
}
