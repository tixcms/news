<?php

namespace News;

class Entity extends \Tix\Model\Entity 
{
    function img_path()
    {
        return \CI::$APP->di->url->site_url(Admin\Form::UPLOAD_PATH . $this->img, false); 
    }
    
    function link()
    {
        return \CI::$APP->page->url('news') .'/'. $this->url;
    }
    
    function date()
    {
        return \Helpers\Date::nice($this->published_on);
    }
    
    function is_future_post()
    {
        return $this->published_on > time();
    }
}