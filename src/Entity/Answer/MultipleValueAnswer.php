<?php

declare(strict_types=1);

namespace App\Entity\Answer;

interface MultipleValueAnswer
{
    public function getValues(): array;
}