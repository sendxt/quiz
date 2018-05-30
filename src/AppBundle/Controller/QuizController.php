<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Quiz;
use AppBundle\Form\Type\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Quiz controller.
 *
 * @Route("quiz")
 */
class QuizController extends Controller
{
    /**
     * Lists all quiz entities.
     *
     * @Route("/", name="quiz_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $quizzes = $em->getRepository('AppBundle:Quiz')->findAll();

        return $this->render('quiz/index.html.twig', array(
            'quizzes' => $quizzes,
        ));
    }

    /**
     * Finds and displays a quiz entity.
     *
     * @Route("/{id}", name="quiz_show")
     * @Method("GET")
     */
    public function showAction(Quiz $quiz)
    {

        return $this->render('quiz/show.html.twig', array(
            'quiz' => $quiz,
        ));
    }

    /**
     * Create quiz
     *
     * @Route("/create", name="quiz_show")
     * @Method("GET")
     */
    public function createAction(Request $request)
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);

        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($quiz);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('admin_post_show', [
//                'id' => $quiz->getId()
//            ]);
//        }

        return $this->render('quiz/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
