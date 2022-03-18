<?php

declare(strict_types=1);

namespace App\Entity\Answer;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class NumberAnswer extends Answer implements SingleValueAnswer
{
    #[Column(type: Types::INTEGER, nullable: true)]
    private int $value;

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}
