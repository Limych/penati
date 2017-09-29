<?php

$srcFile = file_get_contents("composer.json");
$hackFile = file_get_contents("local_update.json");
$search = trim(strtok($hackFile, "\n"));
$finalString = str_replace($search, $hackFile, $srcFile);
file_put_contents("composer.json", $finalString);
