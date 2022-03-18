<?php

declare(strict_types=1);

namespace App\Entity\QuestionChoices;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class NumberQuestionChoice extends QuestionChoice
{
    /**
     * @var int
     */
    #[Column(type: Types::INTEGER)]
    protected mixed $value;

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }


}
