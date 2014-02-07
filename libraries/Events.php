<?php

namespace News;

class Events
{
    function __construct()
    {
        \CI::$APP->di->events->register('comments.add.news', function($data){
            \CI::$APP->load->model('news/news_m');   
            \CI::$APP->news_m->increment_comments($data['item_id']);
        });
        
        \CI::$APP->di->events->register('comments.delete.news', function($data){
            \CI::$APP->load->model('news/news_m');
            \CI::$APP->news_m->decrement_comments();
        });
    }
}