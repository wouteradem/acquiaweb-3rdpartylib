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
      ->addArgument('name', InputArgument::OPTIONAL, $this->trans('command.acquia_webinar_scrape.goscrape.arguments.name'))
      ->addOption('yell', NULL, InputOption::VALUE_NONE, $this->trans('command.acquia_webinar_scrape.goscrape.options.yell'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {

    $io = new DrupalStyle($input, $output);

    $name = $input->getArgument('name');
    if ($name) {
      $text = 'Hello ' . $name;
    }
    else {
      $text = 'Hello';
    }

    $text = sprintf(
      '%s, %s: %s',
      $text,
      'I am a new generated command for the module',
      $this->getModule()
    );

    if ($input->getOption('yell')) {
      $text = strtoupper($text);
    }

    $io->info($text);
  }

}
