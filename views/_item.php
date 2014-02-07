<div class="news-item">
    <h4>
        <?=URL::anchor(
            $item->link,
            $item->title
        )?>
        <br />
        <small><?=$item->date?></small>
    </h4>

    <p>
        <?=$item->preview?>
        
        <?=URL::anchor(
            $item->link,
            'Далее'
        )?> 
    </p>
    
    <p style="text-align: right;">
        <code>Комментариев - <?=$item->comments?></code>
        <code>Просмотров - <?=$item->views?></code>
    </p>
    
    <hr />
</div>