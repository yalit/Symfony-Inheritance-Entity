<?php

declare(strict_types=1);

namespace App\Fixtures;

use App\Entity\Question\MultipleChoiceQuestion;
use App\Entity\Question\NumberQuestion;
use App\Entity\Question\TextQuestion;
use App\Entity\Survey;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

final class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function load(ObjectManager $manager)
    {
        /** @var Survey $mainSurvey */
        $mainSurvey = $this->getReference('mainSurvey');

        for ($i = 0; $i < 5; $i++) {
            $textQuestion = new TextQuestion();
            $textQuestion->setText(sprintf('Text question text - %d', $i));
            $textQuestion->setSurvey($mainSurvey);
            $this->entityManager->persist($textQuestion);
            $this->addReference(sprintf('textQuestion%d', $i), $textQuestion);
        }

        for ($i = 0; $i < 5; $i++) {
            $numberQuestion = new NumberQuestion();
            $numberQuestion->setText(sprintf('Number question text - %d', $i));
            $numberQuestion->setSurvey($mainSurvey);
            $this->entityManager->persist($numberQuestion);
            $this->addReference(sprintf('numberQuestion%d', $i), $numberQuestion);
        }

        $multipleChoiceQuestionTextChoices = new MultipleChoiceQuestion();
        $multipleChoiceQuestionTextChoices->setText("Multiple Choice Question - Text Choices");
        $multipleChoiceQuestionTextChoices->setSurvey($mainSurvey);
        $this->entityManager->persist($multipleChoiceQuestionTextChoices);
        $this->addReference('multipleChoiceQuestionTextChoices', $multipleChoiceQuestionTextChoices);

        $multipleChoiceQuestionNumberChoices = new MultipleChoiceQuestion();
        $multipleChoiceQuestionNumberChoices->setText("Multiple Choice Question - Number Choices");
        $multipleChoiceQuestionNumberChoices->setSurvey($mainSurvey);
        $this->entityManager->persist($multipleChoiceQuestionNumberChoices);
        $this->addReference('multipleChoiceQuestionNumberChoices', $multipleChoiceQuestionNumberChoices);

        $multipleChoiceQuestionBooleanChoices = new MultipleChoiceQuestion();
        $multipleChoiceQuestionBooleanChoices->setText("Multiple Choice Question - Boolean Choices");
        $multipleChoiceQuestionBooleanChoices->setSurvey($mainSurvey);
        $this->entityManager->persist($multipleChoiceQuestionBooleanChoices);
        $this->addReference('multipleChoiceQuestionBooleanChoices', $multipleChoiceQuestionBooleanChoices);

        $this->entityManager->flush();
    }

    public function getDependencies()
    {
        return [SurveyFixtures::class];
    }
}
