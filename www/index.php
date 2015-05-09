<?php
	require_once('framework/conf.php');
	require('class/DataFetcher.php');
	require('class/PortChannel.php');
	require('class/Ethernet.php');
	require('class/HTML.php');
	
	
	$dataFetcher = new DataFetcher($organizedData);
	$portChannels = $dataFetcher->getPortChannel();
	$ethernets = $dataFetcher->getEthernet();

	/*
	<div class="container">
    <div class="first">first</div>
    <div class="first">second</div>
    <div class="first">third</div>
    <div class="first">fourth</div>
    <div class="first">fifth</div>
    <div class="first">sixth</div>
    
	</div>
	*/
	foreach ($portChannels as $portChannel) {
		$portChannel->printHTML();
	}
	
	foreach ($ethernets as $ethernet) {
		
	}
	
	
	
?>

