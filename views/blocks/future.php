<?php if( $news ):?>
    <ul>
        <?php foreach($news as $news):?>
            <li>
                <?=$news->title?>
            </li>
        <?php endforeach?>
    </ul>
<?php else:?>
    <p>Нет отложенных новостей новостей</p>
<?php endif?>