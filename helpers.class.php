<?php

/**
* Generic helper methods for any fusion forms
*/
class Helper
{

	static function bodyClass(){

	$classes = array();

	// leadcat
	$classes[] = $_GET['leadcat'];

	// version
	if(isset($_GET['v'])){
	$classes[] = 'v-' . $_GET['v'];
	}

	// 42
	if(isset($_GET['42'])){
	$classes[] = '42-' . $_GET['42'];
	}

	// step
	$classes[] = 'step-' . $_GET['step'];

	// f
	$classes[] = 'f' . $_GET['f'];

	// Creates class string
	$numClasses = count($classes);
	$i = 0;
	$bodyClass = "class='";
	foreach ($classes as $class) {
	if($i+1 != $numClasses){
	$bodyClass .= $class . ' ';
	} else {
	$bodyClass .= $class;
	}
	$i++;
	}

	$bodyClass .= "'";

	echo $bodyClass;

	}
}