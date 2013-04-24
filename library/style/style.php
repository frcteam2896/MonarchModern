<?php 
header("Content-type: text/css; charset: UTF-8");
require "lessc.inc.php";
$less = new lessc;
$less->setFormatter("compressed");
echo $less->compileFile("style.less");
?> 