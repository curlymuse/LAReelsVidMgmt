<?php

class XMLFeedTest extends TestCase {

    public function test_feed() {

        $response = $this->route('GET', 'podcasts.feed');

        libxml_use_internal_errors(true);

        $version = '1.0';
        $encoding = 'utf-8';
        $doc = new DOMDocument($version, $encoding);
        $doc->loadXML($response->getContent());

        $errors = libxml_get_errors();
        libxml_clear_errors();

        $this->assertTrue(empty($errors));

    }

}