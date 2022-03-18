<?php

declare(strict_types=1);

namespace App\Entity\Answer;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class TextAnswer extends Answer implements SingleValueAnswer
{
    #[Column(type: Types::STRING, nullable: true)]
    private string $value;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

}
