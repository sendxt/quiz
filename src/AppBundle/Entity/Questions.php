<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Quiz;

/**
 * Questions
 *
 * @ORM\Table(name="questions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionsRepository")
 */
class Questions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="numberCorrectAnswers", type="integer")
     */
    private $numberCorrectAnswers;

    /**
     * @ORM\ManyToOne(targetEntity="Quiz", inversedBy="questions")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id")
     */
    private $quiz;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Questions
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set numberCorrectAnswers.
     *
     * @param int $numberCorrectAnswers
     *
     * @return Questions
     */
    public function setNumberCorrectAnswers($numberCorrectAnswers)
    {
        $this->numberCorrectAnswers = $numberCorrectAnswers;

        return $this;
    }

    /**
     * Get numberCorrectAnswers.
     *
     * @return int
     */
    public function getNumberCorrectAnswers()
    {
        return $this->numberCorrectAnswers;
    }

    /**
     * Set quiz.
     *
     * @param \AppBundle\Entity\Quiz|null $quiz
     *
     * @return Questions
     */
    public function setQuiz(\AppBundle\Entity\Quiz $quiz = null)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz.
     *
     * @return \AppBundle\Entity\Quiz|null
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
}
