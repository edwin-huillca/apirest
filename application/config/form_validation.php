<?php

$config = array(
		'tweet_put' => array(
			array('field'=>'usuario', 'label' =>'usuario', 'rules'=>'trim|required'),
			array('field'=>'tweet', 'label' =>'tweet', 'rules'=>'trim|required'),
			array('field'=>'hora', 'label' =>'hora', 'rules'=>'trim|required')
		)
);

?>