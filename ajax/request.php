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

//To create a system that remembers conversation history using the OpenAI API, you need to manage conversation history on your side. OpenAI's API itself does not maintain session or memory between API calls. Instead, you handle memory by passing the conversation history as part of the prompt in each API call.
$conversation = [
    // [
    //     "role" => "user",
    //     "content" => "who is the president of America"
    // ],
    // [
    //     'role' => 'system',
    //     'content' => 'You are the helphul assistent, answering in the style of a rough lumberjack'
    // ],
    [
        'role' => 'system',
        'content' => 'You are the helphul assistent, answering in the style of a village idiot'
    ],
    [
        "role" => "user",
        "content" => $user_input
    ]
];

$data = [
    'model' => "gpt-4o",
    'messages' => $conversation
];

$response = $transport->doRequest($data);

$response_arr = json_decode($response);

header('Content-type: application/json');
echo json_encode($response_arr);
