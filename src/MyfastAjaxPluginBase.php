<?php
namespace Drupal\myfast_ajax;

use Drupal\Component\Plugin\PluginBase;

// abstract

 class MyfastAjaxPluginBase extends PluginBase implements MyfastAjaxPluginInterface {



  /**
   * {@inheritdoc}
   */
  public function getId() {
    # Возвращаем значение аннотации $id.
    return $this->pluginDefinition['id'];
  }


  /**
   * {@inheritdoc}
   */
  public function getContent() {
    return '';
  }


}
