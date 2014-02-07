<?php

namespace News\Admin;

class Table extends \Admin\Table
{
    public $item_view = '_item';
    public $no_items = 'Нет новостей';
    public $headings = array(
        'title'=>array(
            'label'=>'Заголовок',
            'sortable'=>true,
            'searchable'=>true
        ),
        'category_id'=>array(
            'label'=>'Категория'
        ),
        'published_on'=>array(
            'label'=>'Дата публикации',
            'sortable'=>true
        ),
        'Действия'
    );
    public $ajax = true;
    public $search = 'auto';
    public $default_sort = 'created_on DESC';
    
    function init()
    {        
        parent::init();
        
        if( $this->model->by_future()->count() )
        {
            $this->filters = array(
                'status'=>array(
                    'options'=>array(
                        'all'=>'Все новости',
                        'published'=>'Опубликованные',
                        'future'=>'Отоженные'
                    )
                )
            );
        }
    }
    
    function get_items()
    {
        $this->model->with('categories', '', 'left');
        
        return parent::get_items();
    }
    
    function filter()
    {        
        if( $status = $this->url_query->get('status') )
        {
            switch($status)
            {
                case 'published':
                    $this->model->where('published_on <', time());
                    break;
                    
                case 'future':
                    $this->model->where('published_on >', time());
                    break;
            }
            
            $this->filters['status']['skip'] = true;
        }
        
        parent::filter();
    }
}