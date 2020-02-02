<?php

use App\Endpoints\JsonPlaceHolderEndpoint;
use App\Input;
use App\Sanitize\HtmlSanitizer;
use App\Sanitize\SpecialCharsSanitizer;

require 'vendor/autoload.php';


if (!isset($argv[1])) {
    die('You must enter string');
}

$input = new Input($argv[1]);

$input->addSanitizer(new HtmlSanitizer())
    ->addSanitizer(new SpecialCharsSanitizer());

$response = JsonPlaceHolderEndpoint::instance()
    ->setInput($input)
    ->submit();

var_dump(json_decode($response->getBody()->getContents(), true));
