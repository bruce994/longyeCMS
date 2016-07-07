<?php
  class ChartAction extends CommonAction{

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



     public function getAPI(){



		for ($i = 1; $i <= 12; $i++) {
			$y = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
		    $months[] = $y;
		    $yy .= " y='".$y."' or";
		}

		if(!empty($yy)){
			$yy = trim($yy,'or');
		}




   $item = 'item';
   $i = 0;
   foreach (explode('|',$_GET['where'] ) as $value) {
   		$i++;
		$sql =  "SELECT sum(".$_GET['fieldValue'].") as name,FROM_UNIXTIME(addtime,'%Y-%m') as y  FROM `".C("DB_PREFIX")."addon".$_GET['channel']."` where ".$_GET['fieldName']."='".$value."' and addtime>0 group by y having ".$yy."  order by y desc";
		$Model = new Model();
		$list = $Model->query($sql);

		foreach ($months as $m) {
			foreach ($list as $l) {
				if($l['y'] == $m){
					if(!array_key_exists($m, $tmp)){
						$tmp[$m] = array($item.$i=>$l['name']);
					}else{
						$tmp[$m] = array_merge($tmp[$m],array($item.$i=>$l['name']));
					}
				}
			}

			if(!array_key_exists($m, $tmp)){
				$tmp[$m] = array($item.$i=>null);
			}else{
				//$tmp[$m] = array_merge($tmp[$m],array($item.$i=>null));
			}

		}
   }

	var_dump($tmp);exit;

	echo $sql;
	exit;

	$Model = new Model();
	$vo = $Model->query($sql);






				$sql =  "SELECT sum(".$_GET['fieldValue'].") as item1,FROM_UNIXTIME(addtime,'%Y-%m-%d') as y  FROM `".C("DB_PREFIX")."addon".$_GET['channel']."` where ".$_GET['fieldName']."='".$_GET['where']."' and addtime>0 group by y  order by y desc  limit 0,30";
				$Model = new Model();
				$vo = $Model->query($sql);
			    echo "var memberCount = ".json_encode($vo).";";
			    exit;

                switch ($_GET['type']) {
                        case 'getMemberCount':
                                $Model = new Model();
                                $vo = $Model->query("SELECT count(*) as item1,FROM_UNIXTIME(m_addtime,'%Y-%m-%d') as y  FROM `".C("DB_PREFIX")."member` group by y  order by y desc  limit 0,30");
                                echo "var memberCount = ".json_encode($vo).";";
                                break;

                        case 'getArchivesCount':
                                $Model = new Model();
                                $vo = $Model->query("SELECT count(*) as item1,FROM_UNIXTIME(addtime,'%Y-%m-%d') as y  FROM `".C("DB_PREFIX")."article` group by y  order by y desc  limit 0,30");
                                echo "var archiveCount = ".json_encode($vo).";";
                                break;
                       case 'getVoteCount':
                                $Model = new Model();
                                $vo = $Model->query("SELECT count(*) as item1,mid as y FROM `".C("DB_PREFIX")."vote_record` group by vid  order by item1 desc limit 0,30");
                                echo "var archiveCount = ".json_encode($vo).";";
                                break;

                       case 'getRecordCount':
                                $dd = strtotime('-15 days');
                                $Model = new Model();
                                $row = $Model->query("SELECT mid,count(*) as a FROM `".C("DB_PREFIX")."vote_record` WHERE addtime > ".$dd." group by vid  order by a desc limit 0,15");
                                $tmp = '';
                                foreach ($row as $value) {
                                    $member = M("Member")->where("m_id=".$value['mid'])->field('m_username')->find();
                                    $tmp .= '["User:'.$member['m_username'].'", '.$value['a'].'],';
                                }
                                if($tmp){
                                    $tmp = trim($tmp,",");
                                }
                                echo "var recordCount = [".$tmp."]";
                                break;
                        default:
                                break;
                }
         }










  }
?>
