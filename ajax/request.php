<?php
$mainPath = '../';
$classesDir = $mainPath . 'classes/';
$functionsDir = $mainPath . 'functions/';

require($classesDir . 'config.php');
require($classesDir . 'transport.php');
require($functionsDir . 'util.php');


$apiKey = getEnvVariable('API_KEY');

$data = json_decode(file_get_contents('php://input'), true);
$user_input = cleanStr($data['question']);

$transport = new Transport(Config::URL, $apiKey);

$data = [
    'model' => "gpt-4o",
    'messages' => [
        [
            "role" => "user", 
            "content" => $user_input
        ]
    ]
];

$response = $transport->doRequest($data);

$response_arr = json_decode($response);

header('Content-type: application/json');
echo json_encode($response_arr);