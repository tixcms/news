<?php

class News_m extends Tix\Model
{
    function _relations()
    {
        return array(
            'categories'=>array('categories/categories_m', 'category_id', 'category')
        );  
    }
    
    function increment_views($id)
    {
        $this->set('views', 'views + 1', false)->by_id($id)->update();
    }
    
    function increment_comments($id)
    {
        $this->set('comments', 'comments + 1', false)->by_id($id)->update();
    }
    
    function decrement_comments($id)
    {
        $this->set('comments', 'comments - 1', false)->by_id($id)->update();
    }
    
    function by_published()
    {
        $this->not_future();
        
        return $this;
    }
    
    /**
     * Выбор отложенных новостей
     */
    function by_future()
    {
        $this->where('published_on >', time());
        
        return $this;
    }
    
    function not_future()
    {
        $this->where('published_on <', time());
        
        return $this;
    }
}