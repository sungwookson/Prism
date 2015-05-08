<?php
	class Ethernet
	{		
		private $aliasName;
		private $ethernet;
		private $id;
		
		public function __construct($data) {
			$data = preg_split('/[\s]+/', $data);
			$this->id = $data[2];
			$this->ethernet = $data[3];
			$this->aliasName = "";
			if (count($data) == 5){
				$this->aliasName = $data[4];
			}
			
		}
		public function getAliasName(){
			return $this->aliasName;
		}
    }
?>