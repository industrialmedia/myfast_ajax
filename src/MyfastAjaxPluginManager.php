<?php

namespace Drupal\myfast_ajax;

use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;


/**
 * Менеджер нашего плагина MyfastAjax
 */
class MyfastAjaxPluginManager extends DefaultPluginManager {




  /**
   * Constructs
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/MyfastAjax',
      $namespaces,
      $module_handler,
      'Drupal\myfast_ajax\MyfastAjaxPluginInterface',
      'Drupal\myfast_ajax\Annotation\MyfastAjax'
    );

    # Регистрируем hook_myfast_ajax_info_alter();
    $this->alterInfo('myfast_ajax_info');

    # Задаем ключ для кэша плагинов.
    $this->setCacheBackend($cache_backend, 'myfast_ajax');
    $this->factory = new DefaultFactory($this->getDiscovery());
  }

}