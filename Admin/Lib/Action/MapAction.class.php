<?php
  class MapAction extends CommonAction{



     public function index(){
				Cookie::set ( '_currentUrl_', __SELF__ );
				$this->display ();
	 }



	 public function json(){

	 	if($_GET['rank']==2){


	 		
			echo '[{"nameId":"16113","name":"沙日温都林场","X_flag":"119.6498971678","Y_flag":"44.2981911901","qxqName":"阿鲁科尔沁旗"},{"nameId":"16114","name":"台河林场","X_flag":"120.7339567923","Y_flag":"43.5437618424","qxqName":"阿鲁科尔沁旗"},{"nameId":"16115","name":"白城子林场","X_flag":"120.2755664197","Y_flag":"43.73673989","qxqName":"阿鲁科尔沁旗"},{"nameId":"16116","name":"罕山林场","X_flag":"119.5450933604","Y_flag":"44.9924410923","qxqName":"阿鲁科尔沁旗"},{"nameId":"7680","name":"巴拉奇如德苏木","X_flag":"120.0740875348","Y_flag":"43.624942353","qxqName":"阿鲁科尔沁旗"},{"nameId":"7691","name":"巴彦花镇","X_flag":"119.9047301351","Y_flag":"44.1470984588","qxqName":"阿鲁科尔沁旗"},{"nameId":"7692","name":"巴彦温都尔苏木","X_flag":"119.7054183413","Y_flag":"44.7299075909","qxqName":"阿鲁科尔沁旗"},{"nameId":"7693","name":"坤都林场","X_flag":"119.9640863956","Y_flag":"44.2397179331","qxqName":"阿鲁科尔沁旗"},{"nameId":"7694","name":"罕苏木苏木","X_flag":"119.9216861889","Y_flag":"44.433912528","qxqName":"阿鲁科尔沁旗"},{"nameId":"7695","name":"坤都镇","X_flag":"120.0051740000","Y_flag":"44.2673610000","qxqName":"阿鲁科尔沁旗"},{"nameId":"7696","name":"赛罕塔拉苏木","X_flag":"120.4247665409","Y_flag":"44.272560111","qxqName":"阿鲁科尔沁旗"},{"nameId":"7697","name":"绍根镇","X_flag":"120.8251227903","Y_flag":"43.6550364363","qxqName":"阿鲁科尔沁旗"},{"nameId":"7698","name":"双胜镇","X_flag":"119.8417254113","Y_flag":"43.6797946002","qxqName":"阿鲁科尔沁旗"},{"nameId":"7699","name":"天山口镇","X_flag":"120.1683780000","Y_flag":"43.7596040000","qxqName":"阿鲁科尔沁旗"},{"nameId":"7700","name":"天山镇","X_flag":"120.0741608689","Y_flag":"43.8799971383","qxqName":"阿鲁科尔沁旗"},{"nameId":"7701","name":"乌兰哈达乡","X_flag":"119.8703200000","Y_flag":"44.0132000000","qxqName":"阿鲁科尔沁旗"},{"nameId":"7702","name":"先锋乡","X_flag":"119.821917","Y_flag":"43.897627","qxqName":"阿鲁科尔沁旗"},{"nameId":"7703","name":"新民乡","X_flag":"120.0787630000","Y_flag":"44.0297680000","qxqName":"阿鲁科尔沁旗"},{"nameId":"7704","name":"扎嘎斯台镇","X_flag":"120.5274549704","Y_flag":"43.9328649514","qxqName":"阿鲁科尔沁旗"}]';
			exit;

	 	}elseif ($_GET['rank']==3) {
	 		echo '[{"nameId":"7806","name":"巴彦敖包村","X_flag":"119.915319","Y_flag":"44.127685","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7822","name":"巴彦花村","X_flag":"119.787403","Y_flag":"44.120652","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7821","name":"白嘎力村","X_flag":"120.024939","Y_flag":"44.118626","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7814","name":"宝力格村","X_flag":"119.6735065234","Y_flag":"44.2200684256","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7810","name":"宝山村","X_flag":"119.679166","Y_flag":"44.080153","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7809","name":"代白勿苏村","X_flag":"119.688284","Y_flag":"44.104751","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7808","name":"道伦百姓村","X_flag":"119.948792","Y_flag":"44.16583","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7807","name":"东沟村","X_flag":"120.1259420000","Y_flag":"44.1248380000","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7823","name":"东古井子村","X_flag":"119.852468","Y_flag":"44.12091","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7811","name":"东沙布台村","X_flag":"119.7735160946","Y_flag":"44.1590881799","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7820","name":"哈拉哈达村","X_flag":"119.9965633996","Y_flag":"44.1288067238","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7816","name":"靠山村","X_flag":"119.761196","Y_flag":"44.133748","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7826","name":"莫如格其格村","X_flag":"119.727018","Y_flag":"44.091802","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"10498","name":"沙拉哈达村","X_flag":"119.9620550000","Y_flag":"44.1248640000","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7817","name":"胜利村","X_flag":"119.896449","Y_flag":"44.157177","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7825","name":"王爷伙房村","X_flag":"119.903681","Y_flag":"44.181056","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7824","name":"乌兰苏木村","X_flag":"119.870615","Y_flag":"44.11948","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7819","name":"五一村","X_flag":"119.902998","Y_flag":"44.144545","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7812","name":"西古井子村","X_flag":"119.839908","Y_flag":"44.126883","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7813","name":"西沙布台村","X_flag":"119.7480773487","Y_flag":"44.1598497755","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7818","name":"姚家段村","X_flag":"119.653899","Y_flag":"44.239236","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"},{"nameId":"7815","name":"于家粉房村","X_flag":"119.965803","Y_flag":"44.14974","qxqId":196,"qxqName":"阿鲁科尔沁旗","xzId":7691,"xzName":"巴彦花镇"}]';
	 	}else{
		 	echo '[{"qxqId":"196","X_flag":"120.072171","Y_flag":"43.878091","qxqName":"阿鲁科尔沁旗"}]';
	 	}

	 }




  }
?>
