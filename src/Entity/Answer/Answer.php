<?php

declare(strict_types=1);

namespace App\Entity\Answer;

use App\Entity\Question\Question;
use App\Entity\Question\QuestionTypes;
use App\Entity\SurveyResponse;
use App\Repository\AnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity(repositoryClass: AnswerRepository::class)]
#[InheritanceType("JOINED")]
#[DiscriminatorColumn(name: 'type', type: Types::STRING)]
#[DiscriminatorMap(
    [
        QuestionTypes::TEXT => TextAnswer::class,
        QuestionTypes::NUMBER => NumberAnswer::class,
        QuestionTypes::MULTIPLE_CHOICE => MultipleChoiceSingleValueAnswer::class,
    ]
)]
class Answer implements SingleValueAnswer, MultipleValueAnswer
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: Types::INTEGER)]
    protected int $id;

    #[ManyToOne(targetEntity: SurveyResponse::class, inversedBy: 'answers')]
    protected SurveyResponse $surveyResponse;

    #[ManyToOne(targetEntity: Question::class, inversedBy: 'answers')]
    protected Question $question;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSurveyResponse(): SurveyResponse
    {
        return $this->surveyResponse;
    }

    public function setSurveyResponse(SurveyResponse $surveyResponse): void
    {
        $this->surveyResponse = $surveyResponse;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function setQuestion(Question $question): void
    {
        $this->question = $question;
    }

    public function getValue(): mixed
    {
        throw new \Exception("getValue must be implemented in children Answer class or is not available for the current Answer Class");
    }

    public function getValues(): array
    {
        throw new \Exception("getValues must be implemented in children Answer class");
    }
}
