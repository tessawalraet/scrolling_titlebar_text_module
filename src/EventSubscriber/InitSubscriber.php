<?php /**
 * @file
 * Contains \Drupal\scrolling_titlebar_text\EventSubscriber\InitSubscriber.
 */

namespace Drupal\scrolling_titlebar_text\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InitSubscriber implements EventSubscriberInterface {

  public static function getSubscribedEvents() {
    return [KernelEvents::REQUEST => ['onEvent', 0]];
  }

  public function onEvent() {
    $scroll_speed = \Drupal::state()->get('scrolling_titlebar_speed', '300');
    $scroll_endsting = \Drupal::state()->get('scrolling_titlebar_endstring', '  ');
    $scroll_js = 'var scrl = document.title + "' . $scroll_endsting . '";';
    $scroll_js .= 'function titlescrl() {';
    $scroll_js .= 'scrl = scrl.substring(1, scrl.length) + scrl.substring(0, 1);';
    $scroll_js .= 'document.title = scrl;';
    $scroll_js .= 'setTimeout("titlescrl()", ' . $scroll_speed . ');';
    $scroll_js .= '}';
    $scroll_js .= 'titlescrl();';
  }

}
