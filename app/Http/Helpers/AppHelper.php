<?php 
// Archivo: AppHelper.php
// Ubicación: App/Helpers/AppHelper.php
// Descripción: Implementa las funciones
// necesarias para operar con mayor facilidad
// los métodos definidos por default en el framework.

function appGetAction($route_current) {
  $action = $route_current->getAction();
  return $action;
}

function appGetController($route_current) {
  $action = $route_current->getAction();
  $tmp = explode('\\', current(explode("@", $action["controller"])));
  $controller = end($tmp);
  return $controller;
}

function appGetView($route_current) {
  $action = $route_current->getAction();
  $tmp = explode("@", $action["controller"]);
  $view = end($tmp);
  return $view;
}