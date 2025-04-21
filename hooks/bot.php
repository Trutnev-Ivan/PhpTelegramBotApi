<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/telegram/Loader.php";

$data = file_get_contents("php://input");


\Telegram\Loader::load($_SERVER["DOCUMENT_ROOT"]."/telegram/");
\Telegram\Bots\PasswordGeneratorBot::processWebhook();