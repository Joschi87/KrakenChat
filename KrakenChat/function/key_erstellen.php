<?php

	mt_srand(crc32(microtime()));
      $buchstaben = array("","a","b","c","d","e","f","g","h","i","j","k","m","n","p","q","r","s","t","u","v","w","x","y","z",1,2,3,4,5,6,7,8,9);
	$array_max = count($buchstaben)-1;

	for($i=0;$i < 8;$i++)
   	{
      $rand_num = mt_rand(1, $array_max);
      $key_2 .= $buchstaben[$rand_num];
      $a++;
      }
      
      $GLOBALS['key'] = $key_2;
?>