<?php


namespace Tests\Functional\Controller;

use AppBundle\Entity\Quiz;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class QuizControllerTest extends WebTestCase
{
    private $client;
    private $em;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->em = $this->getContainer()->get('doctrine')->getManager();
        $this->loadFixtures(['AppBundle\DataFixtures\LoadQuizData']);
    }

    public function testListQuiz()
    {
        $this->client->request('GET', '/list');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $crawler = $this->fetchCrawler('/list');
        $crawler = $crawler->filter("table>tbody>tr");

        $nodeValues = $crawler->each(
            function (Crawler $node) {
                return $node->children()->first()->text();
            }
        );

        $this->assertCount(3, $nodeValues);
        $this->assertEquals('quiz_title 2', $nodeValues[2]);
    }

    public function testCreateQuiz()
    {
        $crawler = $this->client->request('GET', '/create');
        $this->assertStatusCode(200, $this->client);

        $form = $crawler->selectButton('Save')->form();

        $values['quiz']['title'] = 'create_for_test';
        $values['quiz']['_token'] = $form['quiz[_token]']->getValue();
        $values['quiz']['questions'][0]['title'] = 'title';
        $values['quiz']['questions'][0]['answers'][0]['title'] = 'answer_title';
        $values['quiz']['questions'][0]['answers'][0]['correct'] = true;
        $values['quiz']['questions'][0]['answers'][1]['title'] = 'answer_title';
        $values['quiz']['questions'][0]['answers'][1]['correct'] = false;

        $this->client->request($form->getMethod(), $form->getUri(), $values);
        $quiz = $this->em->getRepository(Quiz::class)->findOneBy(['title' => 'create_for_test']);

        $this->assertEquals('create_for_test', $quiz->getTitle());
        $this->assertStatusCode(302, $this->client);
    }

    public function testEditQuiz()
    {
        $crawler = $this->client->request('GET', '/edit/1');
        $this->assertStatusCode(200, $this->client);

        $form = $crawler->selectButton('Save')->form();

        $values['quiz']['title'] = 'edit_for_test';
        $values['quiz']['_token'] = $form['quiz[_token]']->getValue();
        $values['quiz']['questions'][0]['title'] = 'title';
        $values['quiz']['questions'][0]['answers'][0]['title'] = 'answer_title';
        $values['quiz']['questions'][0]['answers'][0]['correct'] = true;
        $values['quiz']['questions'][0]['answers'][1]['title'] = 'answer_title';
        $values['quiz']['questions'][0]['answers'][1]['correct'] = false;

        $this->client->request($form->getMethod(), $form->getUri(), $values);
        $quiz = $this->em->getRepository(Quiz::class)->findOneBy(['title' => 'edit_for_test']);

        $this->assertEquals('edit_for_test', $quiz->getTitle());
        $this->assertStatusCode(302, $this->client);
    }

    public function testDeleteQuiz()
    {
        $crawler = $this->client->request('GET', 'list');
        $this->assertStatusCode(200, $this->client);

        $form = $crawler->selectButton('Delete')->form();
        $values['_token'] = $form['_token']->getValue();

//        $quiz = $this->em->getRepository(Quiz::class)->find(1);
//        $this->assertEquals(1, $quiz->getId());

        $this->client->request('POST', '/delete/1', $values);
        $this->client->followRedirect();

        $quiz2 = $this->em->getRepository(Quiz::class)->find(1);
        $this->assertNull($quiz2);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}
