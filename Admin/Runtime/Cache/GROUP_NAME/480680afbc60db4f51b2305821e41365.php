<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo (C("SITENAME")); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="__PUBLIC__/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="__PUBLIC__/misc/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="__PUBLIC__/misc/ionicons.min.css">


    <!-- Select2 -->
    <link rel="stylesheet" href="__PUBLIC__/plugins/select2/select2.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="__PUBLIC__/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="__PUBLIC__/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="__PUBLIC__/misc/html5shiv.min.js"></script>
        <script src="__PUBLIC__/misc/respond.min.js"></script>
    <![endif]-->

    <style>
      .color-palette {
        height: 35px;
        line-height: 35px;
        text-align: center;
      }
      .color-palette-set {
        margin-bottom: 15px;
      }
      .color-palette span {
        display: none;
        font-size: 12px;
      }
      .color-palette:hover span {
        display: block;
      }
      .color-palette-box h4 {
        position: absolute;
        top: 100%;
        left: 25px;
        margin-top: -40px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        display: block;
        z-index: 7;
      }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

            <!-- jQuery 2.1.4 -->
      <script src="__PUBLIC__/plugins/jQuery/jQuery-2.1.4.min.js"></script>

      <header class="main-header">
        <!-- Logo -->
        <a href="__PUBLIC__/index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Lan</b>ren</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo C("SITENAME");?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
          
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo empty($_SESSION["admin"]['picurl'])?"/Public/avator.png":$_SESSION["admin"]['picurl'];?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION["admin"]['userid'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo empty($_SESSION["admin"]['picurl'])?"/Public/avator.png":$_SESSION["admin"]['picurl'];?>" class="img-circle" alt="User Image">
                    <p>
                      最后登陆时间：<?php echo date("m-d H:s",$_SESSION["admin"]['logintime']);?>
                      <small>IP:<?php echo $_SESSION["admin"]['loginip'];?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo U("Admin/edit",array("id"=>$_SESSION["admin"]['id']));?>" class="btn btn-default btn-flat">修改</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo U("Public/logout");?>" class="btn btn-default btn-flat">退出</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->

			  <!--
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
			  -->


            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo empty($_SESSION["admin"]['picurl'])?"/Public/avator.png":$_SESSION["admin"]['picurl'];?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION["admin"]['userid'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i>在线</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">功能管理</li>
 
            <li class="treeview <?php if($_GET['ss'] == 1){echo "active";} ?>" >
              <a href="#">
                <i class="fa  fa-user"></i><span>管理员管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo U("Admin/index",array("ss"=>1));?>"><i class="fa fa-user-plus"></i>管理员</a></li>                
              </ul>
            </li>
            
            <!--
            <li class="treeview <?php if($_GET['ss'] == 2){echo "active";} ?>" >
              <a href="#">
                <i class="fa fa-folder"></i><span>栏目管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo U("Type/index",array("ss"=>2));?>"><i class="fa fa-circle-o"></i>栏目管理</a></li>
              </ul>
            </li>
            -->

            <li class="treeview <?php if($_GET['ss'] == 3){echo "active";} ?>" >
              <a href="#">
                <i class="fa fa-table"></i><span>内容管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php
 $tmp_m = M("Channeltype")->where("reid=0")->field("id,typename")->select(); foreach ($tmp_m as $value) { ?>
                  <li><a href="<?php echo U("Type/article",array("channel"=>$value['id'],"ss"=>3));?>"><i class="fa fa-circle-o"></i><?php echo $value['typename'];?></a></li>
                <?php
 } ?>
                  <li><a href="<?php echo U("Map/index",array("ss"=>3));?>"><i class="fa fa-map-marker"></i>地图查找</a></li>

              </ul>
            </li>


<!-- 
            <li class="treeview <?php if($_GET['ss'] == 4){echo "active";} ?>" >
              <a href="#">
                <i class="fa fa-search"></i><span>查询分析</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="<?php echo U("Type/search",array("ss"=>4));?>"><i class="fa fa-search-plus"></i>单位查询表</a></li>
                  <li><a href="<?php echo U("Type/search_goods",array("ss"=>4));?>"><i class="fa fa-search-plus"></i>用品领用查询</a></li>
              </ul>
            </li>  

             -->          

            <?php if(empty($_SESSION["admin"]['typeid'])) { ?>

            <li class="treeview <?php if($_GET['ss'] == 5){echo "active";} ?>">
              <a href="#">
                <i class="fa fa-recycle"></i><span>回收站</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php
 foreach ($tmp_m as $value) { ?>
                  <li><a href="<?php echo U("Type/article_recycle",array("channel"=>$value['id'],"ss"=>5));?>"><i class="fa fa-circle-o"></i><?php echo $value['typename'];?>(回收站)</a></li>
                <?php
 } ?>
              </ul>
            </li>


            <li class="treeview <?php if($_GET['ss'] == 6){echo "active";} ?>">
              <a href="#">
                <i class="fa  fa-cog"></i><span>系统管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo U("System/index",array("ss"=>6));?>"><i class="fa fa-cog"></i>系统设置</a></li>
                <li><a href="<?php echo U("System/deleteCache",array("ss"=>6));?>"><i class="fa fa-refresh"></i>更新缓存</a></li>
              </ul>
            </li>

            <li class="treeview <?php if($_GET['ss'] == 7){echo "active";} ?>">
              <a href="#">
                <i class="fa fa-cubes"></i><span>频道模型</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo U("Channel/index",array("ss"=>7));?>"><i class="fa  fa-cube"></i>内容模型管理</a></li>
                <li><a href="<?php echo U("Channel/fmanage",array("ss"=>7));?>"><i class="fa  fa-cube"></i>字段管理</a></li>
              </ul>
            </li>
            <?php } ?>


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo ($channel["typename"]); ?>
            <small>文章</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="#">文档</a></li>
            <li class="active">添加</li>
          </ol>
        </section>

 <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">添加</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="form1" action="<?php echo U("Type/article_insert");?>" class="pageForm required-validate">
                  <input type="hidden" name="channel" value="<?php echo $_GET['channel'];?>">
                  <input type="hidden" name="bind_aid" value="<?php echo $_GET['bind_aid'];?>">  <!--关联字段-->
                  <div class="box-body">

                  <?php
 $channelfield = M("Channelfield")->where("chid=".$_GET['channel']." and isAuto=0")->order("sort")->select(); foreach ($channelfield as $v) { ?>
                    <div class="form-group">
                      <label><?php echo $v['title'];?></label>

                      <?php  if($v['typeid'] == "0" || $v['typeid'] == "1" || $v['typeid'] == "3" || $v['typeid'] == "4" ){ ?>
                        
                        
                        <!--联动-->
                        <?php if($v["isLink"] == 1 ): if(($v["isLinkType"]) == "nativeplace"): ?><input type="text" id="<?php echo $v['fieldname'];?>"  name="<?php echo $v['fieldname'];?>"  class="form-control <?php if($v['check_empty']){echo "required";} ?>"  value="<?php echo $v['fielddefault'];?>"  data-toggle="modal" data-target="#myModal<?php echo $v['id'];?>" >

                              <!--dialog-->
                              <div id="myModal<?php echo $v['id'];?>" class="modal fade" tabindex="-1" role="dialog">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-body" style="text-align:center;">
                                            <div class="row">
                                              <div class="col-md-4">
                                                <select name="nativeplace" id="province" class="form-control" onchange="first(this.value)">
                                                    <option value="">选择省份</option>
                                                  </select>
                                              </div>
                                              <div class="col-md-4" id="f1"></div>
                                              <div class="col-md-4" id="f2"></div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                              <button type="button" class="btn btn-primary" onclick="checked_<?php echo $v['fieldname'];?>()">确定</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>

<?php
 $fileContent = F($v['isLinkType']); if(empty($fileContent)){ $enum = M("Sys_enum")->where("egroup='".$v['isLinkType']."'")->order("disorder")->select(); $fileContent = '<script>em_'.$v['isLinkType'].'=new Array();'; foreach ($enum as $enumValue) { $fileContent .= "em_".$v['isLinkType']."[".$enumValue['evalue']."]='".$enumValue['ename']."';"; } $fileContent .= '</script>'; F($v['isLinkType'],$fileContent); } echo $fileContent; ?>

<script type="text/javascript">
$( document ).ready(function() {

nat1 = nat2 = nat3 = "";

  for(i=1000;i < em_nativeplace.length;i=i+500){
    if(em_nativeplace[i] != undefined){
      ss = '';
      if(nat1 !=""){
        if(i==nat1){
          ss = "selected";  
        } 
      }
      $("#province").append("<option value='"+i+"' "+ss+">"+em_nativeplace[i]+"</option>");
    }
  }

  if(nat2 !=""){
      first(nat1);    
  }
  if(nat3 !=""){
    second(nat2);   
  }

});

function first(v){
  $("#f2").html('');
  if(v=="")
  {
    $("#f1").html('');
    return;
  }
  tmp = "<select class='form-control' name='nativeplace' id='nativeplace' onchange=\"second(this.value)\"><option value='"+v+"'>选择市</option>";
  tmp2 = false;
  v=parseInt(v)+1;
  for(i=v;i < v+30;i++){
    if(em_nativeplace[i] != undefined){
      tmp2 = true;
      ss = '';
      if(nat2 == i){
        ss = "selected";    
      }
      tmp += "<option value='"+i+"' "+ss+">"+em_nativeplace[i]+"</option>";
    }
  }
  tmp += "</select>";
  if(tmp2){
    $("#f1").html(tmp);  
  }
}

function second(v){
  //return;
  tmp = "<select class='form-control' name='nativeplace' id='nativeplace'><option value='"+v+"'>选择区</option>";
  tmp2 = false;
  for(i=1;i < 30;i=i+1){
          a = v+"."+i;
    //console.log(a);
    if(em_nativeplace[a] != undefined){
      tmp2 = true;
      ss = '';
      if(nat3 == a){
        ss = "selected";    
      }
      tmp += "<option value='"+a+"' "+ss+">"+em_nativeplace[a]+"</option>";
    }
  }
  tmp += "</select>";
  if(tmp2){
    $("#f2").html(tmp);
  }
}

function checked_<?php echo $v['fieldname'];?>(){
  tmp = '';
  $("#myModal<?php echo $v['id'];?> select option:selected").each(function() {
      tmp += $( this ).text();
  });    
  $("#<?php echo $v['fieldname'];?>").val(tmp);

  $('#myModal<?php echo $v['id'];?>').modal('hide');

}

</script><?php endif; ?>
<!--END -->

                        <?php else: ?>
                          <input type="text" name="<?php echo $v['fieldname'];?>"  class="form-control <?php if($v['check_empty']){echo "required";} ?>"  value="<?php echo $v['fielddefault'];?>"><?php endif; ?>



                      <?php }elseif ($v['typeid'] == "2" ) { ?>
                          <textarea id="<?php echo $v['fieldname'];?>" name="<?php echo $v['fieldname'];?>"></textarea>
                            <script src="__PUBLIC__/misc/ckeditor/ckeditor.js"></script>
                            <link rel="stylesheet" href="__PUBLIC__/misc/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
                              <script>
                                $(function () {
                                  // Replace the <textarea id="editor1"> with a CKEditor
                                  // instance, using default configuration.
                                  CKEDITOR.replace( '<?php echo $v['fieldname'];?>', {
                                      filebrowserUploadUrl: '/Admin/index.php?m=Upyun&a=upload&from=Wap'
                                  });
                                });
                              </script>  
                      <?php }elseif ($v['typeid'] == "5" ) { ?>
                              <div class="input-group">
                                <input type="text" id="<?php echo $v['fieldname'];?>" name="<?php echo $v['fieldname'];?>" class="form-control">
                                <span class="input-group-addon"><a href="javascript:void();" onclick="upyunWapPicUpload('<?php echo $v['fieldname'];?>')"><i class="fa fa-fw fa-upload"></i>点击上传</a></span>
                              </div>
                      <?php }elseif ($v['typeid'] == "6" ) { $map['recycle'] = array("eq",0); $typeid = $_SESSION["admin"]['typeid']; if($typeid){ $tmp = $typeid.getType2($typeid); if($v['rel_table']=="arctype"){ $map['id'] = array ('in', explode ( ',', $tmp ) ); }else{ $map['typeid'] = array ('in', explode ( ',', $tmp ) ); } } if($v['fieldname'] == "operatorID"){ $map = array(); $map['userid'] = array('eq',$_SESSION["admin"]['userid']); } $tmp1 = ''; if($v['rel_table'] && $v['rel_field']){ $relt = M($v['rel_table']); $pk = $relt->getPk (); $rel = M($v['rel_table'])->where($map)->field($pk.",".$v['rel_field'])->select(); foreach ($rel as $v1) { $tmp1.= '<option value="'.$v1[$pk].'">'.$v1[$v['rel_field']].'</option>'; } }else{ $tmps = explode(',', $v['fielddefault']); foreach ($tmps as $tm) { $tmp1.= '<option value="'.$tm.'">'.$tm.'</option>'; } } ?>
                              <select name="<?php echo $v['fieldname'];?>" class="form-control select2">
                                  <?php echo $tmp1;?>
                              </select>
                      <?php }elseif ($v['typeid'] == "7" ) { echo '<br/>'; $tmp1 = ''; $tmps = explode(',', $v['fielddefault']); foreach ($tmps as $tm) { ?>
                         <label>
                         <input class="minimal-red" type="radio" value = "<?php echo $tm;?>" name="<?php echo $v['fieldname'];?>"> <?php echo $tm;?>
                          </label>
                       <?php } ?>
                      <?php }elseif ($v['typeid'] == "8" ) { echo '<br/>'; $tmp1 = ''; $tmps = explode(',', $v['fielddefault']); foreach ($tmps as $tm) { ?>
                         <label>
                         <input class="minimal-red" type="checkbox" value = "<?php echo $tm;?>" name="<?php echo $v['fieldname'];?>[]"> <?php echo $tm;?>
                          </label>
                       <?php } ?>
                       <?php }elseif ($v['typeid'] == "9" ) { ?>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="<?php echo $v['fieldname'];?>" name="<?php echo $v['fieldname'];?>" value="<?php echo date("Y-m-d H:i:s"); ?>">
                              </div><!-- /.input group -->
                                <script>
                                  $(function () {
                                    //Date range picker with time picker
                                    $('#<?php echo $v['fieldname'];?>').daterangepicker({singleDatePicker: true, timePickerIncrement: 1,format: 'YYYY-MM-DD'});
                                  });
                                </script>                              
                      <?php } ?>

                    </div>                    
                  <?php  } ?> 


<?php if(($channel["isCoordinate"]) == "1"): ?><!--map-->
                 <div class="form-group">
                      <label>地图坐标</label>
                        <input type="text" id="mapText" name="mapText" class="form-control " value="" data-toggle="modal" data-target="#myModalmap">
                          <!--dialog-->
                          <div id="myModalmap" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content" id="modal_map">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title">地图标注</h4>
                                    </div>
                                      <div class="modal-body" style="text-align:center;">
                                        <div class="row">
                                          <div class="col-md-12">
                                              <iframe id="ifupmap_map" src="<?php echo U("Public/map",array("height"=>"350"));?>" frameborder="0" scrolling="no" height="350"></iframe>  
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-primary" id="mapbtn1">标注坐标</button>
                                          <button type="button" class="btn btn-success" id="mapbtn2">确定</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div> 


<script type="text/javascript">
$( document ).ready(function() {

    $('#myModalmap').on('shown.bs.modal', function (e) {
        iframe_height = $("#modal_map").innerWidth();
        iframe_height = iframe_height * 0.9;
        $("#ifupmap_map").css({width : iframe_height+"px"});
    });


    $('#mapbtn1').click(
        function() {
            $(document.getElementById('ifupmap_map').contentWindow.document.body).find('#markbtn').click();
        }
    );
    $('#mapbtn2').click(
        function() {
            point1 = $(document.getElementById('ifupmap_map').contentWindow.document.body).find('#point1').val();
            point2 = $(document.getElementById('ifupmap_map').contentWindow.document.body).find('#point2').val();
            if(point1 == '' || point2 == '') {
                alert('您尚未完成标注。');
                return;
            }
            $('#mapText').val(point1 + ',' + point2).focus();
            $('#myModalmap').modal('hide');
        }
    );
});    

</script>
                  <!--END map--><?php endif; ?>


                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button  id="sub" class="btn btn-primary">提交</button>
                  </div>
                </form>
              </div><!-- /.box -->
         
            </div><!--/.col (left) -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->



      </div><!-- /.content-wrapper -->

      
    

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2020 <a href="http://www.lanrenmb.com"><?php echo C('copyright');?></a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            
         
          </div><!-- /.tab-pane -->
    
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>





    <!-- Bootstrap 3.3.5 -->
    <script src="__PUBLIC__/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="__PUBLIC__/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="__PUBLIC__/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="__PUBLIC__/dist/js/demo.js"></script>


<!--dialog-->
<div id="lr_confirm" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body" id="lr_config_msg">
         Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="lr_del">确定</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function lr_confirm(msg,url){
 $("#lr_config_msg").html(msg);
 $('#lr_confirm').modal({backdrop: 'static', keyboard: false })
        .one('click', '#lr_del', function (e) {
            location.href = url;
        });
}
</script>
<!--/.dialog-->

<script src="/Public/js/common.js" type="text/javascript"></script>


<script src="__PUBLIC__/misc/jquery.validate.js" type="text/javascript"></script>
<script src="__PUBLIC__/misc/regional.zh.js" type="text/javascript"></script>
<style type="text/css">
span.error {   overflow:hidden; width:165px; height:21px; padding:0 3px; line-height:21px; background:#F00; color:#FFF; top:5px; left:318px;}
label.alt {display:block; overflow:hidden; position:absolute;line-height:20px}
.textInput, input.focus, input.required, input.error, input.readonly, input.disabled,
</style>

<script type="text/javascript">
$.validator.setDefaults({errorElement:"span"});
$(document).ready(function()
{
  $('#sub').click (function () {
    var $form=$("#form1");
    if(!$form.valid()){
    return false;}
    $("form").submit();
  });
}); 
</script>











     
    </div><!-- ./wrapper -->

  <!-- date-range-picker -->
  <script src="__PUBLIC__/misc/moment.min.js"></script>
  <script src="__PUBLIC__/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- daterange picker -->
  <link rel="stylesheet" href="__PUBLIC__/plugins/daterangepicker/daterangepicker-bs3.css">
    <script>
      $(function () {
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({singleDatePicker: true, timePickerIncrement: 1,timePicker: true,timePicker12Hour:false, format: 'YYYY-MM-DD hh:mm'});
      });
    </script>


<script src="__PUBLIC__/static/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="__PUBLIC__/static/artDialog/plugins/iframeTools.js"></script>
<script src="__PUBLIC__/static/upyun.js?2013"></script>     


<!-- Select2 -->
<script src="__PUBLIC__/plugins/select2/select2.full.min.js"></script>
<script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      }
      );
</script>      





  </body>
</html>