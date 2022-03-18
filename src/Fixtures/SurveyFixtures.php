<?php

declare(strict_types=1);

namespace App\Fixtures;

use App\Entity\Survey;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class SurveyFixtures extends Fixture
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $survey = new Survey();
        $survey->setName('Test Survey');
        $this->entityManager->persist($survey);
        $this->entityManager->flush();

        $this->addReference('mainSurvey', $survey);
    }
}
