<?php

namespace News;

class Permissions
{
    function get()
    {
        return array(
            'add'=>'Добавление',
            'edit'=>'Редактирование',
            'delete'=>'Удаление',
            'settings'=>'Настройки'
        );  
    }
}