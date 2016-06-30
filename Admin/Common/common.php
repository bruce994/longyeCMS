<?php
function arr2file($filename, $arr=''){

	if(is_array($arr)){

		$con = var_export($arr,true);

	} else{

		$con = $arr;

	}

	$con = "<?php\nreturn $con;\n?>";//\n!defined('IN_MP') && die();\nreturn $con;\n

	write_file($filename, $con);

}

function mkdirss($dirs,$mode=0777) {

	if(!is_dir($dirs)){

		mkdirss(dirname($dirs), $mode);

		return @mkdir($dirs, $mode);

	}

	return true;

}

function write_file($l1, $l2=''){

	$dir = dirname($l1);

	if(!is_dir($dir)){

		mkdirss($dir);

	}

	return @file_put_contents($l1, $l2);

}

function read_file($l1){

	return @file_get_contents($l1);

}

/**
     * 导出数据为excel表格
     *@param $data    一个二维数组,结构如同从数据库查出来的数组
     *@param $title   excel的第一行标题,一个数组,如果为空则没有标题
     *@param $filename 下载的文件名
     *@examlpe
     $stu = M ('User');
     $arr = $stu -> select();
     exportexcel($arr,array('id','账户','密码','昵称'),'文件名!');
 */
 function exportexcel($data=array(),$title=array(),$filename='report'){
     header("Content-type:application/octet-stream");
     header("Accept-Ranges:bytes");
     header("Content-type:application/vnd.ms-excel");
     header("Content-Disposition:attachment;filename=".$filename.".xls");
     header("Pragma: no-cache");
     header("Expires: 0");
     //导出xls 开始
     if (!empty($title)){
         foreach ($title as $k => $v) {
             $title[$k]=iconv("UTF-8", "GB2312",$v);
         }
         $title= implode("\t", $title);
         echo "$title\n";
     }
     if (!empty($data)){
         foreach($data as $key=>$val){
             foreach ($val as $ck => $cv) {
                 $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
             }
             $data[$key]=implode("\t", $data[$key]);

         }
         echo implode("\n",$data);
     }
 }


function DeleteDir($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            DeleteDir(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }

    return false;
}


function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
}

function httpPost($url,$params)
{
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v)
   {
      $postData .= $k . '='.$v.'&';
   }
   rtrim($postData, '&');

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $output=curl_exec($ch);

    curl_close($ch);
    return $output;

}



/**
 *  中文截取2，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */

    function cn_substr($str, $slen, $startdd=0,$soft_lang='utf-8')
    {
        if($soft_lang=='utf-8')
        {
            return cn_substr_utf8($str, $slen, $startdd);
        }
        $restr = '';
        $c = '';
        $str_len = strlen($str);
        if($str_len < $startdd+1)
        {
            return '';
        }
        if($str_len < $startdd + $slen || $slen==0)
        {
            $slen = $str_len - $startdd;
        }
        $enddd = $startdd + $slen - 1;
        for($i=0;$i<$str_len;$i++)
        {
            if($startdd==0)
            {
                $restr .= $c;
            }
            else if($i > $startdd)
            {
                $restr .= $c;
            }

            if(ord($str[$i])>0x80)
            {
                if($str_len>$i+1)
                {
                    $c = $str[$i].$str[$i+1];
                }
                $i++;
            }
            else
            {
                $c = $str[$i];
            }

            if($i >= $enddd)
            {
                if(strlen($restr)+strlen($c)>$slen)
                {
                    break;
                }
                else
                {
                    $restr .= $c;
                    break;
                }
            }
        }
        return $restr;
    }

/**
 *  utf-8中文截取，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
    function cn_substr_utf8($str, $length, $start=0)
    {
        if(strlen($str) < $start+1)
        {
            return '';
        }
        preg_match_all("/./su", $str, $ar);
        $str = '';
        $tstr = '';

        //为了兼容mysql4.1以下版本,与数据库varchar一致,这里使用按字节截取
        for($i=0; isset($ar[0][$i]); $i++)
        {
            if(strlen($tstr) < $start)
            {
                $tstr .= $ar[0][$i];
            }
            else
            {
                if(strlen($str) < $length + strlen($ar[0][$i]) )
                {
                    $str .= $ar[0][$i];
                }
                else
                {
                    break;
                }
            }
        }
        return $str;
    }







//递归 获取分类
function getJG($id=0,$reid=0,$tt="",$select="",$channel=''){
    $jg = M("Arctype");
    if($reid ==0 && $id == 0){
        if($channel){$channel = ' and channeltype='.$channel;}
        $list = $jg->where("topid=0".$channel)->field("id,reid,typename")->select();
        foreach ($list as $value) {
            $tmp = getJG(0,$value['id'],'&nbsp;&nbsp;─',$select,$where);
            $tmp1 = '';
            if($select == $value['id']){
                $tmp1 = 'selected';
            }

            $arr .= "<option value='{$value['id']}' {$tmp1}>{$value['typename']}</option>".$tmp;
        }
    }elseif ($id > 0 && $reid==0) {
        if($channel){$channel = ' and channeltype='.$channel;}
        $vo = $jg->where("id=$id".$channel)->field("id,reid,typename")->find();
        $tmp = getJG(0,$vo['id'],'&nbsp;&nbsp;─',$select,$channel);
        $tmp1 = '';
        if($select == $vo['id']){
            $tmp1 = 'selected';
        }
        $arr .= "<option value='{$vo['id']}' {$tmp1}>{$vo['typename']}</option>".$tmp;
    }
    else{
        if($channel){$channel = ' and channeltype='.$channel;}
        $list = $jg->where("reid=".$reid.$channel)->field("id,reid,typename")->select();
        foreach ($list as $value) {
            $tmp = getJG(0,$value['id'],'&nbsp;&nbsp;'.$tt.'─',$select,$channel);
            $tmp1 = '';
            if($select == $value['id']){
                $tmp1 = 'selected';
            }
            $arr .= "<option value='{$value['id']}' {$tmp1}>{$tt}{$value['typename']}</option>".$tmp;
        }
    }

    return $arr;
}





//递归 获取分类
function getEnum($id=0,$reid=0,$tt="",$select="",$egroup=''){
    $jg = M("Sys_enum");
    if($reid ==0 && $id == 0){
        if($egroup){$egroup = " and egroup='".$egroup."'";}
        $list = $jg->where("topid=0".$egroup)->field("id,reid,ename")->select();
        foreach ($list as $value) {
            $tmp = getEnum(0,$value['id'],'&nbsp;&nbsp;─',$select,$where);
            $tmp1 = '';
            if($select == $value['id']){
                $tmp1 = 'selected';
            }

            $arr .= "<option value='{$value['id']}' {$tmp1}>{$value['ename']}</option>".$tmp;
        }
    }elseif ($id > 0 && $reid==0) {
        if($egroup){$egroup = " and egroup='".$egroup."'";}
        $vo = $jg->where("id=$id".$egroup)->field("id,reid,ename")->find();
        $tmp = getEnum(0,$vo['id'],'&nbsp;&nbsp;─',$select,$egroup);
        $tmp1 = '';
        if($select == $vo['id']){
            $tmp1 = 'selected';
        }
        $arr .= "<option value='{$vo['id']}' {$tmp1}>{$vo['ename']}</option>".$tmp;
    }
    else{
        if($egroup){$egroup = " and egroup='".$egroup."'";}
        $list = $jg->where("reid=".$reid.$egroup)->field("id,reid,ename")->select();
        foreach ($list as $value) {
            $tmp = getEnum(0,$value['id'],'&nbsp;&nbsp;'.$tt.'─',$select,$egroup);
            $tmp1 = '';
            if($select == $value['id']){
                $tmp1 = 'selected';
            }
            $arr .= "<option value='{$value['id']}' {$tmp1}>{$tt}{$value['ename']}</option>".$tmp;
        }
    }

    return $arr;
}








//递归 删除分类
function deleteJG2($id=0){
    $jg = M("Arctype");
    $voList = $jg->where("reid=".$id)->field("id")->select();
    foreach ($voList as $value) {
        deleteJG2($value["id"]);
        $jg->where("id=".$value["id"])->delete();
    }
    $jg->where("id=".$id)->delete();
}



//递归 删除分类
function deleteEN2($id=0){
    $jg = M("Sys_enum");
    $voList = $jg->where("reid=".$id)->field("id")->select();
    foreach ($voList as $value) {
        deleteEN2($value["id"]);
        $jg->where("reid=".$id)->delete();
    }
    $jg->where("id=".$id)->delete();
}





//递归 获取分类
function getJG2($id=0,$reid=0,$tt=""){
    $jg = M("Arctype");
    if($reid ==0 && $id == 0){
        $list = $jg->where("topid=0")->field("id,sortrank,reid,topid,typename,channeltype")->order("sortrank")->select();
        foreach ($list as $value) {
            $tmp = getJG2(0,$value['id'],'─');
            $arr .='<tr><td>'.$value['id'].'</td><td>'.$value['sortrank'].'</td><td><a href="'.U("Type/article",array("typeid"=>$value["id"],"channel"=>$value['channeltype'],"ss"=>2)).'">'.$value['typename'].'</a></td><td><a href="'.U("Type/add",array("reid"=>$value['id'],"topid"=>$value['id'],"ss"=>2)).'"><i class="fa fa-fw fa-plus"></i>增加子类</a> | <a title="编辑" href="'.U("Type/edit",array("id"=>$value['id'],"ss"=>2)).'"><i class="fa fa-fw fa-edit"></i></a> | <a onclick="return window.confirm(\'确定删除？\');" title="删除" href="'.U("Type/delete",array("id"=>$value['id'])).'"><i class="fa fa-fw fa-remove"></i></a></td></tr>'.$tmp;
        }
    }elseif ($id > 0 && $reid==0) {
        $vo = $jg->where("id=$id")->field("id,sortrank,reid,topid,typename,channeltype")->find();
        $tmp = getJG2(0,$vo['id'],'─');
        $arr .='<tr><td>'.$vo['id'].'</td><td>'.$vo['sortrank'].'</td><td><a href="'.U("Type/article",array("typeid"=>$vo["id"],"channel"=>$vo['channeltype'],"ss"=>2)).'">'.$vo['typename'].'</a></td><td><a href="'.U("Type/add",array("reid"=>$vo['id'],"topid"=>$vo['topid'],"ss"=>2)).'"><i class="fa fa-fw fa-plus"></i>增加子类</a> | <a title="编辑" href="'.U("Type/edit",array("id"=>$vo['id'],"ss"=>2)).'"><i class="fa fa-fw fa-edit"></i></a> | <a onclick="return window.confirm(\'确定删除？\');" title="删除" href="'.U("Type/delete",array("id"=>$vo['id'])).'"><i class="fa fa-fw fa-remove"></i></a></td></tr>'.$tmp;
    }
    else{
        $list = $jg->where("reid=".$reid)->field("id,sortrank,reid,topid,typename,channeltype")->order("sortrank")->select();
        foreach ($list as $value) {
            $tmp = getJG2(0,$value['id'],$tt.'─');
            $arr .='<tr><td>'.$value['id'].'</td><td>'.$value['sortrank'].'</td><td><a href="'.U("Type/article",array("typeid"=>$value["id"],"channel"=>$value['channeltype'],"ss"=>2)).'">'.$tt.$value['typename'].'</a></td><td><a href="'.U("Type/add",array("reid"=>$value['id'],"topid"=>$value['topid'],"ss"=>2)).'"><i class="fa fa-fw fa-plus"></i>增加子类</a> | <a title="编辑" href="'.U("Type/edit",array("id"=>$value['id'],"ss"=>2)).'"><i class="fa fa-fw fa-edit"></i></a> | <a onclick="return window.confirm(\'确定删除？\');" title="删除" href="'.U("Type/delete",array("id"=>$value['id'])).'"><i class="fa fa-fw fa-remove"></i></a></td></tr>'.$tmp;
        }
    }
    return $arr;
}






//递归 获取分类
function getEnum2($id=0,$reid=0,$tt=""){
    $jg = M("Sys_enum");
    $list = $jg->where("reid=".$reid)->field("id,disorder,reid,topid,ename,egroup")->order("disorder")->select();
    foreach ($list as $value) {
        $tmp = getEnum2(0,$value['id'],$tt.'─');
        $arr .='<tr><td>'.$value['id'].'</td><td><a href="'.U("System/enum",array("reid"=>$value["id"],"ss"=>6)).'">'.$tt.$value['ename'].'</a></td><td>'.$value['egroup'].'</td><td><a href="'.U("System/addEnum",array("reid"=>$value['id'],"topid"=>$value['topid'],"ss"=>2)).'"><i class="fa fa-fw fa-plus"></i>增加下级</a> | <a title="编辑" href="'.U("Type/edit",array("id"=>$value['id'],"ss"=>2)).'"><i class="fa fa-fw fa-edit"></i></a> | <a onclick="return window.confirm(\'确定删除？\');" title="删除" href="'.U("System/deleteEnum",array("id"=>$value['id'])).'"><i class="fa fa-fw fa-remove"></i></a></td></tr>'.$tmp;
    }
    return $arr;
}


//递归 
function getEnum2_link($id=0){
    $jg = M("Sys_enum");
    $vo = $jg->where("id=".$id)->field("id,disorder,reid,topid,ename,egroup")->find();
    if($vo){
      $tmp = getEnum2_link($vo['reid']);
      $arr .= $tmp.'<li><a href="'.U("System/enum",array("reid"=>$id,"ss"=>6)).'">'.$vo['ename'].'</a></li>';
    }
    return $arr;
}





function fieldValue($value,$typeid,$rel_table='',$rel_field=''){
   switch ($typeid) {
       case '5':
           $value = strtolower($value);
           $isStr  = array(".jpg",".jpeg",".png",".gif");
           foreach ($isStr as $v) {
              if (preg_match("/$v/i", $value)) {
                   $value = '<img src="'.$value.'" width="80" height="80">';
                   break;
              }
           }
           break;
       default:
           # code...
           break;
   }
   if(!empty($rel_table) && !empty($rel_field)){
      $relt = M($rel_table);
      $pk = $relt->getPk ();
      $rel = M($rel_table)->where($pk."='".$value."'")->field($pk.",".$rel_field)->find();
      if($rel){
        $value = '<span class="badge bg-light-blue">'.$value.'</span><span class="badge bg-yellow">'.$rel[$rel_field].'</span>';
      }
   }
   return $value;
}


function inputField($name,$typeid,$default=''){
   switch ($typeid) {
       case '6':
           $tmp = '<option></option>';
           $exp = explode(',', $default);
           foreach ($exp as $value) {
               $check = '';
               if($_REQUEST[$name] == $value){
                  $check = 'selected';
               }
               $tmp.='<option value="'.$value.'" '.$check.'>'.$value.'</option>';
           }
           $value = '<select name="'.$name.'" class="form-control select2">'.$tmp.'</select>';
           break;
       case '7':
           $tmp = '<option></option>';
           $exp = explode(',', $default);
           foreach ($exp as $value) {
               $check = '';
               if($_REQUEST[$name] == $value){
                  $check = 'selected';
               }
               $tmp.='<option value="'.$value.'" '.$check.'>'.$value.'</option>';
           }
           $value = '<select name="'.$name.'" class="form-control select2">'.$tmp.'</select>';
           break;
       case '8':
           $tmp = '<option></option>';
           $exp = explode(',', $default);
           foreach ($exp as $value) {
               $check = '';
               if($_REQUEST[$name] == $value){
                  $check = 'selected';
               }
               $tmp.='<option value="'.$value.'" '.$check.'>'.$value.'</option>';
           }
           $value = '<select name="'.$name.'" class="form-control select2">'.$tmp.'</select>';
           break;
        case '9': //时间类型

$value = <<<EOF
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control" id="{$name}" name="{$name}">
     </div>
    <script>
    $(function () {
    //Date range picker with time picker
    $('#{$name}').daterangepicker({singleDatePicker: true, timePickerIncrement: 1,format: 'YYYY-MM-DD'});
    });
    </script> 
EOF;

           break;
       default:
           $value = '<input type="text" class="form-control" name="'.$name.'" value="'.$_REQUEST[$name].'">';
           break;
   }
   
   return $value;
}





//递归  获取分类id下级所有分类
function getType2($id=0){
    $jg = M("Arctype");
    $voList = $jg->where("reid=".$id)->field("id")->select();
    foreach ($voList as $value) {
       $tmp = getType2($value["id"]);
       $result .=','.$value['id'].$tmp;
     }
    return $result;
}


//递归  获取分类id下级所有分类
function getIdEnumAll($id=0){
    $jg = M("Sys_enum");
    $voList = $jg->where("reid=".$id)->field("id")->select();
    foreach ($voList as $value) {
       $tmp = getIdEnumAll($value["id"]);
       $result .=','.$value['id'].$tmp;
     }
    return $result;
}




//递归  找上级
function getEnum22($id=0,$tt=""){
    if(empty($id)) return;
    $jg = M("Sys_enum");
    $vo = $jg->where("id=".$id." and topid<>0 ")->field("reid,ename")->find();
    if($vo){
      $tmp = getEnum22($vo['reid']);
    }
    return $tmp.$tt.$vo['ename'];
}




function Compress_Html($string){
    return trim(preg_replace(array("/> *([^ ]*) *</","/<!--[^!]*-->/","'/\*[^*]*\*/'","/\r\n/","/\n/","/\t/",'/>[ ]+</',"/\s(?=\s)/"),array(">\\1<",'','','','','','><',''),$string));
}






?>
