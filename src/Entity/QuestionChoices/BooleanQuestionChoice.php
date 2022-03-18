<?php

declare(strict_types=1);

namespace App\Entity\QuestionChoices;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class BooleanQuestionChoice extends QuestionChoice
{
    /**
     * @var bool
     */
    #[Column(type: Types::BOOLEAN)]
    protected mixed $value;

    public function __toString(): string
    {
        return $this->value ? 'Yes' : 'No';
    }

    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * @param bool $value
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }


}
