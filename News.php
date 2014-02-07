<?php

/**
 * Новости
 * 
 * Дополнение для создание новостной ленты
 */
class News extends Modules\Addons\Entity
{
    public $name = 'Новости';
    public $description = 'Лента новостей';
    public $version = '0.26';
    public $url = 'news';
    public $is_frontend = 1;
    public $is_backend = 1;
    public $is_menu = 1;
    public $group = 'content';
    public $author = 'TixCMS';
    
    function versions()
    {
        return array(
            '0.23', '0.25'
        );
    }
    
    function update_to_0_25()
    {
        $this->db->query("ALTER TABLE  ". $this->db->dbprefix('news') ." ADD  `img` VARCHAR( 255 ) NOT NULL AFTER  `content`");
        
        \Helpers\File::make_path(\News\Admin\Form::UPLOAD_PATH);
    }
    
    function update_to_0_23()
    {
        $this->db->query("ALTER TABLE  ". $this->db->dbprefix('news') ." ADD  `category_id` INT UNSIGNED NOT NULL AFTER  `id`");
        $this->db->query("ALTER TABLE  ". $this->db->dbprefix('news') ." CHANGE  `url`  `url` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL");
    }
    
    function install()
    {        
        $this->db->query("
            CREATE TABLE IF NOT EXISTS ". $this->db->dbprefix('news') ." (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `url` varchar(50) NOT NULL,
              `title` varchar(100) NOT NULL,
              `preview` text NOT NULL,
              `content` text NOT NULL,
              `published_on` int(10) unsigned NOT NULL,
              `created_on` int(10) unsigned NOT NULL,
              `updated_on` int(10) unsigned NOT NULL,
              `comments` int(10) unsigned NOT NULL,
              `views` int(10) unsigned NOT NULL,
              `show_comments` tinyint(1) NOT NULL,
              `meta_title` varchar(255) NOT NULL,
              `meta_description` varchar(255) NOT NULL,
              `meta_keywords` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
        ");
    }
    
    function uninstall()
    {        
        $this->db->query("DROP TABLE IF EXISTS ". $this->db->dbprefix('news'));
    }
}