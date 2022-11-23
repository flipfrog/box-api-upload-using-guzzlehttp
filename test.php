<?php

require 'vendor/autoload.php';
$config = require('./config/box.php');

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://upload.box.com/api/2.0/',
    'timeout'  => 2.0,
]);

try {
    $res = $client->request('POST', 'files/content', [
        'headers' => [
            'Authorization' => 'Bearer ' . $config['accessToken'],
        ],
        'multipart' => [
            [
                'name' => 'parent_id',
                'contents' => 0, // 0: root folder
            ],
            [
                'name' => 'file',
                'contents' => \GuzzleHttp\Psr7\Utils::tryFopen('./data/test.txt', 'rb'),
                'filename' => 'my_test.txt', // optional to specify file name on box
            ],
        ],
    ]);
    echo '*** response=' . $res->getBody();
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    echo '*** error=' . $e->getResponse()->getBody()->getContents() . "\n";
}
