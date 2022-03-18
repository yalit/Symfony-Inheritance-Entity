<?php

declare(strict_types=1);

namespace App\Entity\Answer;

interface SingleValueAnswer
{
    public function getValue():mixed;
}