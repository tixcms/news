<?php if( $this->user->can_access('news_add') ):?>

    <div class="page-header">
        <div class="header-actions">
            <?=URL::anchor(
                'admin/news/add', 
                'Добавить новость', 
                array(
                    'class'=>'btn btn-primary'
                )
            )?>
        </div>
    </div>
    
<?php endif?>

<?=$table->render()?>