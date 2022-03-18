<?php

declare(strict_types=1);

namespace App\Entity\Answer;

use App\Entity\QuestionChoices\QuestionChoice;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class MultipleChoiceSingleValueAnswer extends Answer implements SingleValueAnswer
{
    #[ManyToOne(targetEntity: QuestionChoice::class, inversedBy: 'answers')]
    private QuestionChoice $choice;

    public function getChoice(): QuestionChoice
    {
        return $this->choice;
    }

    public function setChoice(QuestionChoice $choice): void
    {
        $this->choice = $choice;
    }

    public function getValue(): string
    {
        return (string)$this->choice;
    }

    public function setValue(QuestionChoice $choice): void
    {
        $this->choice = $choice;
    }
}
