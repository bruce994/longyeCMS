<?php if (!defined('THINK_PATH')) exit();?>
<script type="text/javascript" language="javascript" src="http://api.51ditu.com/js/maps.js"></script>
<script type="text/javascript">
var map_id = 'mymap';
var p1 = '<?php echo $_GET['longitude'];?>';
var p2 = '<?php echo $_GET['latitude'];?>';
var mark = 'mark';
var show = '1';
var title = '';
var content = '';
var width = 600;
var height = 350;
var view_level = 2;
</script>
</head>
<body style="margin:0;">
<div id="mymap" style="width:100%; height:<?php echo $_GET['height'];?>px; float:left;">loading...</div>
<input type="button" onclick="markmap();" id="markbtn" style="display:none;" />
<input type="hidden" id="point1" value='' />
<input type="hidden" id="point2" value='' />

 <script type="text/javascript">
var maps = new LTMaps( map_id );
if(height < 300) {
  var control = new LTStandMapControl( 2 );
} else {
  var control = new LTStandMapControl( );
}
maps.addControl(control);

if(p1 != '' && p2 != '') {
  p1 = p1 * 100000;
  p2 = p2 * 100000;
  var point = new LTPoint (p1, p2);
  maps.cityNameAndZoom ( point , view_level );

  if(show > 0) {
    var marker = new LTMarker( point );
    maps.addOverLay ( marker );

    var maptxt = new LTMapText( point );
    maptxt.setLabel ( title );
    maps.addOverLay ( maptxt );
  }

} else {
  maps.cityNameAndZoom( "<?php echo getEnum22(C("area"));?>" , view_level );
}

var mkctrl = new LTMarkControl();
mkctrl.setVisible ( false );
maps.addControl ( mkctrl );

LTEvent.addListener( mkctrl , "mouseup" , getPoi );

var np1 = np2 = '';

function markmap() {
  //移除坐标
  maps.clearOverLays();
  mkctrl.btnClick();
}

function getPoi() {
    var poi = mkctrl.getMarkControlPoint();
    console.log(poi);
    document.getElementById('point1').value = poi.getLongitude() / 100000;
    document.getElementById('point2').value = poi.getLatitude() / 100000;
}
</script>