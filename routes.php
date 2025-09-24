<?php
use App\Controllers\AuthController;
use App\Controllers\TaskController;

// Auth
$router->add('GET','/register','App\\Controllers\\AuthController@showRegister');
$router->add('POST','/register','App\\Controllers\\AuthController@register');
$router->add('GET','/login','App\\Controllers\\AuthController@showLogin');
$router->add('POST','/login','App\\Controllers\\AuthController@login');
$router->add('GET','/logout','App\\Controllers\\AuthController@logout');

// Tasks
$router->add('GET','/tasks','App\\Controllers\\TaskController@index');
$router->add('GET','/tasks/create','App\\Controllers\\TaskController@create');
$router->add('POST','/tasks','App\\Controllers\\TaskController@store');
$router->add('GET','/tasks/:id/edit','App\\Controllers\\TaskController@edit');
$router->add('POST','/tasks/:id/update','App\\Controllers\\TaskController@update');
$router->add('POST','/tasks/:id/delete','App\\Controllers\\TaskController@destroy');

// Home -> redirect
$router->add('GET','/','App\\Controllers\\AuthController@showLogin');
