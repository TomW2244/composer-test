<?php 
require_once "vendor/autoload.php";

use League\Csv\Reader;
use League\Csv\Statement;

$csv = Reader::createFromPath('MOCK_DATA.csv', 'r');
$csv->setHeaderOffset(0); //set the CSV header offset

// setup request
$client = new GuzzleHttp\Client();
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://requestbin.net/r/117jch31');

//get 25 records starting from the 11th row
$stmt = (new Statement())
    ->offset(0)
    ->limit(10)
;

$records = $stmt->process($csv);



foreach ($records as $record) {
    $r = $client->request('POST', 'http://requestbin.net/r/117jch31', [
    'body' => json_encode($record)
]);
    print_r($r->message);
}






// Send an asynchronous request.




