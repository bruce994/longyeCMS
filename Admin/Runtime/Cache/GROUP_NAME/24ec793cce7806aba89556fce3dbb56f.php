<?php if (!defined('THINK_PATH')) exit();?>
<script type="text/javascript" language="javascript" src="http://api.51ditu.com/js/maps.js"></script>
<script type="text/javascript" src="http://api.51ditu.com/js/search.js"></script>  

<script type="text/javascript">
var map_id = 'mymap';
var p1 = '114.2957';
var p2 = '30.59293';
var mark = 'mark';
var title = '';
var content = '';
var width = 600;
var height = 350;
var view_level = 2;
</script>
</head>
<body style="margin:0;">
<div id="mymap" style="width:100%; height:<?php echo $_GET['height'];?>px; float:left;">loading...</div>

 <script type="text/javascript">
var maps = new LTMaps( map_id );
if(height < 300) {
  var control = new LTStandMapControl( 2 );
} else {
  var control = new LTStandMapControl( );
}
maps.addControl(control);



<?php  $channel = M("Channeltype")->where("isCoordinate=1")->field("id")->select(); if(count($channel)>0){ foreach ($channel as $ch) { $map = array(); if(intval($_SESSION["admin"]['usertype']) != 10 ){ $map['userid'] = array('eq',$_SESSION["admin"]['userid']); } $addon = M("Addon".$ch['id'])->where($map)->limit("0,200")->select(); foreach ($addon as $add) { if($add['longitude'] && $add['latitude']){ $content = ''; $channelField = M("Channelfield")->where("chid=".$ch['id']." and displaylist=0")->order("sort")->field("title,fieldname,typeid,rel_table,rel_field")->select(); foreach ($channelField as $field) { $content .= "<p style=\"text-align:left\">".$field['title'].":".fieldValue($add[$field['fieldname']],$field['typeid'],$field['rel_table'],$field['rel_field'])."</p>"; } ?>     
     
      p1 = <?php echo $add['longitude'];?> * 100000;
      p2 = <?php echo $add['latitude'];?> * 100000;
      var point = new LTPoint (p1, p2);
      maps.cityNameAndZoom ( point , view_level );

      var marker = new LTMarker( point );
      maps.addOverLay ( marker );


      var infoWin=new LTInfoWindow(point,[15,-5]);
      infoWin.setTitle("<a target='_parent'  href='<?php echo U("Type/article",array("aid"=>$add['aid'],"channel"=>$add['channel'],"ss"=>3));?>'>详细查看</a>"); 
      infoWin.setLabel('<?php echo Compress_Html($content);?>'); 
      infoWin.setWidth(100); 
      maps.addOverLay( infoWin ); 


    <?php
 } } } ?>
<?php }else{ ?>
  maps.cityNameAndZoom( "<?php echo C("city");?>" , view_level );
<?php } ?>




<?php  if($_GET['city'] && $_GET['keyword']){ ?>
function showPoint(searchResult)  
  {  
      if(searchResult.searchPoints.length>0)//如果存在搜索结果  
      {  
        var poi=searchResult.searchPoints[0];//搜索结果中的第一项  
        //alert(poi.name+'\nNTU坐标:'+poi.point); 
        p = poi.point;
        p1 = p[0];
        p2 = p[1];
        maps.moveToCenter( new LTPoint( p1,p2) );
      }  
      else  
      {  
        alert('无结果');  
      }  
  }  
var search=new LTLocalSearch(showPoint);
search.radius=10000;  
search.setCity('<?php echo $_GET['city'];?>');  
search.search('<?php echo $_GET['keyword'];?>'); 
<?php } ?>


</script>