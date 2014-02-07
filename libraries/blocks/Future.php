<?php

namespace News\Blocks;

/**
 * Блок отложенных новостей
 */
class Future extends \Block
{
    public $options = array(
        'limit'=>3
    );
    
    function data()
    {
        $this->load->model('news/news_m');
        
        $news = $this->news_m->order_by('created_on', 'DESC')->by_future()->limit($this->options['limit'])->get_all();
        
        return array(
            'news'=>$news
        );
    }
}