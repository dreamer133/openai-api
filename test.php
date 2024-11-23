<pre>
<?php
require('includes.php');

// $conn = DB::get_instance();
// DB::insertMessage(2,'system', 'You are helphul assistant styled as lumberjack');
// $messages = DB::getMessages(2);
// print_r($messages);

$api_key = getenv('API_KEY');
echo '...';
print_r($api_key);

print_r(get_defined_vars());
?>
</pre>