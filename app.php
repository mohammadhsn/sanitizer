<?php

use App\Application;
use App\Endpoints\JsonPlaceHolderEndpoint;
use App\Input;
use App\Sanitizers\HtmlSanitizer;
use App\Sanitizers\SpecialCharsSanitizer;

require 'vendor/autoload.php';


if (!isset($argv[1])) {
    die('You must enter string');
}

$input = new Input($argv[1]);

$input->addSanitizer(new HtmlSanitizer())
    ->addSanitizer(new SpecialCharsSanitizer());


$app = new Application($input, JsonPlaceHolderEndpoint::instance());
$app->run();
