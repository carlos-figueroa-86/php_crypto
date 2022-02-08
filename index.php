<?php

use controller\Exampled;

require_once 'Utils/crypto_.php';
require_once 'class.exampled.php';

$exampled = new Exampled();

echo "<br>";
echo "<pre>";
echo "<code>";
echo "<b>Exampled created ApiKey:</b> <br><br>";
echo '' . $exampled->createApiKey();
echo "</code>";
echo "</pre>";
echo "<br>";
echo "<br>";

// An encrypted message is created from a stringg
$textMessage = "Hello I'm a normal message";
echo "Message normal: <b>$textMessage</b>";


echo "<br>";
// By uncommenting the following line you can see that it does not decrypt the message, since the text was modified
// $messageEncrypted = $exampled->setEncrypterMessage($textMessage) .  "1";
$messageEncrypted = $exampled->setEncrypterMessage($textMessage);
echo "Message encrypted: $messageEncrypted";
echo "<br>";

// Get the decrypted message
echo "Message decrypted: <b>" . $exampled->getDescrypterMessage($messageEncrypted) . "</b>";
echo "<br>";
