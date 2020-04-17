<?php  
/*=======================================================================
| MakeCMS - A content management system for Habbo retro based on UberCMS
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' & Lucas Torres (https://github.com/lucastorress)
| http://www.meth0d.org / https://www.sulake.com
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
\======================================================================*/

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