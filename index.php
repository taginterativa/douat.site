<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$loader = require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/src/Api.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Api\ApiController;

$app = new Silex\Application();

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/templates',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
            'driver'    => 'pdo_mysql',
            'host'      => 'localhost',
            'dbname'    => 'vejoaovivo',
            'user'      => 'tag',
            'password'  => 'taglkjh99@',
            'charset'   => 'utf8',
        )
    )
);

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->post('/', function () use ($app) {
    if(isset($_POST['token'])):
       if($_POST['token'] == md5(date('Ymd'))):

           $api = new ApiController($app['db']);
           if(isset($_POST['type'])):
                $type = $_POST['type'];
           else:
                $type = null;
           endif;

           if(isset($_FILES['file'])){
               $rename = uniqid().'_'.$_FILES['file']['name'];
               $file = $rename;
               move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$rename);
           }else{
               $file = null;
           }

           $result = $api->execute($_POST['data'], $type, $file);

           return json_encode($result);
       else:
           return 'ops! sem acesso';
       endif;
    else:
        return 'ops! sem acesso';
    endif;

});




$app['debug'] = true;
$app->run();