<div class="page-header">
    <h2>
        Новости
        
        <small>
            <?=URL::anchor(
                $this->page->url. '/rss',
                'RSS',
                array(
                    'title'=>'Новости в RSS'
                )
            )?>
        </small>
    </h2>
</div>

<?=$content?>