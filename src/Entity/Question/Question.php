<?php

declare(strict_types=1);

namespace App\Entity\Question;

use App\Entity\Answer\Answer;
use App\Entity\Survey;
use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: QuestionRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'type', type: Types::STRING)]
#[DiscriminatorMap(
    [
        QuestionTypes::TEXT => TextQuestion::class,
        QuestionTypes::NUMBER => NumberQuestion::class,
        QuestionTypes::MULTIPLE_CHOICE => MultipleChoiceQuestion::class,
    ]
)]
class Question
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: Types::INTEGER)]
    protected int $id;

    #[Column(type: Types::STRING, nullable: false)]
    protected string $text;

    #[ManyToOne(targetEntity: Survey::class, inversedBy: 'questions')]
    protected Survey $survey;

    #[OneToMany(mappedBy: 'question', targetEntity: Answer::class, orphanRemoval: true)]
    private Collection $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey): void
    {
        $this->survey = $survey;
    }

    /**
     * @return ArrayCollection<Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): void
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }
    }

    public function removeAnswer(Answer $answer): void
    {
        if ($this->answers->contains($answer)) {
            $this->answers->remove($answer);
        }
    }
}
