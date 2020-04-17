<?php  
function replaceSwf($src,$dest) 
{ 
    $content=file_get_contents($src);  

    $header=substr($content, 0, 8);  

    $content=gzuncompress(substr($content, 8));  

    // replace variables  
    $content=str_replace("varoke","stage-hotel.sytes.net",$content);  

    // compress SWF file  
    $content=$header.gzcompress($content);    

    // save new SWF  
    $fp=fopen($dest,"wb");  
    $result=fwrite($fp,$content);  
    fclose($fp);  
} 

replaceSwf("Habbo.swf","Habbo2.swf");  
?>