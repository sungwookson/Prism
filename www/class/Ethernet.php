<?php
	class Ethernet
	{		
		private $aliasName;
		private $ethernet;
		private $id;
		private $mrtgData = "/var/www/mrtg";
		private $mrtgLink = "../mrtg";
		
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
			
			$exec = "find ".$this->mrtgData." -iname '*".str_replace("/", "_",$this->ethernet). "*' -o -name '*".str_replace("/", "_",$this->ethernet).".html' | sort";
			
			$lines = shell_exec ( $exec);
			$imageLocation = preg_split('/[\s]+/', $lines);
			
			
			if ($imageLocation[0] != ""){ 
			$link = $imageLocation[4];
			$link = str_replace($this->mrtgData, $this->mrtgLink, $link);		
			
			echo "<div class=\"ethernet\">\n";
			echo "<H4>". $this->ethernet." (".$this->aliasName.") </H4>\n";
			echo "";
			echo "<ul class=\"nav nav-pills nav-justified\">
  <li class=\"active\"><a href=\"#\" onClick=\"return false;\">Daily</a></li>
  <li><a href=\"#\" onClick=\"return false;\">Weekly</a></li>
  <li><a href=\"#\" onClick=\"return false;\">Monthly</a></li>
  <li><a href=\"#\" onClick=\"return false;\">Yearly</a></li>
</ul>";
			
			$imageLocation[0] = str_replace("/var/www","",$imageLocation[0]);
			$imageLocation[2] = str_replace("/var/www","",$imageLocation[2]);
			$imageLocation[1] = str_replace("/var/www","",$imageLocation[1]);
			$imageLocation[3] = str_replace("/var/www","",$imageLocation[3]);
			
			echo "<div class =\"images\">";
			
			echo "<a href=\"".$link."\">";
			echo "<img class =\"Daily\" src=\"". $imageLocation[0] . "\" width=\"400\"/>\n";
			echo "<img class =\"Weekly\"src=\"". $imageLocation[2] . "\" width=\"400\"/>\n";
			echo "<img class =\"Monthly\"src=\"". $imageLocation[1] . "\" width=\"400\"/>\n";
			echo "<img class =\"Yearly\"src=\"". $imageLocation[3] . "\" width=\"400\"/>\n";
			echo "</a></div></div>\n";
			}
		}
		public function printPopOver(){
			$exec = "find ".$this->mrtgData." -iname '*".str_replace("/", "_",$this->ethernet). "*' -o -name '*".str_replace("/", "_",$this->ethernet).".html' | sort";
			
			$lines = shell_exec ( $exec);
			$imageLocation = preg_split('/[\s]+/', $lines);
			$imageLocation[0] = str_replace("/var/www","",$imageLocation[0]);
			echo "<div class=\"ethernetPop\">";
			echo "<H5>". $this->ethernet." (".$this->aliasName.") </H5>\n";
			echo "<img src=\"". $imageLocation[0] . "\" width=\"300\"/>\n";
			echo "</div>";

		}
    }
?>