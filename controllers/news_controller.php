<?php

class News_Controller extends App\Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('news_m');
        
        $this->template->add_layout('layout');
        
        $this->set_metadata();
    }
    
    /**
     * Список новостей
     */
    function action_index($page = 1)
    {
        if( !is_numeric($page) OR $page <= 0 )
        {
            show_404();
        }
        
        $page = (int)$page;
        
        $list = $this->load->library('News\App\TList', array(
            'model'=>$this->news_m,
            'per_page'=>$this->settings->news_per_page,
            'current_url'=>$this->page->url('news'),
            'current_page'=>$page,
            'default_sort'=>'published_on DESC',
            'url_query'=>false
        ));

        $this->render(array(
            'list'=>$list
        ));
    }
    
    function action_category($url, $page = 1)
    {
        $this->load->model('categories/categories_m');
        
        if( !$category = $this->categories_m->by_url($url)->get_one() )
        {
            show_404();
        }
        
        $page = (int)$page;
        
        $list = $this->load->library('News\App\TList', array(
            'model'=>$this->news_m,
            'per_page'=>$this->settings->news_per_page,
            'current_url'=>'news/category/'. $category->url,
            'current_page'=>$page,
            'where'=>array('category_id'=>$category->id),
            'default_sort'=>'published_on DESC'
        ));
        
        $this->crumb($category->title);
        
        $this->title($category->meta_title ? $category->meta_title : $category->title);
        $category->meta_description ? $this->description($category->meta_description) : '';
        $category->meta_keywords ? $this->keywords($category->meta_keywords) : '';

        $this->render(array(
            'list'=>$list,
            'category'=>$category
        ));
    }
    
    function action_view($news_identifier = false)
    {
        $this->news_m->by_url($news_identifier);
        
        if( !$item = $this->news_m->not_future()->get_one() )
        {
            show_404();
        }
        
        $this->load->model('categories/categories_m');
        
        $this->news_m->increment_views($item->id);
  
        $this->title($item->meta_title ? $item->meta_title : $item->title);
        $item->meta_description ? $this->description($item->meta_description) : '';
        $item->meta_keywords ? $this->keywords($item->meta_keywords) : '';
        
        $category = $this->categories_m->by_id($item->category_id)->get_one();
        
        if( $category )
        {
            $this->crumb($category->title, $this->page->url('news') .'/category/'. $category->url() );
        }
        
        $this->crumb($item->title);

        $this->render(array(
            'item'=>$item
        ));
    }
    
    /**
     * Новости в RSS
     */
    function action_rss()
    {
        $news = $this->news_m->limit(50)->get_all();
    
        $items = array();
        if( $news )
        {
            foreach($news as $new)
            {
                $new->link = \URL::site_url($new->link);
                $new->description = $new->preview;
                $new->date = $new->created_on;
                
                $items[] = $new;
            }
        }
        
        $rss = new Rss;
        $rss->items = $items;
        
        echo $rss->render();
    }
}