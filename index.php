<?php

require_once __DIR__.'/src/PHPTelebot.php';

$bot = new PHPTelebot('1086380132:AAFkV2Bbjp1lOqoQSRoMawMwDdHGNKnTqZU', '@InfoMonitorBot');

// Simple answer
$bot->cmd('/start', 'Hi, human! I am a bot.');
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
$bot->cmd('/dkijakarta', function () {
    // Get message properties
    $message = Bot::message();
    $name = $message['from']['first_name'];
    $userId = $message['from']['id'];
    
    $file = "https://api.kawalcorona.com/indonesia/provinsi";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);

    $text = 'Info di <b>'.$data1[0]['attributes']['Provinsi'].'</b> Data Positif <code>'.$data1[0]['attributes']['Kasus_Posi'].'</code> Sembuh <code>'.$data1[0]['attributes']['Kasus_Semb'].'</code> Meninggal<code>'.$data1[0]['attributes']['Kasus_Meni'].'</code>';
    $options = [
        'parse_mode' => 'html',
        'reply' => true,
    ];
    return Bot::sendMessage($text, $options);
});

// inline keyboard
$bot->cmd('/about', function () {
    $keyboard[] = [
        ['text' => 'Website', 'url' => 'https://ucuncs89.com'],
        ['text' => 'About', 'url' => 'https://telegram.me/ucuncs89'],
    ];
    $options = [
        'reply_markup' => ['inline_keyboard' => $keyboard],
    ];

    return Bot::sendMessage('About', $options);
});

// custom regex

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
