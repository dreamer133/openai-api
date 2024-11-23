<?php
require('includes.php');

// $conn = DB::get_instance();
// DB::insertMessage(2,'system', 'You are helphul assistant styled as lumberjack');
// $messages = DB::getMessages(2);
// print_r($messages);

$api_key = getenv('API_KEY');

print_r($api_key);