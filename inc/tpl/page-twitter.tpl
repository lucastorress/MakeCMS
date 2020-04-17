<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Hora da Manutenção !</title>
<style type="text/css">
body
{
   background-color: #FFFFFF;
   background-image: url(images/maintenance/33.gif);
   color: #000000;
}
</style>
<script type="text/javascript">
<!--
function SwapImage()
{
   var doc=document, args=arguments;
   doc.$imgSwaps = new Array();
   for(var i=2; i<args.length; i+=2)
   {
      var elem=FindObject(args[i]);
      if(elem)
      {
         doc.$imgSwaps[doc.$imgSwaps.length]=elem;
         elem.$src=elem.src;
         elem.src=args[i+1];
      }
   }
}
function FindObject(id, doc)
{
   var child, elem;
   if(!doc)
      doc=document;
   if(doc.getElementById)
      elem=doc.getElementById(id);
   else
   if(doc.layers)
      child=doc.layers;
   else
   if(doc.all)
      elem=doc.all[id];
   if(elem)
      return elem;
   if(doc.id==id || doc.name==id)
      return doc;
   if(doc.childNodes)
      child=doc.childNodes;
   if(child)
   {
      for(var i=0; i<child.length; i++)
      {
         elem=FindObject(id,child[i]);
         if(elem)
            return elem;
      }
   }
   var frm=doc.forms;
   if(frm)
   {
      for(var i=0; i<frm.length; i++)
      {
         var elems=frm[i].elements;
         for(var j=0; j<elems.length; j++)
         {
            elem=FindObject(id,elems[i]);
            if(elem) return elem;
         }
      }
   }
   return null;
}
//-->
</script>
<script type="text/javascript">
<!--
function Preloadimages/maintenance()
{
   var imageObj = new Image();
   var images/maintenance = new Array();
   images/maintenance[0]="./images/maintenance/img0009.png";
   images/maintenance[1]="./images/maintenance/img0009_over.png";
   images/maintenance[2]="./images/maintenance/img0010.png";
   images/maintenance[3]="./images/maintenance/img0010_over.png";
   images/maintenance[4]="./images/maintenance/img0011.png";
   images/maintenance[5]="./images/maintenance/img0011_over.png";
   for (var i=0; i<=5; i++)
   {
      imageObj.src = images/maintenance[i];
   }
}
// -->
</script>
</head>
<body>
<div id="wb_Image1" style="position:absolute;left:222px;top:113px;width:5px;height:319px;z-index:0;" align="left">
<img src="images/maintenance/left.bmp" id="Image1" alt="" align="top" border="0" style="width:5px;height:319px;"></div>
<div id="wb_Image2" style="position:absolute;left:222px;top:432px;width:576px;height:27px;z-index:1;" align="left">
<img src="images/maintenance/footer.PNG" id="Image2" alt="" align="top" border="0" style="width:576px;height:27px;"></div>
<div id="wb_Image3" style="position:absolute;left:227px;top:115px;width:564px;height:321px;z-index:2;" align="left">
<img src="images/maintenance/imagem221.PNG" id="Image3" alt="" align="top" border="0" style="width:564px;height:321px;"></div>
<div id="wb_Image5" style="position:absolute;left:791px;top:115px;width:7px;height:327px;z-index:3;" align="left">
<img src="images/maintenance/big.PNG" id="Image5" alt="" align="top" border="0" style="width:7px;height:327px;"></div>
<div id="wb_Image6" style="position:absolute;left:223px;top:48px;width:574px;height:67px;z-index:4;" align="left">
<img src="images/maintenance/imagem221.PNG" id="Image6" alt="" align="top" border="0" style="width:574px;height:67px;"></div>
<div id="wb_Image7" style="position:absolute;left:222px;top:46px;width:576px;height:79px;z-index:5;" align="left">
<img src="images/maintenance/email_Header.gif" id="Image7" alt="" align="top" border="0" style="width:576px;height:79px;"></div>
<div id="wb_NavigationBar2" style="position:absolute;left:258px;top:130px;width:507px;height:37px;z-index:6;" align="left">
<table border="0" cellpadding="0" cellspacing="0" id="NavigationBar2">
<tr>
<td align="left" valign="top" width="169" height="37"><a href="/maintenance"><img id="img0009" src="images/maintenance/img0009.png" alt="" align="top" border="0" width="169" height="37" onmouseover="SwapImage(1,0,'img0009','images/maintenance/img0009_over.png')" onmouseout="SwapImage(0,0,'img0009','images/maintenance/img0009.png')"></a></td>
<td align="left" valign="top" width="169" height="37"><a href="/sobre"><img id="img0010" src="images/maintenance/img0010.png" alt="" align="top" border="0" width="169" height="37" onmouseover="SwapImage(1,0,'img0010','images/maintenance/img0010_over.png')" onmouseout="SwapImage(0,0,'img0010','images/maintenance/img0010.png')"></a></td>
<td align="left" valign="top" width="169" height="37"><a href="/twitter"><img id="img0011" src="images/maintenance/img0011.png" alt="" align="top" border="0" width="169" height="37" onmouseover="SwapImage(1,0,'img0011','images/maintenance/img0011_over.png')" onmouseout="SwapImage(0,0,'img0011','images/maintenance/img0011.png')"></a></td>
</tr>
</table>
</div>
<div id="Html1" style="position:absolute;left:227px;top:172px;width:566px;height:282px;z-index:7">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 3,
  interval: 6000,
  width: 566,
  height: 282,
  theme: {
    shell: {
      background: '#ffffff',
      color: '#000000'
    },
    tweets: {
      background: '#edf4ff',
      color: '#332d33',
      links: '#0788eb'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    behavior: 'all'
  }
}).render().setUser('%twitter%').start();
</script></div>
</body>
</html>