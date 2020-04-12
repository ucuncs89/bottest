<?php

require_once __DIR__.'/src/PHPTelebot.php';

$bot = new PHPTelebot('1086380132:AAFkV2Bbjp1lOqoQSRoMawMwDdHGNKnTqZU', '@InfoMonitorBot');

// Simple answer
$bot->cmd('/start', 'Hi, human! I am a bot.');

// Simple whoami command
$bot->cmd('/all', function () {
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

$bot->cmd('info jawa barat||info jabar', function () {
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

$bot->cmd('/about', function () {
    $keyboard[] = [
        ['text' => 'PHPTelebot', 'url' => 'https://github.com/radyakaze/phptelebot'],
        ['text' => 'Haru bot', 'url' => 'https://telegram.me/harubot'],
    ];
    $options = [
        'reply_markup' => ['inline_keyboard' => $keyboard],
    ];

    return Bot::sendMessage('About', $options);
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
