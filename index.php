<?php

// 抓B站表情

$json = file_get_contents('https://api.bilibili.com/x/emote/user/panel/web?business=reply');

$json = json_decode($json, true);

$json = $json['data']['packages'];
if(!is_dir(__DIR__.'/emojis')){
    mkdir('emojis');
}

foreach ($json as $key => $value){
    if($value['type']!==1){
        continue;
    }
    if(!is_dir(__DIR__.'/emojis/'.$value['text'])){
        mkdir(__DIR__.'/emojis/'.$value['text']);
    }
    foreach($value['emote'] as $v){
        if(!file_exists(__DIR__."/emojis/".'/'.$value['text'].'/'.$v['text'])){
            file_put_contents(__DIR__."/emojis/".'/'.$value['text'].'/'.$v['text'].".png",file_get_contents($v['url']));
        }
    }
}