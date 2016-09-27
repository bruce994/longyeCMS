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
        <a href="<?php echo U("Admin/index");?>" class="logo">
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
                <i class="fa fa-table"></i><span>数据详情</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php
 $tmp_m = M("Channeltype")->where("reid=0")->field("id,typename")->order("sort asc")->select(); foreach ($tmp_m as $value) { if(strstr($_SESSION["admin"]['channel'], $value['id']) || $_SESSION["admin"]['areaID'] == 0 ){ ?>
                  <li><a href="<?php echo U("Type/article",array("channel"=>$value['id'],"ss"=>3));?>"><i class="fa fa-circle-o"></i><?php echo $value['typename'];?></a></li>
                <?php
 } } ?>
                  <li><a href="<?php echo U("Map/index",array("ss"=>3));?>"><i class="fa fa-map-marker"></i>地图查找</a></li>
                  <li><a href="<?php echo U("Chart/index",array("ss"=>3));?>"><i class="fa fa-bar-chart"></i>统计曲线图</a></li>

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

            <?php if(empty($_SESSION["admin"]['areaID'])) { ?>

            


            <li class="treeview <?php if($_GET['ss'] == 6){echo "active";} ?>">
              <a href="#">
                <i class="fa  fa-cog"></i><span>系统管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo U("System/index",array("ss"=>6));?>"><i class="fa fa-cog"></i>系统设置</a></li>
                <li><a href="<?php echo U("System/deleteCache",array("ss"=>6));?>"><i class="fa fa-refresh"></i>更新缓存</a></li>
                <li><a href="<?php echo U("System/enum",array("ss"=>6));?>"><i class="fa fa-circle-o"></i>数据字典管理</a></li>
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




            <?php } ?>


            <li><a href="<?php echo U("Public/logout");?>"><i class="fa fa-circle-o text-red"></i><span>退出</span></a></li>

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
            <small>列表</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li><a href="#">文档管理</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">


            <?php
 $isCount = false; foreach ($channelField as $tt) { if($tt['isCount']){ $isCount = true; break; } } ?>


            <?php if($isCount){ ?>

            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">数据统计</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">

                    <form action="<?php echo U("Type/article",array("channel"=>$_GET['channel'],"typeid"=>$_GET['typeid'],"ss"=>3));?>" method="get">
                      <div class="row">
                        <div class="col-md-2">
                          开始时间：
                          <input type="text" class="" id="c_startdate" name="c_startdate" value="<?php echo $_GET['c_startdate'];?>">
                        </div>
                        <div class="col-md-2">
                          结束时间：<input type="text" class="" id="c_enddate" name="c_enddate" value="<?php echo $_GET['c_enddate'];?>">
                        </div>


                        <div class="col-md-2">
                          所在地区：<input  type="hidden" id="area"  name="area"  value="<?php echo $_GET['area'];?>"  >
                             <input readonly type="text" id="showAreaText"  name="showAreaText"  class=""  value="<?php echo empty($_GET['area'])?"":getEnum22($_GET['area']);?>"  data-toggle="modal" data-target="#myModalcity" >
                        </div>

 <!--area-->
  <div id="myModalcity" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document" style="width:15%;">
          <div class="modal-content">
              <div class="modal-body" style="text-align:center;">
                <div class="row">
                  <div class="col-md-12" id="ryynetArea">
                   
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                  <button type="button" class="btn btn-primary" onclick="checked_city()">确定</button>
              </div>
          </div>
      </div>
  </div>

<?php
 $fileContent = F('nativeplace'); if(empty($fileContent)){ $enum = M("Sys_enum")->where("egroup='nativeplace'")->order("disorder")->select(); $fileContent = '<script>em_nativeplace=new Array();'; $i = 0 ; foreach ($enum as $enumValue) { $fileContent .= "em_nativeplace[".$i."] = new Array('".$enumValue['id']."','".$enumValue['reid']."','".$enumValue['topid']."','".$enumValue['ename']."','".$enumValue['disorder']."');"; $i++; } $fileContent .= '</script>'; F('nativeplace',$fileContent); } echo $fileContent; ?>

<script type="text/javascript">
var rank = 1;

$( document ).ready(function() {
  showArea(0,"ryynetArea",rank);
});

function showArea(reid,ement,rank1){

  if(reid == 0){
    for(i=0;i < em_nativeplace.length;i++){
      if(em_nativeplace[i][1] == "0" && em_nativeplace[i][2] == "0"){
        reid = em_nativeplace[i][0];
      }
    }
  }


 for(i=rank;i > rank1;i--){
    $("#area_"+i).remove();
 }


  tmp = "<select id='area_"+rank+"'  style='margin:8px 0px;' class='form-control' name='nativeplace' id='nativeplace' onchange=\"showArea(this.value,'ryynetArea',"+rank+")\"><option value='-1'>请选择</option>";
  j = 0;
  for(i=0;i < em_nativeplace.length;i++){
    if(em_nativeplace[i][1] == reid){
      ss = '';
      // if(nat1 !=""){
      //   if(i==nat1){
      //     ss = "selected";  
      //   } 
      // }
      tmp += "<option value='"+em_nativeplace[i][0]+"' "+ss+">"+em_nativeplace[i][3]+"</option>";
      j++;
    }
  }
  tmp += "</select>";

  if(j>0)
  {
      rank++;
      $("#"+ement).append(tmp);
  }  

}


function checked_city(){
  tmp = '';
  $("#ryynetArea select option:selected").each(function() {
    if($( this ).val() > 1) {
        tmp += $( this ).text(); 
        $("#area").val($( this ).val()); //保存最后选择地区
    }
  });    
  $("#showAreaText").val(tmp);
  $('#myModalcity').modal('hide');

  if(tmp == ''){
     $("#area").val(0);
  }
}

</script>  
<!--END area-->



                        <div class="col-md-1">
                           <input type="submit" value="查询" class="btn pull-right btn-sm" />
                        </div>
                      </div>                      
                    </form>

                  <!-- date-range-picker -->
                  <script src="__PUBLIC__/misc/moment.min.js"></script>
                  <script src="__PUBLIC__/plugins/daterangepicker/daterangepicker.js"></script>
                  <!-- daterange picker -->
                  <link rel="stylesheet" href="__PUBLIC__/plugins/daterangepicker/daterangepicker-bs3.css">

                  <link rel="stylesheet" href="__PUBLIC__/misc/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
                    <script>
                      $(function () {
                        //Date range picker with time picker
                        $('#c_startdate').daterangepicker({singleDatePicker: true, timePickerIncrement: 1,timePicker: false, format: 'YYYY-MM-DD'});
                        $('#c_enddate').daterangepicker({singleDatePicker: true, timePickerIncrement: 1,timePicker: false, format: 'YYYY-MM-DD'});
                      });
                    </script>


                     <?php if(is_array($channelField)): $i = 0; $__LIST__ = $channelField;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if(($field["isCount"]) == "1"): ?><div class="row">
                            <div class="col-md-2">
                              <?php echo ($field["title"]); ?>:
                            </div>
                            <div class="col-md-2">
                              <?php
 if($field['typeid'] == 0){ $tmp = M("Addon".$field['chid'])->field("GROUP_CONCAT(".$field['fieldname']." SEPARATOR '') AS ff")->find(); echo $tmp['ff']; }else{ $t_map = array(); if(!empty($_GET['c_startdate']) && !empty($_GET['c_enddate']) ){ $t_map['addtime'] = array(array('egt',strtotime($_GET['c_startdate'])),array('elt',strtotime($_GET['c_enddate']))); } if(!empty($_GET['area'])){ $area_tt = $_GET['area'].",".trim(getIdEnumAll($_GET['area']),","); $t_map['areaID'] = array('in', explode ( ',', $area_tt) ); } echo M("Addon".$field['chid'])->where($t_map)->sum($field['fieldname']); } ?>
                            </div>
                          </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                      </div>
                  </div>
               </div>
                <?php } ?>




          <div class="row">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-header">
                    <form action="<?php echo U("Type/article",array("channel"=>$_GET['channel'],"typeid"=>$_GET['typeid'],"ss"=>3));?>" method="get">
                    <div class="row">
                        <?php if(is_array($channelField)): $i = 0; $__LIST__ = $channelField;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if(($field["issearch"]) == "1"): ?><div class="col-md-2">
                            <?php $issearch = 1;?>
                            <div class="form-group">
                              <label> <?php echo ($field['title']); ?>:  </label>

<?php if($field["isLink"] == 1 ): if(($field["isLinkType"]) == "nativeplace"): ?><input type="hidden" id="<?php echo $field['fieldname'];?>"  name="<?php echo $field['fieldname'];?>"  class="form-control" value="<?php echo $_GET[$field['fieldname']];?>" >
<input type="text" readonly id="showAreaText<?php echo $field['fieldname'];?>" class="form-control"  value="<?php echo getEnum22($_GET[$field['fieldname']]);?>"  data-toggle="modal" data-target="#myModal<?php echo $field['id'];?>" >

 <!--area-->
  <div id="myModal<?php echo $field['id'];?>" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document" style="width:15%;">
          <div class="modal-content">
              <div class="modal-body" style="text-align:center;">
                <div class="row">
                  <div class="col-md-12" id="ryynetArea<?php echo $field['id'];?>">
                   
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                  <button type="button" class="btn btn-primary" onclick="checked_city<?php echo $field['id'];?>()">确定</button>
              </div>
          </div>
      </div>
  </div>


<?php
 $fileContent = F('nativeplace'); if(empty($fileContent)){ $enum = M("Sys_enum")->where("egroup='nativeplace'")->order("disorder")->select(); $fileContent = '<script>em_nativeplace=new Array();'; $i = 0 ; foreach ($enum as $enumValue) { $fileContent .= "em_nativeplace[".$i."] = new Array('".$enumValue['id']."','".$enumValue['reid']."','".$enumValue['topid']."','".$enumValue['ename']."','".$enumValue['disorder']."');"; $i++; } $fileContent .= '</script>'; F('nativeplace',$fileContent); } echo $fileContent; ?>

<script type="text/javascript">
var rank<?php echo $field['id'];?> = 1;

$( document ).ready(function() {
  showArea<?php echo $field['id'];?>(0,"ryynetArea<?php echo $field['id'];?>",rank<?php echo $field['id'];?>);
});

function showArea<?php echo $field['id'];?>(reid,ement,rank1){

  if(reid == 0){
    for(i=0;i < em_nativeplace.length;i++){
      if(em_nativeplace[i][1] == "0" && em_nativeplace[i][2] == "0"){
        reid = em_nativeplace[i][0];
      }
    }
  }


 for(i=rank<?php echo $field['id'];?>;i > rank1;i--){
    $("#area_"+i).remove();
 }


  tmp = "<select id='area_"+rank<?php echo $field['id'];?>+"'  style='margin:8px 0px;' class='form-control' name='nativeplace' id='nativeplace' onchange=\"showArea<?php echo $field['id'];?>(this.value,'ryynetArea<?php echo $field['id'];?>',"+rank<?php echo $field['id'];?>+")\"><option value='-1'>请选择</option>";
  j = 0;
  for(i=0;i < em_nativeplace.length;i++){
    if(em_nativeplace[i][1] == reid){
      ss = '';
      // if(nat1 !=""){
      //   if(i==nat1){
      //     ss = "selected";  
      //   } 
      // }
      tmp += "<option value='"+em_nativeplace[i][0]+"' "+ss+">"+em_nativeplace[i][3]+"</option>";
      j++;
    }
  }
  tmp += "</select>";

  if(j>0)
  {
      rank<?php echo $field['id'];?>++;
      $("#"+ement).append(tmp);
  }  

}


function checked_city<?php echo $field['id'];?>(){
  tmp = '';
  $("#ryynetArea<?php echo $field['id'];?> select option:selected").each(function() {
    if($( this ).val() > 1) {
        tmp += $( this ).text(); 
        $("#<?php echo $field['fieldname'];?>").val($( this ).val());

    }
  });    
  $("#showAreaText<?php echo $field['fieldname'];?>").val(tmp);
  $('#myModal<?php echo $field['id'];?>').modal('hide');
}

</script>  
<!--END area--><?php endif; ?>
<?php else: ?>
                          <?php echo inputField($field['fieldname'],$field['typeid'],$field['fielddefault']); endif; ?>

                            </div>
                             </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</div>


                        <?php if(($issearch) == "1"): ?><div style="float:left;margin:0 8px 0 1px">
                            <input type="submit" value="搜索" class="btn btn-info pull-right btn-sm" />
                          </div><?php endif; ?>


                    </form>
                 
                    <div style="float:left;margin:0 8px;">
                      <a
                      href="<?php echo U("Type/article_add",array("channel"=>$_GET['channel'],"bind_aid"=>$_GET['bind_aid'],"ss"=>3));?>" class="btn btn-block btn-default btn-sm"><i class="fa fa-fw fa-plus"></i>添加</a>
                    </div>
                    <div style="float:left;">
                      <a href="#" id="ids0" class="btn btn-block btn-default btn-sm" onclick="action('article_delete&id=','ids0');"> <i class="fa fa-fw fa-remove"></i>
                      删 除
                      </a>
                    </div>

                   <div style="float:left;margin:0 8px;">
                      <a href="<?php echo U("Type/exportData",$mapTerm) ;?>"  class="btn btn-block btn-default btn-sm" > <i class="fa fa-fw fa-download"></i>
                       导出数据
                     </a>
                   </div>

                </div><!-- /.box-header -->












                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>选择<input type="checkbox" onclick="addids_all()" ></th>
                        <?php if(is_array($channelField)): $i = 0; $__LIST__ = $channelField;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if(($field["displaylist"]) == "0"): ?><th><?php echo ($field['title']); ?></th><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        <th>添加时间</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td>
                              <input name="id" value="<?php echo ($vo['aid']); ?>" type="checkbox" onclick="addids(this)"></td>
                              <?php if(is_array($channelField)): $i = 0; $__LIST__ = $channelField;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if(($field["displaylist"]) == "0"): ?><td><?php echo fieldValue($vo[$field['fieldname']],$field);?></td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                              <td><?php echo (date('Y-m-d H:i',$vo["addtime"])); ?></td>
                              <td>
                                <a title="编辑"
                                    href="<?php echo U("Type/article_edit",array("id"=>$vo['aid'],"channel"=>$_GET['channel'],"ss"=>3));?>"><i class="fa fa-fw fa-edit"></i></a> | <a data-toggle="modal" data-target="#lc_confirm" onclick="lr_confirm('确定删除？','<?php echo U("Type/article_delete",array("id"=>$vo['aid'],"channel"=>$vo['channel']));?>');"><i class="fa fa-fw fa-remove"></i></a> | 

                                     <?php  $subChannelSS = M("Channeltype")->where("reid=".$channel['id'])->field("id,typename")->select(); foreach($subChannelSS as $subChannel){ ?>
                                       <a href="<?php echo U("Type/article",array("channel"=>$subChannel['id'],"bind_aid"=>$vo['aid'],"ss"=>3));?>"  class="btn btn-success btn-xs" ><i class="fa fa-plus"></i><?php echo $subChannel['typename'];?>管理</a>
                                    <?php  } ?>

                                    <a href="javascript:void();" data-toggle="modal" data-target="#myModal<?php echo ($vo["aid"]); ?>"  class="btn btn-primary btn-xs" ><i class="fa fa-file-text"></i>详细查看</a>
                              </td>
                          </tr>

<!--dialog-->
<style>
.modal-dialog {
  width: 95%;
  height: auto;
  padding: 0;
}


.modal-content {
  height: auto;
  border-radius: 0;
}


.ryynet_1 [class*="col-"] {
  padding: 8px;
  border: 1px solid #D8D8D8;
}

.row{margin-bottom:12px;}

</style>

         <div id="myModal<?php echo ($vo["aid"]); ?>" class="modal fade" tabindex="-1" role="dialog">
             <div class="modal-dialog " role="document">
                 <div class="modal-content">
                     <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-tit
le">详细内容</h4></div>
                     <div class="modal-body">
                         <div class="container-fluid">
                             <div class="row ryynet_1">
                                 <?php if(is_array($channelField)): $i = 0; $__LIST__ = $channelField;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><div class="col-md-2" style="background-color:lightcyan;" >
                                             <?php echo ($field["title"]); ?> : <?php echo fieldValue($vo[$field['fieldname']],$field);?>
                                         </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                <div class="col-md-2" style="background-color:lightcyan;" >
                                     添加时间 : <?php echo (date('Y-m-d H:i',$vo["addtime"])); ?>
                                </div>

                             </div>

                             <?php  $subChannelSS = M("Channeltype")->where("reid=".$channel['id'])->field("id,typename")->select(); foreach($subChannelSS as $subChannel){ $subChannelField = M("Channelfield")->where("chid=".$subChannel['id'])->select(); ?>
                               <h4><?php echo $subChannel['typename'];?></h4>
                                <?php
 $subChannelVo = M("Addon".$subChannel['id'])->where("bind_aid=".$vo['aid'])->select(); foreach ($subChannelVo as $vo) { ?>                          
                                   <div class="row ryynet_1">
                                       <?php if(is_array($subChannelField)): $i = 0; $__LIST__ = $subChannelField;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><div class="col-md-2" style="background-color:lightcyan;" >
                                                   <?php echo ($field["title"]); ?> : <?php echo fieldValue($vo[$field['fieldname']],$field);?>
                                               </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                      <div class="col-md-2" style="background-color:lightcyan;" >
                                           添加时间 : <?php echo (date('Y-m-d H:i',$vo["addtime"])); ?>
                                      </div>
                                   </div>
                               <?php } ?>
                            <?php  } ?>


                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                     </div>
                 </div>
             </div>
         </div>
         <!--END dialog--><?php endforeach; endif; else: echo "" ;endif; ?>                    
                    </tbody>
                  </table>
                </div><!-- /.box-body -->

                <!--page-->
                <div class="row" style="margin-left:5px;">
                  <div class="col-sm-5"><div class="dataTables_info"><?php echo ($totalCount); ?> 条记录 <?php echo ($currentPage); ?>/<?php echo ($totalPages); ?> 页</div></div>
                  <div class="col-sm-6">
                    <div class="dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                      <?php echo ($page); ?>
                   </ul>
                  </div>
                  </div>
                </div>
                <!--END  page-->

              </div><!-- /.box -->


            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      
    

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2020 <a href="<?php echo C('site_url');?>"><?php echo C('copyright');?></a>.</strong> All rights reserved.
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


      <script type="text/javascript">
        var ids = "";
        function addids(bb){
            if($(bb).is(':checked')){
              ids+=","+$(bb).val(); 
            }else{
               ids = ids.replace(","+$(bb).val(),""); 
            }
            //console.log(ids);
        }
        var is_all = true;
        function addids_all(){
          if(is_all){
            $("input[name='id']").attr("checked","true"); 
            is_all = false;

            $("input[name='id']:checkbox:checked").each(function(){ 
              ids+=","+$(this).val(); 
            });
          }else{
            $("input[name='id']").removeAttr("checked");
            is_all = true;
            ids = "";
          }
        }
        
        function action(aa,bb){
          if(ids == ""){
            alert("请选择"); return;
          }
          if(ids !==""){
            ids = ids.substring(1);
          }          
          tmp = "index.php?channel=<?php echo $_GET['channel']; ?>&m=Type&a="+aa;          
          $("#"+bb).attr("href",tmp+ids);
        }
      </script>

  <!-- date-range-picker -->
  <script src="__PUBLIC__/misc/moment.min.js"></script>
  <script src="__PUBLIC__/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- daterange picker -->
  <link rel="stylesheet" href="__PUBLIC__/plugins/daterangepicker/daterangepicker-bs3.css">

  </body>
</html>