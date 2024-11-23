<?php
require('../includes.php');

$apiKey = getEnvVariable('API_KEY');

$data = json_decode(file_get_contents('php://input'), true);
$user_input = cleanStr($data['question']);

$conn = DB::get_instance();

$transport = new Transport(Config::URL, $apiKey);

//todo create frontend (whatever) for determining context
$contextId = 1;
//DB::truncateMessages();
//DB::insertMessage(1, 'system', 'You are the helphul assistent, answering in the style of a wise man');

DB::insertMessage($contextId, 'user', $user_input);

$conversation = [];
$messagesArr = DB::getMessages($contextId);
foreach($messagesArr as $message) {
    $conversation[] = [
        'role' => $message['m_role'],
        'content' => $message['m_content']
    ];
}

//To create a system that remembers conversation history using the OpenAI API, you need to manage conversation history on your side. OpenAI's API itself does not maintain session or memory between API calls. Instead, you handle memory by passing the conversation history as part of the prompt in each API call.
// $conversation = [
//     // [
//     //     'role' => 'system',
//     //     'content' => 'You are the helphul assistent, answering in the style of a rough lumberjack'
//     // ],
//     [
//         "role" => "user",
//         "content" => $user_input
//     ]
// ];

$data = [
    'model' => "gpt-4o",
    'messages' => $conversation
];

$response = $transport->doRequest($data);
$response_arr = json_decode($response);

foreach($response_arr->choices as $choise) {
    DB::insertMessage($contextId, (string)$choise->message->role, (string)$choise->message->content);
}

header('Content-type: application/json');
echo json_encode($response_arr);
