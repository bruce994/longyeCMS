<?php
  class MapAction extends CommonAction{



     public function index(){
				Cookie::set ( '_currentUrl_', __SELF__ );
				$this->display ();
	 }





  }
?>
