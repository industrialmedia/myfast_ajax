<?php

namespace Drupal\myfast_ajax\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\myfast_ajax\MyfastAjaxPluginManager;
use Drupal\Core\Url;
use Drupal\myfast_ajax\MyfastAjaxPluginInterface;

class MyfastAjaxController extends ControllerBase {


  /**
   * The myfast ajax plugin manager.
   *
   * @var \Drupal\myfast_ajax\MyfastAjaxPluginManager
   */
  protected $myfastAjaxPluginManager;


  /**
   * Constructs
   *
   * @param \Drupal\myfast_ajax\MyfastAjaxPluginManager
   *   The myfast ajax plugin manager.
   */
  public function __construct(MyfastAjaxPluginManager $myfast_ajax_plugin_manager) {
    $this->myfastAjaxPluginManager = $myfast_ajax_plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    /* @var \Drupal\myfast_ajax\MyfastAjaxPluginManager $myfast_ajax_plugin_manager */
    $myfast_ajax_plugin_manager = $container->get('plugin.manager.myfast_ajax');
    return new static(
      $myfast_ajax_plugin_manager
    );
  }


  public function listPage() {

    // Копировать файл
    $file_path_from = './' . drupal_get_path('module', 'myfast_ajax') . '/ajax.php';
    $file_path_to = './ajax.php';
    if (!file_exists($file_path_to)) {
      if (file_exists($file_path_from)) {
        if (!copy($file_path_from, $file_path_to)) {
          $this->messenger()->addError('Не удалось скопировать файл ajax.php');
        }
      }
      else {
        $this->messenger()->addError('Не удалось найти файл ajax.php');
      }
    }
    else {
      $build['messenge']['#markup'] = '<p>Файл <strong>ajax.php</strong> успешно найден в корневом каталоге.</p>';
    }


    $build['table_list'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Id'),
        $this->t('Ajax path'),
        $this->t('Provider'),
        $this->t('Class'),
      ],
      '#empty' => $this->t('There are no fast ajax plugins.'),
    ];

    $definitions = $this->myfastAjaxPluginManager->getDefinitions();
    if (!empty($definitions)) {
      foreach ($definitions as $definition) {
        $plugin_id = $definition['id'];
        $myfast_ajax = $this->myfastAjaxPluginManager->createInstance($plugin_id);
        $arg_names = [];
        if ($myfast_ajax instanceof MyfastAjaxPluginInterface) {
          $arg_names = $myfast_ajax->getArgNames();
        }
        $ajax_path = '/ajax.php?id=' . $plugin_id;
        if ($arg_names) {
          foreach ($arg_names as $arg_name) {
            $ajax_path .= '&' . $arg_name . '=...';
          }
        }
        $row = [];
        $row['id']['#markup'] = $plugin_id;
        $row['ajax_path'] = [
          '#type' => 'link',
          '#title' => $ajax_path,
          '#url' => Url::fromUserInput($ajax_path),
          '#options' => [
            'attributes' => ['target' => '_blank'],
          ],
        ];
        $row['provider']['#markup'] = $definition['provider'];
        $row['class']['#markup'] = $definition['class'];
        $build['table_list'][] = $row;
      }
    }

    return $build;
  }


}
