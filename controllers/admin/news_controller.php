<?php

/**
 * Административная часть
 */
class News_Controller extends Admin\Controller 
{
    public $has_settings = true;
    public $has_help = true;
    public $has_categories = true;
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('news_m');
        
        $this->load->language('admin');
        
        $this->config->merge('admin');
    }
    
    /**
     * Таблица новостей
     */
    function action_index()
    {
        $table = $this->load->library('News\Admin\Table', array(
            'model'=>$this->news_m,
            'per_page'=>$this->user->settings('news_admin_per_page')
        ));

        if( $this->is_ajax() )
        {
            echo $table->render('json');
        }
        else
        {
            $this->render(array(
                'table'=>$table
            ));
        }
    }
    
    /**
     * Редактирование
     */
    function action_edit($id)
    {
        if( !$this->user->can_access('news_edit') )
        {
            $this->alert->set_flash('attention', 'У вас нет доступа к редактированию новостей');
            
            $this->redirect('admin/news');
        }
        
        if( !$news = $this->news_m->by_id($id)->get_one() )
        {
            show_404();
        }

        $this->form($news);
    }
    
    /**
     * Добавление
     */
    function action_add()
    {
        if( !$this->user->can_access('news_add') )
        {
            $this->alert->set_flash('attention', 'У вас нет доступа к добавлению новостей');
            
            $this->redirect('admin/news');
        }
        
        $this->form();
    }

    /**
     * Редактирование и добавление
     */
    function form($news = false)
    {
        $form = $this->load->library('News\Admin\Form', array(
            'entity'=>$news, 
            'model'=>$this->news_m
        ));

        if( $form->submitted() )
        {
            if( $form->save() )
            {
                $this->events->trigger($form->is_update() ? 'news.admin.edit' : 'news.admin.add');
                
                $form->response('success', array(
                    'edit'=>'Изменения сохранены',
                    'add'=>'Новость добавлена'
                ));         
            }
            else
            {
                $form->response('error');
            }
        }

        $this->render('form', array(
            'form'=>$form
        ));
    }
    
    /**
     * Удаление
     */
    function action_delete($id)
    {
        if( !Security::check_csrf_token() )
        {
            show_404();
        }
        
        if( !$this->user->can_access('news_delete') )
        {
            if( $this->is_ajax() )
            {
                echo json_encode(array(
                    'success'=>false,
                    'type'=>'attention',
                    'text'=>'У вас нет прав на удаление новостей'
                ));
                
                return;
            }
            else
            {
                $this->alert->set_flash('attention', 'У вас нет прав на удаление новостей');
                
                $this->redirect('admin/news');
            }
        }
        
        $news = $this->news_m->by_id($id)->get_one();
        
        $this->news_m->by_id($id)->delete();
        
        if( $news->category_id )
        {
            $this->load->model('categories/categories_m');
            $this->categories_m->decrement_items($news->category_id);
        }
        
        $this->events->trigger('news.admin.delete');
            
        if( $this->is_ajax() )
        {
            echo json_encode(array(
                'success'=>true,
                'type'=>'success',
                'text'=>'Новость удалена'
            ));
        }
        else
        {
            $this->alert->set_flash('success', 'Новость удалена');
                
            $this->referer();
        }
    }
}