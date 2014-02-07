<?php

$config['purifier'] = array(
    'HTML.AllowedAttributes'=>array('a.href', 'img.src', 'img.alt', 'img.style'),
    'HTML.AllowedElements'=>array('p', 'strong', 'a', 'em', 'del', 'blockquote', 'code', 'pre', 'img', 'b', 'ul', 'ol', 'li'),
    'HTML.Nofollow'=>true,
    'AutoFormat.AutoParagraph'=>true,
    'AutoFormat.Linkify'=>true,
    'Output.Newline'=>"\n"
);