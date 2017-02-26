<?php
namespace MyApp\Tests;

use Silex\WebTestCase;

class AppTest extends WebTestCase
{
    public function createApplication()
    {
        return require __DIR__.'/../../../app/app.php';
    }

    public function testInitialPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('h1:contains("Welcome to the lracicot\silex-template!")'));
        $this->assertCount(1, $crawler->filter('h2:contains("Get started")'));
    }
}
