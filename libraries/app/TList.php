<?php

namespace News\App;

class TList extends \App\TList
{
    public $view = 'tlist';
    public $item_view = '_item';
    public $no_items = 'Нет новостей';
    
    function filter()
    {
        $this->model->by_published();
        
        parent::filter();
    }
    
    function get_pager()
    {
        $pager = parent::get_pager();
        
        $pager->set_generate_url_with_query(false);
        
        return $pager;
    }
}