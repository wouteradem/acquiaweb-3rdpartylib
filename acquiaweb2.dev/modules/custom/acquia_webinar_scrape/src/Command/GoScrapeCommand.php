<?php

namespace Drupal\acquia_webinar_scrape\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Command\Command;
use Drupal\Console\Style\DrupalStyle;

/**
 * Class GoScrapeCommand.
 *
 * @package Drupal\acquia_webinar_scrape
 */
class GoScrapeCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('acquia_webinar_scrape:goscrape')
      ->setDescription($this->trans('command.acquia_webinar_scrape.goscrape.description'))
      ->addOption('url', NULL, InputOption::VALUE_REQUIRED, 'https://www.acquia.com/about-us/contact');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {

    $io = new DrupalStyle($input, $output);

    $url = $input->getOption('url');
    if (!empty($url)) {
      $io->info($url);
    }

    // Load Goutte library.

  }

}
