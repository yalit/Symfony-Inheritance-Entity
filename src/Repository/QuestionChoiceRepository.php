<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\QuestionChoice;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class QuestionChoiceRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(QuestionChoice::class));
    }
}
