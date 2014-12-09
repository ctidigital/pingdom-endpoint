<?php

require "vendor/autoload.php";

if (file_exists("config.php"))
  include "config.php";           // Set $room and $api_key here if desired

use PageBoost\HipChatV2\HipChat;

$room = "";
$api_key = "";

$incoming = json_decode($_REQUEST['message']);

$colour = $incoming['action'] == "notify_of_close" ? HipChat::COLOR_GREEN : HipChat::COLOR_RED;
$hipchat_alert = "<strong>" . $incoming['checkname'] . "</strong>, host: " . (isset($incoming['host']) ? $incoming['host'] : 'n/a') . ", description: " . $incoming['description'];

$hipchat->room($room)->send($hipchat_alert, true, $colour, HipChat::FORMAT_HTML);