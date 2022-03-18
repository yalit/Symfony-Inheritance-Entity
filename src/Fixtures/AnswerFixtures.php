<?php

declare(strict_types=1);

namespace App\Fixtures;

use App\Entity\Answer\MultipleChoiceSingleValueAnswer;
use App\Entity\Answer\NumberAnswer;
use App\Entity\Answer\TextAnswer;
use App\Entity\Question\MultipleChoiceQuestion;
use App\Entity\Question\NumberQuestion;
use App\Entity\Question\TextQuestion;
use App\Entity\SurveyResponse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

final class AnswerFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function load(ObjectManager $manager)
    {
        /** @var SurveyResponse $mainSurveyResponse */
        $mainSurveyResponse = $this->getReference('mainSurveyResponse');

        for ($i = 0; $i < 5; $i++) {
            /** @var TextQuestion $question */
            $question = $this->getReference(sprintf('textQuestion%d', $i));

            $textAnswer = new TextAnswer();
            $textAnswer->setValue(sprintf('Text answer text - %d', $i));
            $textAnswer->setSurveyResponse($mainSurveyResponse);
            $textAnswer->setQuestion($question);
            $this->entityManager->persist($textAnswer);
            $this->addReference(sprintf('textAnswer%d', $i), $textAnswer);
        }

        for ($i = 0; $i < 5; $i++) {
            /** @var NumberQuestion $question */
            $question = $this->getReference(sprintf('numberQuestion%d', $i));
            $numberAnswer = new NumberAnswer();
            $numberAnswer->setValue($i);
            $numberAnswer->setSurveyResponse($mainSurveyResponse);
            $numberAnswer->setQuestion($question);

            $this->entityManager->persist($numberAnswer);
            $this->addReference(sprintf('numberAnswer%d', $i), $numberAnswer);
        }

        /** @var MultipleChoiceQuestion $multipleChoiceQuestionTextChoices */
        $multipleChoiceQuestionTextChoices = $this->getReference('multipleChoiceQuestionTextChoices');
        $multipleChoiceQuestionTextChoicesAnswer = new MultipleChoiceSingleValueAnswer();
        $multipleChoiceQuestionTextChoicesAnswer->setQuestion($multipleChoiceQuestionTextChoices);
        $multipleChoiceQuestionTextChoicesAnswer->setSurveyResponse($mainSurveyResponse);
        $multipleChoiceQuestionTextChoicesAnswer->setChoice($multipleChoiceQuestionTextChoices->getChoices()->first());
        $this->entityManager->persist($multipleChoiceQuestionTextChoicesAnswer);

        /** @var MultipleChoiceQuestion $multipleChoiceQuestionNumberChoices */
        $multipleChoiceQuestionNumberChoices = $this->getReference('multipleChoiceQuestionNumberChoices');
        $multipleChoiceQuestionNumberChoicesAnswer = new MultipleChoiceSingleValueAnswer();
        $multipleChoiceQuestionNumberChoicesAnswer->setQuestion($multipleChoiceQuestionNumberChoices);
        $multipleChoiceQuestionNumberChoicesAnswer->setSurveyResponse($mainSurveyResponse);
        $multipleChoiceQuestionNumberChoicesAnswer->setChoice($multipleChoiceQuestionNumberChoices->getChoices()->first());
        $this->entityManager->persist($multipleChoiceQuestionNumberChoicesAnswer);

        /** @var MultipleChoiceQuestion $multipleChoiceQuestionBooleanChoices */
        $multipleChoiceQuestionBooleanChoices = $this->getReference('multipleChoiceQuestionBooleanChoices');
        $multipleChoiceQuestionBooleanChoicesAnswer = new MultipleChoiceSingleValueAnswer();
        $multipleChoiceQuestionBooleanChoicesAnswer->setQuestion($multipleChoiceQuestionBooleanChoices);
        $multipleChoiceQuestionBooleanChoicesAnswer->setSurveyResponse($mainSurveyResponse);
        $multipleChoiceQuestionBooleanChoicesAnswer->setChoice($multipleChoiceQuestionBooleanChoices->getChoices()->first());
        $this->entityManager->persist($multipleChoiceQuestionBooleanChoicesAnswer);

        $this->entityManager->flush();
    }

    public function getDependencies()
    {
        return [QuestionFixtures::class, SurveyResponseFixtures::class, QuestionChoiceFixtures::class];
    }
}
