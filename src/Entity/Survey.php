<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Question\Question;
use App\Repository\SurveyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: SurveyRepository::class)]
class Survey
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: Types::INTEGER, nullable: false)]
    private ?int $id = null;

    #[Column(type: Types::STRING, nullable: false)]
    private string $name;

    #[OneToMany(mappedBy: 'survey', targetEntity: SurveyResponse::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $responses;
    
    #[OneToMany(mappedBy: 'survey', targetEntity: Question::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->responses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection<Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): void
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setSurvey($this);
        }
    }

    public function removeQuestion(Question $question): void
    {
        if (!$this->questions->contains($question)) {
            return;
        }

        $this->questions->remove($question);
    }

    /**
     * @return ArrayCollection<SurveyResponse>
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(SurveyResponse $response): void
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
            $response->setSurvey($this);
        }
    }

    public function removeResponse(SurveyResponse $response): void
    {
        if (!$this->responses->contains($response)) {
            return;
        }

        $this->responses->remove($response);
    }
}
