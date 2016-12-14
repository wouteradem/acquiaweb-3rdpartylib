<?php

namespace Drupal\acquia_webinar_location\Crawler;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class AcquiaDOMCrawler {

  const URL = 'https://www.acquia.com/about-us/contact';
  const XPATH_FILTER_LOCATION = '//span[@class="field-content"]';
  const XPATH_FILTER_ADDRESS1 = '//div[@class="street-address"]';
  const XPATH_FILTER_ADDRESS2 = '//span[@class="locality"]';
  const XPATH_FILTER_COUNTRY = '//div[@class="country-name"]';

  private $crawler;

  public function __construct(Client $client) {
    $this->crawler = $client->request('GET', AcquiaDOMCrawler::URL);
  }
  
  public function getAcquiaLocations($stub = FALSE) {
    if ($stub) {
      return $this->getAcquiaStubLocations();
    }
    return $this->getAcquiaLocationsFromScrape();
  }
  
  private function getAcquiaLocationsFromScrape() {

    $locations = array();

    $title = $this->doCrawl(AcquiaDOMCrawler::XPATH_FILTER_LOCATION);
    $title = array_slice($title, 10);
    $address1 = $this->doCrawl(AcquiaDOMCrawler::XPATH_FILTER_ADDRESS1);
    $address2 = $this->doCrawl(AcquiaDOMCrawler::XPATH_FILTER_ADDRESS2);
    $country = $this->doCrawl(AcquiaDOMCrawler::XPATH_FILTER_COUNTRY);

    for ($i = 0; $i < count($country); $i++) {
      $locations[] = $this->pop($title, $address1, $address2, $country);
    }
    
    return $this->getAcquiaStubLocations();
  }

  private function doCrawl($xpathFilter) {

    $crawl = $this->crawler->filterXPath($xpathFilter);
    $crawlArray = array();
    foreach ($crawl as $i => $item) {
      array_push($crawlArray, trim($item->nodeValue));
    }
    
    return $crawlArray;
  }

  private function pop(&$title, &$address1, &$address2, &$country) {

    $location = array(
      'name' => $title[0],
      'address1' => $address1[0],
      'address2' => $address2[0],
      'country' => $country[0],
    );
    array_shift($title);
    array_shift($address1);
    array_shift($address2);
    array_shift($country);

    return $location;
  }

  private function getAcquiaStubLocations() {

    return array(
      0 => array(
        'name' => 'Boston, MA',
        'address1' => '53 State Street, 10th Floor',
        'address2' => 'Boston, MA 02109',
        'country' => 'United States',
      ),
      1 => array(
        'name' => 'Brisbane, Australia',
        'address1' => '140 Ann Street, Level 4',
        'address2' => 'Brisbane City 4000',
        'country' => 'Australia',
      ),
      2 => array(
        'name' => 'Chicago, IL',
        'address1' => '332 S Michigan Ave, 9th Floor',
        'address2' => 'Chicago, IL 60604',
        'country' => 'United States',
      ),
      3 => array(
        'name' => 'Gent, Belgium',
        'address1' => 'Sint-Annaplein 34',
        'address2' => 'Gent 9000',
        'country' => 'Belgium',
      ),
      4 => array(
        'name' => 'Germany',
        'address1' => 'Luise-Ullrich-Str. 20',
        'address2' => '80636 München',
        'country' => 'Germany',
      ),
      5 => array(
        'name' => 'India',
        'address1' => '4th Floor, Plot No A-2, MGF ',
        'address2' => 'New Delhi 110017',
        'country' => 'India',
      ),
      6 => array(
        'name' => 'Paris, France',
        'address1' => '27 Avenue de l\'Opéra 75001',
        'address2' => 'Paris 01 79 97 25 70',
        'country' => 'France',
      ),
      7 => array(
        'name' => 'Portland, OR',
        'address1' => '1120 NW Couch St. Suite 630',
        'address2' => 'Portland, OR 97209',
        'country' => 'United States',
      ),
      8 => array(
        'name' => 'Reading, UK',
        'address1' => '87 Castle Street',
        'address2' => 'Reading RG1 7SN',
        'country' => 'United Kingdom',
      ),
      9 => array(
        'name' => 'San Francisco',
        'address1' => '466 Geary St, Suite 501',
        'address2' => 'San Francisco , CA 94107',
        'country' => 'United States',
      ),
      10 => array(
        'name' => 'Sydney, Australia',
        'address1' => '2 Elizabeth Plaza, Level 10',
        'address2' => 'North Sydney 2060',
        'country' => 'Australia',
      ),
      11 => array(
        'name' => 'Toronto, Canada',
        'address1' => '56 The Esplanade, Suite 401',
        'address2' => 'Toronto, ON M5E 1A7',
        'country' => 'Canada',
      ),
      12 => array(
        'name' => 'Washington, D.C',
        'address1' => '655 15th St NW, 8th Floor',
        'address2' => 'Washington, DC 20005',
        'country' => 'United States',
      ),
    );

  }
}