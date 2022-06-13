<?php

// Имя скачиваемого файла
$file = "files/public/download.rar";

// Контент-тип означающий скачивание
header("Content-Type: application/octet-stream");

// Размер в байтах
header("Accept-Ranges: bytes");

// Размер файла
header("Content-Length: ".filesize($file));

// Расположение скачиваемого файла
header("Content-Disposition: attachment; filename=".$file);  

// Прочитать файл
readfile($file);

?>