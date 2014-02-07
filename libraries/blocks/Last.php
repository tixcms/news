<?php

namespace News\Blocks;

class Last extends \Block
{
    public $options = array(
        'limit'=>3
    );
    
    function data()
    {
        $this->load->model('news/news_m');
        
        $news = $this->news_m->not_future()->order_by('created_on', 'DESC')->limit($this->options['limit'])->get_all();
        
        return array(
            'news'=>$news
        );
    }
}