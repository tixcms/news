<?php

namespace News\Admin;

class Form extends \Admin\Form
{    
    const UPLOAD_PATH = 'uploads/news/';
    public $ajax = true;
    
    function init()
    {
        parent::init();
        
        $this->set_inputs();
    }
    
    function before_insert()
    {
        $this->set('created_on', time());
    }
    
    function before_save()
    {
        $this->purify_content();
    }
    
    function after_save()
    {
        if( $this->is_insert() )
        {
            $this->load->model('categories/categories_m');

            if( $this->get('category_id') > 0 )
            {
                $this->categories_m->increment_items($this->get('category_id'));
            }
        }
    }
    
    function set_inputs()
    {
        $this->add_inputs(array(
            'title'=>array(
                'type'=>'text',
                'label'=>lang('news:form-title'),
                'rules'=>'trim|required',
            ),
            
           'url'=>new \Form\Input\Url(array(
                'label'=>lang('news:form-url'),
                'source_input'=>'title',
                'url_prepend'=>'news/view/'
            )),
            'published_on'=>new \Form\Input\DateTime(array(
                'label'=>lang('news:form-published-on')
            )),
            'category_id'=>new \Categories\Form\Input(array(
                'label'=>'Категория',
                'module'=>'news',
                'default_option'=>'Без категории'
            )),
            'show_comments'=>new \Form\Input\Checkbox(array(
                'label'=>lang('news:form-show-comments'),
                'help'=>'Показывать комментарии'
            )),
            'preview'=>array(
                'type'=>'textarea',
                'label'=>lang('news:form-preview'),
                'rules'=>'trim|required'
            ),
            'content'=>array(
                'type'=>'textarea',
                'label'=>lang('news:form-content'),
                'rules'=>'trim|required',
                'xss'=>false,
                'wysiwyg'=>true
            ),
            'img'=>new \Form\Input\File\Image\Simple(array(
                'config'=>array(
                    'upload_path'=>self::UPLOAD_PATH
                ),
                'required'=>false,
                'tab'=>'photo'
            )),
            'meta'=>new \Form\Input\Meta
        ));
    }
    
    function purify_content()
    {
        $purifier = new \Purifier($this->config->item('purifier', 'news'));
        
        $this->set('content', $purifier->purify($this->get('content')));
    }
}