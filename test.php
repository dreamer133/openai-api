<?php
require('includes.php');

$conn = DB::get_instance();

//DB::truncateMessages();
DB::insertMessage(2,'system', 'You are helphul assistant styled as lumberjack');

$messages = DB::getMessages(2);
print_r($messages);