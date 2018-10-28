<?php

namespace Drupal\myfast_ajax\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Аннотации для плагина MyfastAjax.
 *
 * @Annotation
 */
class MyfastAjax extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * Аргументы плагина.
   *
   * @var array
   */
  public $arg_names = [];
  

}