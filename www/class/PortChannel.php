<?php
	class PortChannel
	{
		public $data;
		private $portChannel;
		private $aliasName;
		private $id;
		private $ethernets = array();
		private $mrtgData = "/var/www/mrtg";
		private $mrtgLink = "../mrtg";
		public function __construct($data) {
			$this->data = $data;
			
			
			$content = preg_split('/[\
			
			
			s]+/', $data);
			$this->portChannel = $content[1];
			$this->aliasName = "";
			if (count($content) == 5){
				$this->aliasName = $content[4];
			}
			$this->id = $content[0];
			
			$this->add($data);
		}
		public function add($data){
			$this->ethernets[] = new Ethernet($data);
		}
		public function getID(){
			return $this->id;
		}
		public function getEthernets(){
			return $this->ethernets;	
		}
		public function getAliasName(){
			return $this->aliasName;
		}
		public function printHTML(){
			//$exec = "find ".$this->mrtgData." -iname \"*.png\" -print | grep -i " . $this->portChannel . "- | sort";
			
			$exec = "find ".$this->mrtgData." -iname '*".$this->portChannel. "*' -o -name '*".$this->portChannel.".html' | sort";
			
			$lines = shell_exec ( $exec);
			$imageLocation = preg_split('/[\s]+/', $lines);
			$link = $imageLocation[4];
			$link = str_replace($this->mrtgData, $this->mrtgLink, $link);		
			echo "<div class=\"portchannel\">\n";
			
			echo "<H4>". $this->portChannel." (".$this->aliasName.") </H4>\n";
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
			
			echo "<div class =\"images\" id=\"".$this->portChannel."\">";
			
			echo "<a href=\"".$link."\">";
			echo "<img class =\"Daily\" src=\"". $imageLocation[0] . "\" width=\"400\"/>\n";
			echo "<img class =\"Weekly\"src=\"". $imageLocation[2] . "\" width=\"400\"/>\n";
			echo "<img class =\"Monthly\"src=\"". $imageLocation[1] . "\" width=\"400\"/>\n";
			echo "<img class =\"Yearly\"src=\"". $imageLocation[3] . "\" width=\"400\"/>\n";
			echo "</a></div></div>\n";			
		}
		public function printPopOver(){
			
			
			echo "<div class=\"".$this->portChannel."\">";
			foreach ($this->getEthernets() as $ethernet) {
				$ethernet->printPopOver();
			}
			echo "</div>";
		}
    }
?>