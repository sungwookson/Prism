<?php
	require_once('conf.php');
	class PortChannel
	{
		public $data;
		private $portChannel;
		private $aliasName;
		private $id;
		private $ethernets = array();
		private $mrtgData = "/var/www/mrtg";
		
		public function __construct($data) {
			$this->data = $data;
			
			
			$content = preg_split('/[\s]+/', $data);
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
			$exec = "find ".$this->mrtgData." -iname \"*.png\" -print | grep -i " . $this->portChannel . " | sort";
			$lines = shell_exec ( $exec);
			$imageLocation = preg_split('/[\s]+/', $lines);
			echo "<H1>". $this->portChannel." (".$this->aliasName.") </H1>";
			$imageLocation[0] = str_replace("/var/www","",$imageLocation[0]);
			echo "<img src=\"". $imageLocation[0] . "\"/>";
			
		}
		
    }
?>