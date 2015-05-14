<?php
	class HTML {
		private $style;
		private $body;
		
		public function __construct() {
			$this->style = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\">
			<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js\"></script>
<script src=\"/js/jquery.masonry.min.js\"></script><style>
  .portchannel {
    float: left; /* This is necessary */
    width: 400;
    background-color: #CCC;
    margin: 5px;
    padding: 5px 5px;
  }
  .ethernet {
    float: left; /* This is necessary */
    width: 400;
    background-color: #8CB5D2;
    margin: 5px;
    padding: 5px 5px;
  }
  .wide {
    width: 440px; /* This is to compensate for margin and padding (2*200px)+(2*5px)+(2*5px) */
    background-color: gray;
  }
  h1 {
    font-family: arial;
    font-size: 16px;
  }
</style>
";
			$this->body = "";
		}

		function titleHTML(){
			return "Prism Network Manager";
		}
		function styleHTML(){
			return $this->style;
		}
		
		function headerHTML(){
			return "";
		}
		function mainBodyHTML(){
			return $this->body;
		}
		function footerHTML(){
			return "";
		}
		function printHTML(){
			echo "<html>
				<head>
					<title>{titleHTML()}</title>
					{styleHTML()}
				</head>
				<body>
					{headerHTML()}
					{mainBodyHTML()}
					{footerHTML()}
				</body>
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
			echo "</div>
			<script>$(function(){
 $('#container').masonry({
   // options
   itemSelector : '.portchannel, .ethernet, h1',
   columnWidth : 240
 });
});</script>".
			$this->headerHTML().
					$this->mainBodyHTML().
					$this->footerHTML().
				"</body>
			</html>";
		}
		
	}

	
?>
