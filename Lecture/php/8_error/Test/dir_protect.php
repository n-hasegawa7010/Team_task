<?php
function get_filename() {
    $filename=$_POST['filename'];
    // ..(一階層上)を意味する場合不正なアクセスとみなす。
    if (strpos($filename, '..') !== false) {
        exit(' 不正なアクセスです。');
    }
    return str_replace('\0', '', $filename);
}

$filename = get_filename();
$file = 'www/html/' . $filename;
if (file_exists($file) === true) {
    readfile($file); // OK
}
