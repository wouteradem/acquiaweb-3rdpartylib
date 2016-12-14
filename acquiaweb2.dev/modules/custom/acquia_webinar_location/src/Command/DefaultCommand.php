<?php

namespace Drupal\acquia_webinar_location\Command;

use Drupal\node\Entity\Node;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Drupal\Console\Command\Shared\CommandTrait;
use Drupal\Console\Style\DrupalStyle;
use Goutte\Client;
use Drupal\acquia_webinar_location\Crawler\AcquiaDOMCrawler;

/**
 * Class DefaultCommand.
 *
 * @package Drupal\acquia_webinar_location
 */
class DefaultCommand extends Command {

  use CommandTrait;

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('acquia_webinar_location:default')
      ->setDescription($this->trans('commands.acquia_webinar_location.default.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {

    $io = new DrupalStyle($input, $output);

    $io->info($this->trans('commands.acquia_webinar_location.default.messages.success'));

    // @todo Move this code to a service or factory pattern.
    $acquiaDomCrawler = new AcquiaDOMCrawler(new Client());
    $acquiaLocations = $acquiaDomCrawler->getAcquiaLocations();

    // @todo Move this code to an Entity class.
    foreach ($acquiaLocations as $id => $office) {
      $node = Node::create([
        'type' => 'acquia_location',
        'title' => $office['name'],
        'field_address1' => $office['address1'],
        'field_address2' => $office['address2'],
        'field_country' => $office['country'],
      ]);
      $node->save();
    }
  }
}
