<?php

declare(strict_types=1);

namespace App\Entity\QuestionChoices;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class TextQuestionChoice extends QuestionChoice
{
    /**
     * @var string
     */
    #[Column(type: Types::STRING)]
    protected mixed $value;

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }


}
