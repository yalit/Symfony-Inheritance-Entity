<?php

declare(strict_types=1);

namespace App\Fixtures;

use App\Entity\Question\MultipleChoiceQuestion;
use App\Entity\QuestionChoices\BooleanQuestionChoice;
use App\Entity\QuestionChoices\NumberQuestionChoice;
use App\Entity\QuestionChoices\TextQuestionChoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionChoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function load(ObjectManager $manager)
    {
        /** @var MultipleChoiceQuestion $multipleChoiceQuestionTextChoices */
        $multipleChoiceQuestionTextChoices = $this->getReference('multipleChoiceQuestionTextChoices');
        for($i = 0; $i<5; $i++) {
            $textChoice = new TextQuestionChoice();
            $textChoice->setValue(sprintf("Text Question Choice - %d", $i));
            $textChoice->setQuestion($multipleChoiceQuestionTextChoices);
            $this->entityManager->persist($textChoice);
        }

        /** @var MultipleChoiceQuestion $multipleChoiceQuestionNumberChoices */
        $multipleChoiceQuestionNumberChoices = $this->getReference('multipleChoiceQuestionNumberChoices');
        for($i = 0; $i<5; $i++) {
            $numberChoice = new NumberQuestionChoice();
            $numberChoice->setValue($i);
            $numberChoice->setQuestion($multipleChoiceQuestionNumberChoices);
            $this->entityManager->persist($numberChoice);
        }

        /** @var MultipleChoiceQuestion $multipleChoiceQuestionBooleanChoices */
        $multipleChoiceQuestionBooleanChoices = $this->getReference('multipleChoiceQuestionBooleanChoices');
        //True
        $trueChoice = new BooleanQuestionChoice();
        $trueChoice->setValue(true);
        $trueChoice->setQuestion($multipleChoiceQuestionBooleanChoices);
        $this->entityManager->persist($trueChoice);

        //False
        $falseChoice = new BooleanQuestionChoice();
        $falseChoice->setValue(false);
        $falseChoice->setQuestion($multipleChoiceQuestionBooleanChoices);
        $this->entityManager->persist($falseChoice);

        $this->entityManager->flush();
    }

    public function getDependencies()
    {
        return [QuestionFixtures::class];
    }
}
