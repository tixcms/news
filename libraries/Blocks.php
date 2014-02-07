<?php

namespace News;

class Blocks extends \Block\Items
{
    function items()
    {
        return array(
            'last'=>array(
                'name'=>'Последние новости',
                'class'=>'News::Last',
                'description'=>'Вывод последних новостей'
            ),
            'future'=>array(
                'name'=>'Отложенные новости',
                'class'=>'News::Future',
                'description'=>'Вывод отложенных новостей'
            ),
        );
    }
}