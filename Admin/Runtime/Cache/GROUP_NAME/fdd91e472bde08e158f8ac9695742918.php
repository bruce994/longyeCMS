<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
	<title>用户登录_<?php echo (C("SITENAME")); ?></title>
	<meta http-equiv="x-ua-compatible" content="ie=8" /> 
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body onkeydown="keyDownHandler(event);" onload="init();" bgcolor="white" style="overflow-y:hidden;text-align:center;">
	<div style="text-align:left;position:absolute;left:50%;top:50%;border:0px solid red;width:1024px;height:550px;background:url(/Admin/Public/images/shouye/login3.png);margin-top:-275px;margin-left:-512px;">
		<div style=padding-top:170px;padding-left:180px>
		 <form action="<?php echo U("Public/checkLogin");?>" method="post" name="form1">
			<table style="margin-left:430px;margin-top:60px;">
				<tr height='90'>
					<!-- <td >
						<img style="border:0px;" src="images/name.png" width="30px" height='30px' />
					</td> -->
					<td colspan='2'>
					<input type="text" name="username" id="username"   placeholder="用户名">
					
					</td>
				</tr>
				<tr height='50'>
					<!-- <td  >
						<img style="border:0px;" src="images/pass.png" width="30px" height='30px' />
					</td> -->
					<td colspan='2'>
					<input type="password" name="password" id="password"  placeholder="密码">
					</td>
				</tr>
				<tr height='60'>
					<td></td>
					<td  >
						<div >
							<a href="javascript:void(0);" onclick="form1.submit();"><img style="border:0px; margin-left: -60px" src="/Admin/Public/images/shouye/dl.png" width="80" /></a>
						</div>		
					</td>
					<td>
						<div>
							<a href="javascript:void(0);" onclick="resetHandler();"><img style="border:0px;margin-left: -85px" src="/Admin/Public/images/shouye/qx.png" width="80" /></a>
						</div> 
					</td>
				</tr>
			</table>
		</form>
		</div>

	 
		 
      <div class="subpanel" style="padding-left:240px;padding-top:80px">
         	<table>
         		<tr>
         			<td align='center' width='500' colspan='2'>
         				<font face='黑体' color='black' size='2'>■研发单位：</font><a href="#" target="_blank" style='text-decoration:none;'><font face='黑体' color='31440e' size='2'>阿鲁科尔沁旗农林牧</font></a>
         			</td>
         		
         		</tr>
         		<tr>
         			<td align='right'>
            			<font face='黑体' color='black' size='2'>■客服热线:0631-xxxx</font>
            		</td>
            		<td align='left'>
            			<a href="tencent://message/?uin=1141981" style='text-decoration:none;'><font face='黑体' color='black' size='2'>■在线客服:1141981</a><img src="http://wpa.qq.com/pa?p=1:1141981:4" border="0"></font>         
         			</td>
         		</tr>	
         		</table>
          </div>
 	 	
		
		
	</div>

    <script>
function resetHandler(){
    document.getElementById("username").value = "";
    document.getElementById("password").value = "";
}

</script>



</body>
</html>