<?php
$time_start = microtime(TRUE);

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Serialization\Json;
use Drupal\myfast_ajax\MyfastAjaxPluginInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

$autoloader = require_once 'autoload.php';
$request = Request::createFromGlobals();
$kernel = DrupalKernel::createFromRequest($request, $autoloader, 'prod');
$kernel->boot();
$container = $kernel->getContainer();

$result = [];
$result['content'] = '';
/* @var \Drupal\myfast_ajax\MyfastAjaxPluginManager $myfast_ajax_plugin_manager */
$myfast_ajax_plugin_manager = $container->get('plugin.manager.myfast_ajax');
if (!empty($_GET['id'])) {
  $myfast_ajax_plugin_id = $_GET['id'];
  if ($myfast_ajax_plugin_manager->hasDefinition($myfast_ajax_plugin_id)) {
    $configuration = [];
    if (isset($_GET['args'])) {
      $configuration = Json::decode($_GET['args']);
    }
    $configuration = $_GET;
    $myfast_ajax = $myfast_ajax_plugin_manager->createInstance($myfast_ajax_plugin_id, $configuration);
    if ($myfast_ajax instanceof MyfastAjaxPluginInterface) {
      $result['content'] = $myfast_ajax->getContent();
    }
  }
}
$time_end = microtime(TRUE) - $time_start;
$result['time_load'] = number_format($time_end, 3, '.', '');

$response = new JsonResponse($result);
$response->send();
$kernel->terminate($request, $response);


