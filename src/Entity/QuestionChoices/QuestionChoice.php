<?php

declare(strict_types=1);

namespace App\Entity\QuestionChoices;

use App\Entity\Question\MultipleChoiceQuestion;
use App\Repository\QuestionChoiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity(repositoryClass: QuestionChoiceRepository::class)]
#[InheritanceType("JOINED")]
#[DiscriminatorColumn(name: 'type', type: 'string')]
#[DiscriminatorMap(
    [
        QuestionChoiceTypes::TEXT => TextQuestionChoice::class,
        QuestionChoiceTypes::NUMBER => NumberQuestionChoice::class,
        QuestionChoiceTypes::BOOLEAN => BooleanQuestionChoice::class
    ]
)]
class QuestionChoice
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: Types::INTEGER)]
    private int $id;

    #[ManyToOne(targetEntity: MultipleChoiceQuestion::class, inversedBy: 'choices')]
    private MultipleChoiceQuestion $question;

    protected mixed $value;

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuestion(): MultipleChoiceQuestion
    {
        return $this->question;
    }

    public function setQuestion(MultipleChoiceQuestion $question): void
    {
        $this->question = $question;
    }

    public function __toString(): string
    {
        throw new \Exception('__toString to be implemented in children QuestionChoice class');
    }

    public function getValue(): mixed
    {
       throw new \Exception('getValue to be implemented in children QuestionChoice class');
    }

    public function setValue(mixed $value): void
    {
        throw new \Exception('setValue to be implemented in children QuestionChoice class');
    }
}
