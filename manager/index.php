<?php
// Error Reporting
error_reporting(E_ALL);

if (is_file('config.php')) {
	require_once('config.php');
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Document
//$document = new Document();
//$registry->set('document', $document);

// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$registry->set('response', $response);

// Session
$session = new Session();
$registry->set('session', $session);

//Url
$url = new Url(HTTP_SERVER);
$registry->set('url', $url);

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

//User
$user = new User($registry);
$registry->set('user', $user);

// Front
$controller = new Front($registry);
$action="";
if (isset($request->get['route'])) {    
    $action = new Action($request->get['route']);       
}else{
   $response->redirect("?route=dashboard/home"); 
}

$controller->dispatch($action, new Action('error/notfound'));
$response->output();