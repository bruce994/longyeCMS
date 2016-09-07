<?php
  class TypeAction extends CommonAction{

	function _filter(&$map){

		  if(intval($_SESSION["admin"]['usertype']) != 10 ){
			  //$map['userid'] = array('eq',$_SESSION["admin"]['userid']);
		  	  $areas = $_SESSION["admin"]['areaID'].",".trim(getIdEnumAll($_SESSION["admin"]['areaID']),",");
  	  		  $map['areaID'] = array ('in', explode ( ',', $areas ) );
		  }

	}	

     public function index(){
				Cookie::set ( '_currentUrl_', __SELF__ );
				$this->display ();
	 }


	public function edit() {
		$model = M ( "Arctype" );
		$id = $_REQUEST ["id"];
		$vo = $model->where("id = ".$id)->find();
		$this->assign ( 'vo', $vo );
		$this->display ();
	}

	public function update(){
			$P = D("Arctype");
			if(!$P->create()) {
				$this->error($P->getError());
			}else{
			    $this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
				// 写入帐号数据
				if($result	 =	 $P->save()) {
					$this->success('修改成功！');
				}else{
					$this->error('修改失败！');
				}
		    }
	}


public function insert(){
		$model = M ("Arctype");
	    $this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
		if(!$model->create()) {
			$this->error($model->getError());
		}else{
			if($result	 =	 $model->add()) {
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！');
			}
	    }
}

public function delete() {
	$model = M ("Arctype");
	$id = $_REQUEST ["id"];
	if (isset ( $id )) {
		deleteJG2($id);
		$this->success ('删除成功！' );
	}
}


// 框架首页
	public function article() {

		        //列表过滤器，生成查询Map对象

				if (method_exists ( $this, '_filter' )) {
					$this->_filter ( $map );
				}
			    if(!empty($_GET['aid'])){
					 $map['aid'] = array('eq',$_GET['aid']);
				}
				if(!empty($_GET['q'])){
					 $map['title'] = array('like',"%".$_GET['q']."%");
				}


				if(!empty($_GET['bind_aid'])){
					 $map['bind_aid'] = array('eq',$_GET['bind_aid']);
				}






				// if(!empty($_GET['typeid'])){
				// 	 $map['typeid'] = array('eq',$_GET['typeid']);
    //             }else{
    //                 $typeid = $_SESSION["admin"]['typeid'];
    //                 if($typeid){
    //                     $tmp = $typeid.getType2($typeid);
    //                     $map['typeid'] = array ('in', explode ( ',', $tmp ) );

    //                 }
    //             }




                if(!empty($_GET['channel'])){
					 $map['channel'] = array('eq',$_GET['channel']);
					 $channelField = M("Channelfield")->where("chid=".$_GET['channel'])->order("sort")->select();
					 $this->assign ( 'channelField', $channelField );

					  //search
					 foreach($channelField as $v){
						if($v['issearch'] == 1){
							if(!empty($_GET[$v['fieldname']])){
								if($v['isLink'] && $v['isLinkType'] == "nativeplace"){
							  	  $areas = $_GET[$v['fieldname']].",".trim(getIdEnumAll($_GET[$v['fieldname']]),",");
			  	    	  		  $map[$v['fieldname']] = array ('in', explode ( ',', $areas ) );
								}else{
									$map[$v['fieldname']] = array('eq',$_GET[$v['fieldname']]);									
								}

							}
						}
					 }
					 //./search


					 $map['recycle'] = array('eq',0);
					 $model = M ("Addon".$_GET['channel'] );
				}else{
					$model = M ("Archives" );
				}



				//排序字段 默认为主键名
				if (!empty ( $_REQUEST ['_order'] )) {
					$order = $_REQUEST ['_order'];
				} else {
					$order = ! empty ( $sortBy ) ? $sortBy : $model->getPk ();
				}
				//排序方式默认按照倒序排列
				//接受 sost参数 0 表示倒序 非0都 表示正序
				if (isset ( $_REQUEST ['_sort'] )) {
		//			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
					$sort = $_REQUEST ['_sort'] == 'asc' ? 'asc' : 'desc'; //zhanghuihua@msn.com
				} else {
					$sort = $asc ? 'asc' : 'desc';
				}
				//取得满足条件的记录数
				$_REQUEST ['listRows'] = 20;
				$count = $model->where ( $map )->count ();
				if ($count > 0) {
					import ( "@.ORG.Util.Page" );
					//创建分页对象
					if (! empty ( $_REQUEST ['listRows'] )) {
						$listRows = $_REQUEST ['listRows'];
					} else {
						$listRows = '';
					}
					$p = new Page ( $count, $listRows );
					//分页查询数据
					$voList = $model->where($map)->order( "`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ( );
					//echo $model->getlastsql();
					//分页跳转的时候保证查询条件
					foreach ( $map as $key => $val ) {
						if (! is_array ( $val )) {
							$p->parameter .= "$key=" . urlencode ( $val ) . "&";
						}

						if(is_array($val)){
							$val = $val[1];
						}
						$mapTerm[$key] = $val;

					}
					//分页显示
					$page = $p->show ();
					//列表排序显示
					$sortImg = $sort; //排序图标
					$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
					$sort = $sort == 'desc' ? 1 : 0; //排序方式

					//模板赋值显示
					$this->assign ( 'list', $voList );
					$this->assign ( 'sort', $sort );
					$this->assign ( 'order', $order );
					$this->assign ( 'sortImg', $sortImg );
					$this->assign ( 'sortType', $sortAlt );
					$this->assign ( "page", $page );
				}



				//zhanghuihua@msn.com
				$this->assign ( 't',  $this->_param('t') );
				$this->assign ( 'totalCount', $count );
				$this->assign ( 'numPerPage', $p->listRows );
				$this->assign ( 'currentPage', !empty($_REQUEST[C('VAR_PAGE')])?$_REQUEST[C('VAR_PAGE')]:1);
				$this->assign ( 'mapTerm', $mapTerm);

				$this->assign ( 'map', $map);

				Cookie::set ( '_currentUrl_', __SELF__ );

				$ch = M ( "Channeltype" )->where("id = ".$_REQUEST ["channel"])->find();
				$this->assign ( 'channel', $ch );
			    if($ch['issystem'] == "0"){
					$this->display ('article_auto');
					exit;
			    }
				$this->display ();

	}



// 框架首页
	public function article_recycle() {



		        //列表过滤器，生成查询Map对象
				if(!empty($_GET['q'])){
					 $map['title'] = array('like',"%".$_GET['q']."%");
				}
				if(!empty($_GET['typeid'])){
					 $map['typeid'] = array('eq',$_GET['typeid']);
				}
				if(!empty($_GET['channel'])){
					 $map['channel'] = array('eq',$_GET['channel']);
					 $channelField = M("Channelfield")->where("chid=".$_GET['channel']." and displaylist=0")->order("sort")->select();
					 $this->assign ( 'channelField', $channelField );

					 $map['recycle'] = array('eq',1);
					 $model = M ("Addon".$_GET['channel'] );
				}else{
					$model = M ("Archives" );
				}




				//排序字段 默认为主键名
				if (!empty ( $_REQUEST ['_order'] )) {
					$order = $_REQUEST ['_order'];
				} else {
					$order = ! empty ( $sortBy ) ? $sortBy : $model->getPk ();
				}
				//排序方式默认按照倒序排列
				//接受 sost参数 0 表示倒序 非0都 表示正序
				if (isset ( $_REQUEST ['_sort'] )) {
		//			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
					$sort = $_REQUEST ['_sort'] == 'asc' ? 'asc' : 'desc'; //zhanghuihua@msn.com
				} else {
					$sort = $asc ? 'asc' : 'desc';
				}
				//取得满足条件的记录数
				$_REQUEST ['listRows'] = 20;
				$count = $model->where ( $map )->count ();
				if ($count > 0) {
					import ( "@.ORG.Util.Page" );
					//创建分页对象
					if (! empty ( $_REQUEST ['listRows'] )) {
						$listRows = $_REQUEST ['listRows'];
					} else {
						$listRows = '';
					}
					$p = new Page ( $count, $listRows );
					//分页查询数据
					$voList = $model->where($map)->order( "`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ( );
					//echo $model->getlastsql();
					//分页跳转的时候保证查询条件
					foreach ( $map as $key => $val ) {
						if (! is_array ( $val )) {
							$p->parameter .= "$key=" . urlencode ( $val ) . "&";
						}
					}
					//分页显示
					$page = $p->show ();
					//列表排序显示
					$sortImg = $sort; //排序图标
					$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
					$sort = $sort == 'desc' ? 1 : 0; //排序方式

					//模板赋值显示
					$this->assign ( 'list', $voList );
					$this->assign ( 'sort', $sort );
					$this->assign ( 'order', $order );
					$this->assign ( 'sortImg', $sortImg );
					$this->assign ( 'sortType', $sortAlt );
					$this->assign ( "page", $page );
				}


				//zhanghuihua@msn.com
				$this->assign ( 't',  $this->_param('t') );
				$this->assign ( 'totalCount', $count );
				$this->assign ( 'numPerPage', $p->listRows );
				$this->assign ( 'currentPage', !empty($_REQUEST[C('VAR_PAGE')])?$_REQUEST[C('VAR_PAGE')]:1);

				Cookie::set ( '_currentUrl_', __SELF__ );

				$ch = M ( "Channeltype" )->where("id = ".$_REQUEST ["channel"])->find();
				$this->assign ( 'channel', $ch );
			    if($ch['issystem'] == "0"){
					$this->display ('article_auto_recycle');
					exit;
			    }
				$this->display ();

	}





public function article_delete() {
	$model = M ("Addon".$this->_param("channel"));
	$id = $_REQUEST ["id"];
	if (isset ( $id )) {
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$map['aid'] = array ('in', explode ( ',', $id ) );
		$list=$model->where ( $map )->save(array("recycle"=>1));
		if ($list!==false) {
			$this->success ('删除成功！' );
		} else {
			$this->error ('删除失败！');
		}
	}
}

public function article_restore() {
	$model = M ("Addon".$this->_param("channel"));
	$id = $_REQUEST ["id"];
	if (isset ( $id )) {
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$map['aid'] = array ('in', explode ( ',', $id ) );
		$list=$model->where ( $map )->save(array("recycle"=>0));
		if ($list!==false) {
			$this->success ('恢复成功！' );
		} else {
			$this->error ('恢复失败！');
		}
	}
}



public function complete_delete() {
	$model = M ("Addon".$this->_param("channel"));
	$id = $_REQUEST ["id"];
	if (isset ( $id )) {
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$map['aid'] = array ('in', explode ( ',', $id ) );
		$list=$model->where ( $map )->delete();
		if ($list!==false) {
			$this->success ('彻底删除成功！' );
		} else {
			$this->error ('彻底删除失败！');
		}
	}
}


public function article_delete_auto() {
	$model = M ("Archives");
	$id = $_REQUEST ["id"];
	if (isset ( $id )) {
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$map['aid'] = array ('in', explode ( ',', $id ) );
		$list=$model->where ( $map )->delete();
		if ($list!==false) {
			$model = M ("Addon".$this->_param("channel"));
			$condition = array ("aid" => array ('in', explode ( ',', $id ) ) );
			$list=$model->where ( $condition )->delete();
			$this->success ('删除成功！' );
		} else {
			$this->error ('删除失败！');
		}
	}
}




public function article_add() {
	$ch = M ( "Channeltype" )->where("id = ".$_REQUEST ["channel"])->find();
	$this->assign("channel",$ch);
    if($ch['issystem'] == "0"){
		$this->display ('article_add_auto');
		exit;
    }
	$this->display ();
}


public function article_edit() {

	$model = M ( "Archives" );
	$id = $_REQUEST ["id"];
	$vo = $model->where("id = ".$id)->find();
	$this->assign ( 'vo', $vo );

	$model = M ( "Addon".$_REQUEST['channel'] );
	$addon = $model->where("aid = ".$id)->find();
	$this->assign ( 'addon', $addon );

	$ch = M ( "Channeltype" )->where("id = ".$_REQUEST ["channel"])->find();
	$this->assign("channel",$ch);
    if($ch['issystem'] == "0"){
		$this->display ('article_edit_auto');
		exit;
    }
	$this->display ();
}


public function article_update(){
		C('TOKEN_ON',false);

		//地区权限判断
		  if(intval($_SESSION["admin"]['usertype']) != 10 ){
		  	 $areas = $_SESSION["admin"]['areaID'].",".trim(getIdEnumAll($_SESSION["admin"]['areaID']),",");
		  	 $areasArr = explode ( ',', $areas ) ;
		  	 $areaID = $this->_param("areaID");
		  	 if(!in_array($areaID, $areasArr)){
				$this->error('操作失败，权限不够');
		  	 }
		  }


		foreach ($_POST as $key => $value) {
			if(is_array($_POST[$key])){
				$_POST[$key] = implode(",", $value);
			}
		}
	    $this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
		$addon = D("Addon".$this->_param("channel"));
		if(!$addon->create()) {
			$this->error($addon->getError());
		}else{

			$channel = M("Channeltype")->where("id=".$_POST['channel'])->find();
			if($channel['isCoordinate']){
				if($_POST['mapText']){
					list($longitude, $latitude) = explode(',', $_POST['mapText']);
				}
				$addon->longitude = $longitude;
				$addon->latitude = $latitude;
			}
			$addon->userid = $_SESSION["admin"]['userid'];
			$addon->userip = get_client_ip();
			$addon->addtime = strtotime($this->_param("addtime"));

			if($result	 =	 $addon->save()) {
				$this->success('更新成功！');
			}else{
				$this->error('更新失败！');
			}
		}
}





public function article_update_auto(){
		C('TOKEN_ON',false);
		foreach ($_POST as $key => $value) {
			if(is_array($_POST[$key])){
				$_POST[$key] = implode(",", $value);
			}
		}
		$P = D("Archives");
		if(!$P->create()) {
			$this->error($P->getError());
		}else{
		    $this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
			// 写入帐号数据
			$P->pubdate = strtotime($this->_param("pubdate"));
			$P->writer = $_SESSION["admin"]['userid'];
			if($result	 =	 $P->save()) {
				$addon = D("Addon".$this->_param("channel"));
				if(!$addon->create()) {
					$this->error($addon->getError());
				}else{
					$addon->userid = $_SESSION["admin"]['userid'];
					$addon->userip = get_client_ip();
					$addon->aid = $this->_param("id");
					$addon->save();
				}
				$this->success('修改成功！');
			}else{
				$this->error('修改失败！');
			}
	    }
}


public function article_insert(){
		C('TOKEN_ON',false);


		//地区权限判断
		  if(intval($_SESSION["admin"]['usertype']) != 10 ){
		  	 $areas = $_SESSION["admin"]['areaID'].",".trim(getIdEnumAll($_SESSION["admin"]['areaID']),",");
		  	 $areasArr = explode ( ',', $areas ) ;
		  	 $areaID = $this->_param("areaID");
		  	 if(!in_array($areaID, $areasArr)){
				$this->error('操作失败，权限不够');
		  	 }
		  }


		foreach ($_POST as $key => $value) {
			if(is_array($_POST[$key])){
				$_POST[$key] = implode(",", $value);
			}
		}
	    $this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
		$addon = D("Addon".$_POST['channel']);

		//唯一性判断
		$channelField = M("Channelfield")->where("chid=".$_POST['channel']." and check_unique=1")->select();
		foreach ($channelField as $v) {
			$tmp = $addon->where($v['fieldname']."='".$_POST[$v['fieldname']]."'")->find();
			if($tmp){
				$this->error('添加失败！'.$v['title'].'已存在');
			}
		}

		if(!$addon->create()) {
			$this->error($addon->getError());
		}else{

			//自动随机生成字段
			$channelField = M("Channelfield")->where("chid=".$_POST['channel']." and isAuto=1")->select();
			foreach ($channelField as $v) {
				$pre = $v['isAutoField'];
				import ( "@.ORG.Util.String" );
		        $rand = $pre . String::randString(6,1);
				$addon->$v['fieldname'] = $rand;
			}


			$channel = M("Channeltype")->where("id=".$_POST['channel'])->find();
			if($channel['isCoordinate']){
				if($_POST['mapText']){
					list($longitude, $latitude) = explode(',', $_POST['mapText']);
				}
				$addon->longitude = $longitude;
				$addon->latitude = $latitude;
			}


			$addon->userip = get_client_ip();
			$addon->typeid = intval($_SESSION["admin"]['typeid']);
			$addon->userid = $_SESSION["admin"]['userid'];
			$addon->addtime = strtotime($this->_param("addtime"));

			if($result	 =	 $addon->add()) {
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！');
			}
		}
}


public function article_insert_auto(){
		C('TOKEN_ON',false);
		foreach ($_POST as $key => $value) {
			if(is_array($_POST[$key])){
				$_POST[$key] = implode(",", $value);
			}
		}
		$model = D ("Archives");
	    $this->assign ( 'jumpUrl', Cookie::get ( '_currentUrl_' ) );
		if(!$model->create()) {
			$this->error($model->getError());
		}else{
			$model->pubdate = strtotime($this->_param("pubdate"));
			$model->writer = $_SESSION["admin"]['userid'];
			if($result	 =	 $model->add()) {
				$addon = D("Addon".$_POST['channel']);
				if(!$addon->create()) {
					$this->error($addon->getError());
				}else{
					$addon->userid = $_SESSION["admin"]['userid'];
					$addon->userip = get_client_ip();
					$addon->aid = $result;
					$addon->add();
				}
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！');
			}
	    }
}



// 框架首页
	public function search_result() {

				 $parse_url = "?";
				 //用品领用查询
				 if($_GET['mType'] == "goods"){
				 	$parse_url .= "mType=goods&";
				 	if(!empty($_GET['uname'])){
				 		$mm['uname'] = array('like',"%".$this->_param("uname")."%");
				 		$parse_url.= "uname=" . urlencode ( $this->_param("uname") ) . "&";
				 	}
				 	if(!empty($_GET['idcard'])){
				 		$mm['idcard'] = array('like',"%".$this->_param("idcard")."%");
				 		$parse_url.= "idcard=" . urlencode ( $this->_param("unidcardame") ) . "&";

				 	}

				  if(!empty($_REQUEST['startdate']) && !empty($_REQUEST['enddate'])){
					  $mm['addtime'] = array(array('egt',$_REQUEST['startdate']),array('elt',$_REQUEST['enddate']));
				 		$parse_url.= "startdate=" . urlencode ( $this->_param("startdate") ) . "&";
				 		$parse_url.= "enddate=" . urlencode ( $this->_param("enddate") ) . "&";

					}

					if(isset($mm)){
						//var_dump($mm);
				 		$A = M("addon45")->where($mm)->field("aid")->select();
					 		foreach ($A as $v) {
					 			$mids[] = $v['aid'];
					 		}
							$map['memberID'] = array ('in', $mids );
					}
				 	if(!empty($_GET['goodID'])){
				 		$map['goodID'] = array('eq',$this->_param("goodID"));
				 		$parse_url.= "goodID=" . urlencode ( $this->_param("goodID") ) . "&";

				 	}
				 	if(!empty($_GET['productID'])){
				 		$A = M("addon47")->where("productID=".$this->_param("productID"))->field("aid")->select();
				 		foreach ($A as $v) {
				 			$mids[] = $v['aid'];
				 		}
						$map['goodID'] = array ('in', $mids );
				 		$parse_url.= "productID=" . urlencode ( $this->_param("productID") ) . "&";
				 	}
				 	if(!isset($map)){
						$this->error('查询失败！条件为空！');
				 	}
				 }


				 if(!empty($_GET['companyID'])){
				 	 $tmp = $_GET['companyID'].getType2($_GET['companyID']);
					 $map['companyID'] = array ('in', explode ( ',', $tmp ) );

			 		 $parse_url.= "companyID=" . urlencode ( $this->_param("companyID") ) . "&";

                 }

                    $typeid = $_SESSION["admin"]['typeid'];
                    if($typeid){
                        $tmp = $typeid.getType2($typeid);
                        $map['typeid'] = array ('in', explode ( ',', $tmp ) );

                    }


				 $channel_1 = $_GET['channel'];
		 		 $parse_url.= "channel=" . urlencode ( $this->_param("channel") ) . "&";
				 $ch = M ( "Channeltype" )->where("id = ".$channel_1)->find();
				 $this->assign ( 'channel', $ch );
				 $map['channel'] = array('eq',$channel_1);
				 $channelField = M("Channelfield")->where("chid=".$channel_1." and displaylist=0")->order("sort")->select();
				 $this->assign ( 'channelField', $channelField );
				 $model = M ("Addon".$channel_1 );
				//排序字段 默认为主键名
				if (!empty ( $_REQUEST ['_order'] )) {
					$order = $_REQUEST ['_order'];
				} else {
					$order = ! empty ( $sortBy ) ? $sortBy : $model->getPk ();
				}
				//排序方式默认按照倒序排列
				//接受 sost参数 0 表示倒序 非0都 表示正序
				if (isset ( $_REQUEST ['_sort'] )) {
		//			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
					$sort = $_REQUEST ['_sort'] == 'asc' ? 'asc' : 'desc'; //zhanghuihua@msn.com
				} else {
					$sort = $asc ? 'asc' : 'desc';
				}
				//取得满足条件的记录数
				$_REQUEST ['listRows'] = 20;
				$count = $model->where ( $map )->count ();
				if ($count > 0) {
					import ( "@.ORG.Util.Page" );
					//创建分页对象
					if (! empty ( $_REQUEST ['listRows'] )) {
						$listRows = $_REQUEST ['listRows'];
					} else {
						$listRows = '';
					}
					$p = new Page ( $count, $listRows );
					//分页查询数据
					$voList = $model->where($map)->order( "`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ( );
					//echo $model->getlastsql();
					//分页跳转的时候保证查询条件
					foreach ( $map as $key => $val ) {
						if (! is_array ( $val )) {
							$p->parameter .= "$key=" . urlencode ( $val ) . "&";
						}
					}
					//分页显示
					$page = $p->show ();
					//列表排序显示
					$sortImg = $sort; //排序图标
					$sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
					$sort = $sort == 'desc' ? 1 : 0; //排序方式

          			//模板赋值显示
					$this->assign ( 'list', $voList );
					$this->assign ( 'sort', $sort );
					$this->assign ( 'order', $order );
					$this->assign ( 'sortImg', $sortImg );
					$this->assign ( 'sortType', $sortAlt );
					$this->assign ( "page", $page );
				}
				//zhanghuihua@msn.com
				$this->assign ( 't',  $this->_param('t') );
				$this->assign ( 'totalCount', $count );
				$this->assign ( 'numPerPage', $p->listRows );
				$this->assign ( 'currentPage', !empty($_REQUEST[C('VAR_PAGE')])?$_REQUEST[C('VAR_PAGE')]:1);

				$this->assign ( 'parse_url', $parse_url );

				Cookie::set ( '_currentUrl_', __SELF__ );
				$this->display ();

	}


	//数据导出
        public function exportData() {

				 //用品领用查询
				 if($_GET['mType'] == "goods"){
				 	if(!empty($_GET['uname'])){
				 		$mm['uname'] = array('like',"%".$this->_param("uname")."%");
				 	}
				 	if(!empty($_GET['idcard'])){
				 		$mm['idcard'] = array('like',"%".$this->_param("idcard")."%");
				 	}

				  if(!empty($_REQUEST['startdate']) && !empty($_REQUEST['enddate'])){
					  $mm['addtime'] = array(array('egt',$_REQUEST['startdate']),array('elt',$_REQUEST['enddate']));
					}

					if(isset($mm)){
						//var_dump($mm);
				 		$A = M("addon45")->where($mm)->field("aid")->select();
					 		foreach ($A as $v) {
					 			$mids[] = $v['aid'];
					 		}
							$map['memberID'] = array ('in', $mids );
					}
				 	if(!empty($_GET['goodID'])){
				 		$map['goodID'] = array('eq',$this->_param("goodID"));
				 	}
				 	if(!empty($_GET['productID'])){
				 		$A = M("addon47")->where("productID=".$this->_param("productID"))->field("aid")->select();
				 		foreach ($A as $v) {
				 			$mids[] = $v['aid'];
				 		}
						$map['goodID'] = array ('in', $mids );
				 	}
				 	if(!isset($map)){
						$this->error('导出失败！条件为空！');
				 	}
				 }



			 if(!empty($_GET['companyID'])){
			 	 $tmp = $_GET['companyID'].getType2($_GET['companyID']);
				 $map['companyID'] = array ('in', explode ( ',', $tmp ) );
			 }





			 $channel_1 = $_GET['channel'];
			 $ch = M ( "Channeltype" )->where("id = ".$channel_1)->find();
			 $this->assign ( 'channel', $ch );
			 $map['channel'] = array('eq',$channel_1);
			 $channelField = M("Channelfield")->where("chid=".$channel_1)->order("sort")->select();
			 $this->assign ( 'channelField', $channelField );
			 $model = M ("Addon".$channel_1 );


			  //search
			  foreach($channelField as $v){
					if($v['issearch'] == 1){
						if(!empty($_GET[$v['fieldname']])){
							$map[$v['fieldname']] = array('eq',$_GET[$v['fieldname']]);
						}
					}
			   }
			   //./search


			if (method_exists ( $this, '_filter' )) {
				$this->_filter ( $map );
			}


			if (!empty ( $_REQUEST ['_order'] )) {
				$order = $_REQUEST ['_order'];
			} else {
				$order = ! empty ( $sortBy ) ? $sortBy : $model->getPk ();
			}
			if (isset ( $_REQUEST ['_sort'] )) {
				$sort = $_REQUEST ['_sort'] == 'asc' ? 'asc' : 'desc';
			} else {
				$sort = $asc ? 'asc' : 'desc';
			}
			$voList = $model->where($map)->order( "`" . $order . "` " . $sort)->limit('0,100000')->select ( );

            $list[]="ID";
			foreach ($channelField as $value) {
				$list[] = $value['title'];
			}


            $data = array();
            $data[] = $list;
            foreach ($voList as $v) {
            	$tmp1['ID'] = $v['aid'];
				foreach ($channelField as $value) {
					//联动
					if($value['isLink'] == "1" && $value['isLinkType'] == "nativeplace"){
						$tmp1[$value['fieldname']] = getEnum22($v[$value['fieldname']]);
					}else{
						$tmp1[$value['fieldname']] = $v[$value['fieldname']];
					}
				}
                $data[] = $tmp1;
            }

		    
		    //统计  
		    $isCount = false;           
	        $list1[]="总计";
			foreach ($channelField as $value) {
				if($value['isCount'] == 1){
					$isCount = true;
                    $list1[] = M("Addon".$value['chid'])->sum($value['fieldname']);
				}
				else{
					$list1[] = '';							
				}
			}
		   if($isCount){
              $data[] = $list1;
		   }
		   //END



            require_once (dirname(__FILE__)."/../../../Public/excel/php-excel.class.php");
            $xls = new Excel_XML('UTF-8', false, 'data');
            $xls->addArray($data);

            $xls->generateXML($_GET['channel']);
            //toexcel($list);
        }





  }
?>
