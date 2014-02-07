<?php

namespace News;

class Settings extends \Settings\Form
{    
    function tabs()
    {
        return array(
            'app'=>'Сайт',
            'admin'=>'Админка'
        );
    }
    
    function inputs()
    {
        return array(
            'news_per_page'=>array(
                'type'=>'text',
                'label'=>'Новостей на страницу',
                'default'=>10,
                'tab'=>'app'
            ),
            'news_comments_enable'=>new \Form\Input\Checkbox(array(
                'label'=>'Выводить комментарии',
                'default'=>1,
                'tab'=>'app'
            )),
            
            'news_admin_per_page'=>array(
                'type'=>'text',
                'label'=>'Новостей на страницу',
                'rules'=>'trim|required|greater_than[0]',
                'default'=>10,
                'tab'=>'admin',
                'personal'=>true
            )
        );
    }
}