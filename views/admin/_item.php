<tr class="item" data-id="<?=$item->id?>">
    <td style="text-align: left;">
    
        <?php if( $this->user->can_access('news_edit') ):?>
    
            <?=$this->url->anchor(
                'admin/news/edit/'. $item->id, 
                $item->title
            )?>
    
        <?php else:?>
        
            <?=$item->title?>
            
        <?php endif?>
        
        <?php if( $item->is_future_post() ):?>
            <small class="label label-warning">
                отложенная
            </small>
        <?php endif?>
    </td>
    <td>
        <?=isset($item->category->id) ? $item->category->title : 'Без категории'?>
    </td>
    <td class="center" style="width: 15%;">
        <?=$item->date?>
    </td>
    <td class="actions-td">
    	<ul class="actions">
            <?php if( $this->user->can_access('news_delete') ):?>
        		<li>
                    <?=$this->url->anchor_protected(
                        'admin/news/delete/'. $item->id, 
                        '',
                        array(
                            'class'=>'delete ajax-delete confirm',
                            'data-confirm'=>'Удалить новость?'
                        )
                    )?>
                </li>
            <?php endif?>
    	</ul>
    </td>
</tr>