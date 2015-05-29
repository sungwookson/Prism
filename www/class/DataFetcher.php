<?php
	class DataFetcher
	{
		public $fileURL;
		
		private $portChannels = array();
		private $ethernets = array();
		
		public function __construct($fileURL) {
			$this->fileURL = $fileURL;
			$this->parse();
		}
		private function parse(){
			$content = file_get_contents($this->fileURL);
			$content = explode("\n", $content);
			foreach($content as $value) {
				$value = str_replace(" ", "", $value);
				if (empty($value)) continue;
				if ($this->isPortChannel($value)){
					$portChannel = $this->contains(preg_split('/[\s]+/', $value));
					if (!is_bool($portChannel)){
						$portChannel->add($value);
					}
					else {
						$this->portChannels[] = new PortChannel($value);
					}
				}
				else {
					$this->ethernets[] = new Ethernet($value);
				}
			}
		}
		
		public function getPortChannel(){
			return $this->portChannels;	
		}
		public function getEthernet(){
			return $this->ethernets;	
		}
		function isPortChannel($data){
			$data = preg_split('/[\s]+/', $data);
			//echo "<pre>" . var_dump($data) . "</pre>";
			return strpos($data[1], "Port-Channel") === 0;
		}
		function contains($data) { 
		    foreach ($this->portChannels as $portChannel) {
			    if ($portChannel->getID() == $data[0]) {
				    return $portChannel;
			    }
		    }
		    return false;
		}
    }
?>