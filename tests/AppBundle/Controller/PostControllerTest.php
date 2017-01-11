<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    //Voir chapitre 12: Testing pour lien, formulaires, ...
    public function testShowPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'chapter6/hello/world');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("helloAction: world")')->count()
        );

/*
        // CLICK ON LINK
        $link = $crawler
            ->filter('a:contains("Greet")') // find all links with the text "Greet"
            ->eq(1) // select the second link in the list
            ->link()
        ;

        // and click it
        $crawler = $client->click($link);

        // FILL FORM
        $form = $crawler->selectButton('submit')->form();

        // set some values
        $form['name'] = 'Lucas';
        $form['form_name[subject]'] = 'Hey there!';

        // submit the form
        $crawler = $client->submit($form);

        // MISCELLANEOUS

        // Assert that there is at least one h2 tag
        // with the class "subtitle"
        $this->assertGreaterThan(
            0,
            $crawler->filter('h2.subtitle')->count()
        );

        // Assert that there are exactly 4 h2 tags on the page
        $this->assertCount(4, $crawler->filter('h2'));

        // Assert that the "Content-Type" header is "application/json"
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );

        // Assert that the response content contains a string
        $this->assertContains('foo', $client->getResponse()->getContent());
        // ...or matches a regex
        $this->assertRegExp('/foo(bar)?/', $client->getResponse()->getContent());

        // Assert that the response status code is 2xx
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');

        // Assert that the response status code is 404
        $this->assertTrue($client->getResponse()->isNotFound());

        // Assert a specific 200 status code
        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

        // Assert that the response is a redirect to /demo/contact
        $this->assertTrue(
            $client->getResponse()->isRedirect('/demo/contact'),
            'response is a redirect to /demo/contact'
        );
        // ...or simply check that the response is a redirect to any URL
        $this->assertTrue($client->getResponse()->isRedirect());

        // FULL REQUEST

        request(
            $method,
            $uri,
            array $parameters = array(),
            array $files = array(),
            array $server = array(),
            $content = null,
            $changeHistory = true
        )

        $client->request(
            'GET',
            '/post/hello-world',
            array(),
            array(),
            array(
                'CONTENT_TYPE' => 'application/json',
                'HTTP_REFERER' => '/foo/bar',
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            )
        );


        $link = $crawler->selectLink('Go elsewhere...')->link();
        $crawler = $client->click($link);

        $form = $crawler->selectButton('validate')->form();
        $crawler = $client->submit($form, array('name' => 'Fabien'));

        $client->back();
        $client->forward();
        $client->reload();

        // Clears all cookies and the history
        $client->restart();

        // the HttpKernel request instance
        $request = $client->getRequest();

        // the BrowserKit request instance
        $request = $client->getInternalRequest();

        // the HttpKernel response instance
        $response = $client->getResponse();

        // the BrowserKit response instance
        $response = $client->getInternalResponse();

        // enable the profiler for the very next request
        $client->enableProfiler();
        $crawler = $client->request('GET', '/profiler');

        // get the profile
        $profile = $client->getProfile();

*/
    }
}
