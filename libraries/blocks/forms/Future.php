<?php

namespace News\Blocks\Forms;

class Future extends \Block\Form
{
    function inputs()
    {
        return array(
            'limit'=>array(
                'type'=>'text',
                'label'=>'Кол-во новостей',
                'rules'=>'trim|required|greater_than[0]'
            )
        );
    }
}