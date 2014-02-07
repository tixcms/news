<?php if( $list->total > 0 ):?>

    <?=$list->render_items()?>
    
    <?=$list->render_pager()?>

<?php else:?>
    <p><?=$list->no_items?></p>
<?php endif?>