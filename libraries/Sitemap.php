<?php

namespace News;

class Sitemap extends \Sitemap
{
    function get_data()
    {
        $this->load->model('news/news_m');        
        $items = $this->news_m->by_published()->order_by('created_on', 'DESC')->get_all();
        
        $data = array();
                
        if( $items )
        {
            foreach($items as $item)
            {
                $data[] = array(
                    'loc'=>$this->di->url->site_url( $item->link() ),
                    'lastmod'=>date('c', $item->updated_on),
                    'changefreq'=>'daily',
                    'priority'=>0.8*0.8
                );
            }
        }
        
        return $data;
    }
}