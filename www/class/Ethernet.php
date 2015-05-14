<?php
	class Ethernet
	{		
		private $aliasName;
		private $ethernet;
		private $id;
		private $mrtgData = "/var/www/mrtg";
		
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
		public function printHTML(){
			$exec = "find ".$this->mrtgData." -iname \"*.png\" -print | grep -i " . str_replace("/", "_",$this->ethernet) . "- | sort";
			$lines = shell_exec ( $exec);
			$imageLocation = preg_split('/[\s]+/', $lines);
			echo "<div class=\"ethernet\">";
			echo "<H1>". $this->ethernet." (".$this->aliasName.") </H1>";
			echo "";
			$imageLocation[0] = str_replace("/var/www","",$imageLocation[0]);
			
			
			echo "<img src=\"". $imageLocation[0] . "\" width=\"400\"/>";
			echo "</div>";
			
		}
    }
?>