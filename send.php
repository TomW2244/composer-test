<?php 
require_once "vendor/autoload.php";

use League\Csv\Reader;
use League\Csv\Statement;

$config = parse_ini_file("server.ini");
$csv = Reader::createFromPath('MOCK_DATA.csv', 'r');
$csv->setHeaderOffset(0); //set the CSV header offset

// setup request
$client = new GuzzleHttp\Client();

$stmt = (new Statement())
    ->offset(0)
    ->limit(10)
;

$records = $stmt->process($csv);



foreach ($records as $record) {
    $r = $client->request('POST', $config['url'], [
    'body' => json_encode($record)
]);
    print_r($r->message);
}



