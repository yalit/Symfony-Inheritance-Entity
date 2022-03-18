<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Survey;
use App\Entity\SurveyResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class SurveyResponseRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(SurveyResponse::class));
    }
}
