<?php
require('../includes.php');

//$data = json_decode(file_get_contents('php://input'), true);

$conn = DB::get_instance();

DB::deleteAll();
DB::insertMessage(1, 'system', 'You are the helphul assistent, answering in the style of a rocket science man');