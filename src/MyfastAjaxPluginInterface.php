<?php

namespace Drupal\myfast_ajax;

use Drupal\Component\Plugin\PluginInspectionInterface;


interface MyfastAjaxPluginInterface extends PluginInspectionInterface {

  /**
   * Метод, через который мы будем получать ID плагина.
   */
  public function getId();

  /**
   * Метод, через который мы будем получать названия аргументов плагина.
   *
   * @return array
   */
  public function getArgNames();


  /**
   *   /**
   * Метод, через который мы будем получать аргументы плагина.
   *
   * @return array
   */
  public function getArgs();


  /**
   * Метод, который будет возвращать непосредственно сам контент.
   *
   * @return string
   */
  public function getContent();




}