<h3>
    <?=$item->title?>
    <br />
    <small>
        <?=$item->date?>
    </small>
</h3>

<div>
    <p>
        <?=$item->preview?>
    </p>
    <p>&nbsp;</p>

    <?=$item->content?>
    
    <p>&nbsp;</p>
    
    <p>
        <?=URL::anchor(
            $this->page->url,
            '&larr; все новости'
        )?>
    </p>
</div>

<?php if( $this->settings->news_comments_enable ):?>

    <?php if( Modules\Helper::field('comments', 'is_service') AND $item->show_comments ):?>
    
        <div style="margin-top: 30px;">
            <?=Block::get('Comments::Comments', array(
                'item_id'=>$item->id
            ))?>
        </div>
        
    <?php endif?>
    
<?php endif?>