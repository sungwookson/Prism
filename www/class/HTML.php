<?php
	class HTML {
		private $style;
		private $body;
		
		public function __construct($style, $body) {
			$this->style = $style;
			$this->body = $body;
		}

		function title(){
			return "Prism Network Manager"
		}
		function style(){
			return $this->style;
		}
		
		function header(){
			return <<< EOF
			<table bgcolor="#7777aa" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><h1>Complex table layout example</h1></td>
				</tr>
			</table>
			EOF;
		}
		function mainBody(){
			return $this->body;
		}
		function footer(){
			
		}
		function print(){
			echo <<< EOF
			<html>
				<head>
					<title>{title()}</title>
					{style()}
				</head>
				<body>
					{header()}
					{mainbody()}
					{footer()}
				</body>
			</html>
			EOF;
		}
		
	}

	
?>