<?php

require 'vendor/autoload.php';
use Goutte\Client;

// An array or urls to scrape
$url = array(
    'https://www.reddit.com',
    'https://www.reddit.com/new/',
    'https://www.reddit.com/rising/'
);

$elements = array(
	// css selectors to target
    "selectors" => array(
       "a.title.may-blank", "a.title.may-blank", "a.title.may-blank"
    ),
    //elements to extract (corresponding to the above css selectors)
    "types" => array(
        "_text", "class", "href"
    ),
    // how many times per page?
    "count" => 3,
);

foreach($url as $k => $v) {		//loop through the array of urls
	
    $client = new Client();
    $crawler = $client->request('GET', $v);

    for($i = 0; $i < $elements["count"]; $i++ ) {		//repetitions per url

        foreach($elements["selectors"] as $key => $value) {		//loop through each selector

        $count = $crawler->filter($value)->count();	

            if($count > 0){		//check that the element exists on the page

                $index = $crawler->filter($value)->eq($i)->extract($elements["types"][$key]);
                $arr[$i][$key] = array_shift($index);
            }
        }
    	var_dump($arr);
    }
}
