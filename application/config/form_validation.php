<?php

$config = array(
	'area_put' => array(
		array('field'=>'vch_titulo', 'label' =>'vch_titulo', 'rules'=>'trim|required')
	),
	'tweet_put' => array(
		array('field'=>'usuario', 'label' =>'usuario', 'rules'=>'trim|required'),
		array('field'=>'tweet', 'label' =>'tweet', 'rules'=>'trim|required'),
		array('field'=>'hora', 'label' =>'hora', 'rules'=>'trim|required')
	)
);

?>