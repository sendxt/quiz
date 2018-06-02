<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Quiz;
use AppBundle\Form\Type\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $quizzes = $em->getRepository(Quiz::class)->findAll();

        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * Create quiz
     *
     * @Route("/create", name="quiz_create")
     */
    public function createAction(Request $request): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('quiz_edit', [
                'quiz' => $quiz->getId(),
            ]);
        }

        return $this->render('quiz/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Quiz $quiz
     * @Route("/edit/{quiz}", name="quiz_edit")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Quiz $quiz): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('quiz_index');
        }

        return $this->render('quiz/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(name="quiz_delete", path="/delete/{quiz}")
     */
    public function deleteAction(Quiz $quiz): Response
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($quiz);
        $em->flush();

        return $this->redirectToRoute('quiz_index');
    }
}
