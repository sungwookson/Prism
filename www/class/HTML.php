<?php
	class HTML {
		private $dataFetcher;
		
		public function __construct($dataFetcher) {
			$this->dataFetcher = $dataFetcher;
		}

		function titleHTML(){
			return "Prism Network Manager";
		}
		function styleHTML(){
			return "
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\">
			<!--
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.min.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap-theme.min.css\">
			-->
			<link rel=\"stylesheet\" type=\"text/css\" href=\"css/metro-bootstrap.min.css\">


			
			<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js\"></script>
			<script src=\"js/jquery.masonry.min.js\"></script>
			<script src=\"js/switch.js\"></script>";
		}
		
		function headerHTML(){
			return "";
		}
		function mainBodyHTML(){
			return "<body>
						<div id=\"container\">
							<div id=\"portchannel\">".
								$this->portChannelHTML().
							"</div>
							<div id=\"ethernet\">".
								$this->ethernetHTML().
							"</div>
						</div>";
		}
		function portChannelHTML(){
			foreach ($this->dataFetcher->getPortChannel() as $portChannel) {
				$portChannel->printHTML();
			}
		}
		function ethernetHTML(){
			foreach ($this->dataFetcher->getEthernet() as $ethernet) {
				$ethernet->printHTML();
			}
		}
		
		function footerHTML(){
			return "";
		}
		function printHTML(){
			echo "<html>
				<head>
					<title>".$this->titleHTML()."</title>".
					$this->styleHTML()."
				</head>
				<body>".
					$this->headerHTML().
					$this->mainBodyHTML().
					$this->footerHTML().
				"</body>
			</html>";
		}
		function printFront(){
			echo "<html>
					<head>
						<title>".
							$this->titleHTML().
						"</title>".
						$this->styleHTML().
					"</head>
					<body>
						<div id=\"container\">";
		}
		function printLast(){
			echo $this->headerHTML().
					//$this->mainBodyHTML().
					$this->footerHTML().
				"</body>
			</html>";
		}
		
	}

	
?>
