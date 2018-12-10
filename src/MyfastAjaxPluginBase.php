<?php
namespace Drupal\myfast_ajax;

use Drupal\Component\Plugin\PluginBase;

//

abstract class MyfastAjaxPluginBase extends PluginBase implements MyfastAjaxPluginInterface {



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
   public function getArgNames() {
     # Возвращаем значение аннотации $args.
     if (isset($this->pluginDefinition['arg_names'])) {
       return $this->pluginDefinition['arg_names'];
     }
     return [];
   }

   /**
    * {@inheritdoc}
    */
   public function getArgs() {
     $arg_names = $this->getArgNames();
     $args = [];
     if (!empty($arg_names)) {
       foreach ($arg_names as $arg_name) {
         $args[$arg_name] = NULL;
         if (isset($this->configuration[$arg_name])) {
           $args[$arg_name] = $this->configuration[$arg_name];
         }
       }
     }
     return $args;
   }


  /**
   * {@inheritdoc}
   */
  public function getContent() {
    return '';
  }


}
