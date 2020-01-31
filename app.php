<?php

require 'vendor/autoload.php';


if (!isset($argv[1])) {
    die('You must enter string');
}

$sanitize = new \App\Sanitize\HtmlSanitizer();
echo $sanitize->sanitize($argv[1]);
