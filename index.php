<?php
$mainPath = __DIR__ . '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask openAI</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/x-icon" href="img/brain.ico">
</head>
<body>
    <h2>Ask AI</h2>
    <div id="container">
        <button onClick="startNewConversation()">Start new conversation from scratch</button>
        <textarea name="answer" id="answer" cols="30" rows="80"></textarea>
        <p>
            Write your question to openAI
            <img src="img/Loading_2.gif" id="loader" />
        </p>        
        <textarea name="main" id="question" cols="30" rows="5"></textarea>
        <button onClick="sendRequest()">Send</button>
    </div>
    <script src="script.js"></script>
</body>
</html>