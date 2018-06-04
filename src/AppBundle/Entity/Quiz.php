<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Quiz
 * @ORM\Entity()
 * @ORM\Table(name="quiz")
 */
class Quiz
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
     * @ORM\OneToMany(targetEntity="Question", mappedBy="quiz", cascade={"all"})
     */
    private $questions;

    /**
     * Quiz constructor.
     */
    public function __construct() {
        $this->questions = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Quiz
     */
    public function setTitle($title): Quiz
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Add question.
     *
     * @param \AppBundle\Entity\Question $question
     *
     * @return Quiz
     */
    public function addQuestion(Question $question): Quiz
    {
        if (false === $this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    /**
     * @param Question $question
     *
     * @return $this
     */
    public function removeQuestion(Question $question): Quiz
    {
        $this->questions->removeElement($question);

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }
}
