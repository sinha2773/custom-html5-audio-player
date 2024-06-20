<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET['file'])) {
    $root = dirname(__FILE__).'/';
    $file = $root.$_GET['file'];
    $size = filesize($file);
    header('Content-Disposition: filename='.$_GET['file']);
    if(!isset($_SERVER['HTTP_RANGE'])){
        header('Content-Type: '.mime_content_type($file));
        header("Content-Length: ".$size);
        header('Accept-Ranges: bytes');
        readfile($file);
    }else{
        list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
        $rs = explode('-',$range);
        $start = isset($rs[0])&&is_numeric($rs[0]) ? $rs[0]:0;
        $end = isset($rs[1])&&is_numeric($rs[1]) ? $rs[1]: $size-1;
        if($end>$size){
            $end = $size;
        }
        $length = ($end-$start)+1;
        header('HTTP/1.1 206 Partial Content');
        header("Content-Range: bytes $start-$end/$size");
        header("Content-Length: ".$length);
        header('Content-Type: '.mime_content_type($file));
        $fp = fopen($file,'rb');
        fseek($fp, $start);
        $buffer = 1024 * 8;
        while(!feof($fp) && ($p = ftell($fp)) <= $end) {
            if ($p + $buffer > $end) {
                $buffer = $end - $p + 1;
            }
            set_time_limit(0);
            echo fread($fp, $buffer);
            flush();
        }
        fclose($fp);
    }
    die();
}
?>