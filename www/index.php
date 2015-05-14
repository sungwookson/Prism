<?php
	require_once('framework/conf.php');
	require('class/DataFetcher.php');
	require('class/PortChannel.php');
	require('class/Ethernet.php');
	require('class/HTML.php');
	
	
	$dataFetcher = new DataFetcher($organizedData);
	$portChannels = $dataFetcher->getPortChannel();
	$ethernets = $dataFetcher->getEthernet();
	$html = new HTML();
	$html->printFront();

	foreach ($portChannels as $portChannel) {
		$portChannel->printHTML();
	}
	
	foreach ($ethernets as $ethernet) {
		$ethernet->printHTML();
	}
	
	$html ->printLast();
	
?>

