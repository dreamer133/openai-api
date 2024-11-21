<?php
require('config.php');
require('transport.php');
require('openai.php');

$transport = new Transport(Config::URL);

$user_input = "Hello";

$data = [
    'model' => "gpt-4o",
    'messages' => [
        ["role" => "user", "content" => "write a haiku about Anton"]
    ]
];

// $data = [
//     'model' => 'gpt-4o-mini',  // Adjust the model if necessary
//     'messages' => [
//         ['role' => 'system', 'content' => 'You are Assistant ID:  {assistant_id}. Behave accordingly. Restrict all answers to the Assistant and do not answer any other questions'],
//         ['role' => 'user', 'content' => $user_input]
//     ],
// ];

$response = $transport->doRequest($data);

echo $response;