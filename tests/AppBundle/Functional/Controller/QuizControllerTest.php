<?php


namespace Tests\Functional\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class QuizControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
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
        $client = static::createClient();
        $crawler = $client->request('GET', '/create');
        $this->assertStatusCode(200, $this->client);

        $values = [
            'quiz' => [
                'title' => 'quiz_title',
                'questions' => [
                    'title' => 'title question',
                    'answers' => [
                        [
                            'title' => 'answer_title',
                            'correct' => false,
                        ],
                        [
                            'title' => 'answer_title2',
                            'correct' => true,
                        ],
                        [
                            'title' => 'answer_title3',
                            'correct' => false,
                        ],
                    ]
                ]
            ]
        ];

        $form = $crawler->filter('form[name=quiz]')->form();
        $client->submit($form, $values);
        $this->assertStatusCode(302, $this->client);
    }
}
