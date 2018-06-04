<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 * @ORM\Entity()
 * @ORM\Table(name="answers")
 */
class Answer
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
     * @var bool
     *
     * @ORM\Column(name="correct", type="boolean")
     */
    private $correct;


    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;


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
     * @return Answer
     */
    public function setTitle($title): Answer
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
     * Set correct.
     *
     * @param bool $correct
     *
     * @return Answer
     */
    public function setCorrect($correct): Answer
    {
        $this->correct = $correct;

        return $this;
    }

    /**
     * Get correct.
     *
     * @return bool
     */
    public function getCorrect(): ?bool
    {
        return $this->correct;
    }

    /**
     * Set question.
     *
     * @param \AppBundle\Entity\Question|null $question
     *
     * @return Answer
     */
    public function setQuestion(\AppBundle\Entity\Question $question = null): Answer
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question.
     *
     * @return \AppBundle\Entity\Question|null
     */
    public function getQuestion(): ?Answer
    {
        return $this->question;
    }
}
