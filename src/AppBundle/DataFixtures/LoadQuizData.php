<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Question;
use AppBundle\Entity\Quiz;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadQuizData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 3; $i++) {
            $quiz = new Quiz();
            $quiz->setTitle('quiz_title '.$i);

            for ($a = 0; $a < 2; $a++) {
                $question = new Question();
                $question->setTitle('question_title '.$a);

                for ($b = 0; $b < 2; $b++) {
                    $answer = new Answer();
                    $answer->setTitle('answer_title '.$b);
                    $answer->setCorrect(1 === $b ? true : false);
                    $question->addAnswer($answer);
                }

                $quiz->addQuestion($question);
            }

            $manager->persist($quiz);
        }

        $manager->flush();
    }
}