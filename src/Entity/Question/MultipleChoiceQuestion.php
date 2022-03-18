<?php

declare(strict_types=1);

namespace App\Entity\Question;

use App\Entity\QuestionChoices\QuestionChoice;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class MultipleChoiceQuestion extends Question implements MultipleChoiceQuestionInterface
{
    #[OneToMany(mappedBy: 'question', targetEntity: QuestionChoice::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $choices;

    public function __construct()
    {
        parent::__construct();

        $this->choices = new ArrayCollection();
    }

    /**
     * @return ArrayCollection<QuestionChoice>
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(QuestionChoice $choice): void
    {
        if (!$this->choices->contains($choice)) {
            $this->choices->add($choice);
            $choice->setQuestion($this);
        }
    }

    public function removeChoice(QuestionChoice $choice): void
    {
        if ($this->choices->contains($choice)){
            $this->choices->remove($choice);
        }
    }
}
