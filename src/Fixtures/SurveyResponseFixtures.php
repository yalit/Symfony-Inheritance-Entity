<?php

declare(strict_types=1);

namespace App\Fixtures;

use App\Entity\Survey;
use App\Entity\SurveyResponse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class SurveyResponseFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        /** @var Survey $mainSurvey */
        $mainSurvey = $this->getReference('mainSurvey');

        $surveyResponse = new SurveyResponse();
        $surveyResponse->setSurvey($mainSurvey);

        $this->entityManager->persist($surveyResponse);
        $this->entityManager->flush();

        $this->addReference('mainSurveyResponse', $surveyResponse);
    }

    public function getDependencies()
    {
        return [SurveyFixtures::class];
    }


}
