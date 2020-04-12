<?php

require_once __DIR__.'/src/PHPTelebot.php';

$bot = new PHPTelebot('1086380132:AAFkV2Bbjp1lOqoQSRoMawMwDdHGNKnTqZU', '@InfoMonitorBot');

// Simple answer
$bot->cmd('/start', 'Hi, human! I am a bot.');

// Simple echo command
$bot->cmd('/echo|/say', function ($text) {
    if ($text == '') {
        $text = 'Command usage: /echo [text] or /say [text]';
    }

    return Bot::sendMessage($text);
});

// Simple whoami command
$bot->cmd('/info', function () {
    // Get message properties
    $message = Bot::message();
    $name = $message['from']['first_name'];
    $userId = $message['from']['id'];
    
    $file = "https://api.kawalcorona.com/indonesia/";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);

    $text = 'Info di <b>'.$data[0]['name'].'</b> Data Positif <code>'.$data[0]['positif'].'</code> Sembuh <code>'.$data[0]['sembuh'].'</code> Meninggal<code>'.$data[0]['meninggal'].'</code>';
    $options = [
        'parse_mode' => 'html',
        'reply' => true,
    ];

    return Bot::sendMessage($text, $options);
});

// slice text by space
$bot->cmd('/split', function ($one, $two, $three) {
    $text = "First word: $one\n";
    $text .= "Second word: $two\n";
    $text .= "Third word: $three";

    return Bot::sendMessage($text);
});

/* simple file upload
$bot->cmd('/upload', function () {
    $file = './composer.json';

    return Bot::sendDocument($file);
});*/

// inline keyboard
$bot->cmd('/keyboard', function () {
    $keyboard[] = [
        ['text' => 'PHPTelebot', 'url' => 'https://github.com/radyakaze/phptelebot'],
        ['text' => 'Haru bot', 'url' => 'https://telegram.me/harubot'],
    ];
    $options = [
        'reply_markup' => ['inline_keyboard' => $keyboard],
    ];

    return Bot::sendMessage('Inline keyboard', $options);
});

// custom regex
$bot->regex('/\/number ([0-9]+)/i', function ($matches) {
    return Bot::sendMessage($matches[1]);
});

// Inline
$bot->on('inline', function ($text) {
    $results[] = [
        'type' => 'article',
        'id' => 'unique_id1',
        'title' => $text,
        'message_text' => 'Lorem ipsum dolor sit amet',
    ];
    $options = [
        'cache_time' => 3600,
    ];

    return Bot::answerInlineQuery($results, $options);
});

$bot->run();
