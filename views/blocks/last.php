<?php if( $news ):?>
    <ul>
        <?php foreach($news as $news):?>
            <li>
                <?=URL::anchor(
                    $news->link,
                    $news->title
                )?>
            </li>
        <?php endforeach?>
    </ul>
    
    <p style="text-align: right;">
        <?=URL::anchor(
            $this->page->url('news'),
            'Все новости'
        )?>
    </p>
<?php else:?>
    <p>Нет новостей</p>
<?php endif?>