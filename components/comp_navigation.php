<?

$titles_arr = array();

$titles_arr[] = 'Ветко Сергей всегда выигрывает';
$titles_arr[] = 'Ветко Сергей никогда не проигрывает';

$rand = rand ( 0, 1 );
$title = isset ( $titles_arr [$rand] ) ? $titles_arr[$rand] : $titles_arr[0];
