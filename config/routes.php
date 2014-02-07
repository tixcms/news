<?php

$route['news/category/(:any)'] = 'news/category/$1';
$route['news/(:num)'] = 'news/index/$1';
$route['news/rss'] = 'news/rss';
$route['news/(:any)/(:any)'] = 'show_404';
$route['news/(:any)'] = 'news/view/$1';