<?php

declare(strict_types=1);

namespace App\Entity\Question;

use App\Entity\QuestionChoices\QuestionChoice;
use Doctrine\Common\Collections\Collection;

interface MultipleChoiceQuestionInterface
{

    /**
     * @return Collection<QuestionChoice>
     */
    public function getChoices(): Collection;
}