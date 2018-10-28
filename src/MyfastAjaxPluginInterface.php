<?php

namespace Drupal\myfast_ajax;

use Drupal\Component\Plugin\PluginInspectionInterface;


interface MyfastAjaxPluginInterface extends PluginInspectionInterface {

  /**
   * Метод, через который мы будем получать ID плагина.
   */
  public function getId();


  /**
   * Метод, который будет возвращать непосредственно сам контент.
   */
  public function getContent();




}