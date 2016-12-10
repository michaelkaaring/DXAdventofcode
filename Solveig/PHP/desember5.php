<?php


function checkHash($hash)
{
	return preg_match('/^00000/', $hash);
}

$input = 'reyedfim';
$inc = 0;
$hash;
$password = array();

while(count($password) < 8)
{
	$hash = md5($input . $inc);

	if (checkHash($hash) > 0)
	{
		$password[] = substr($hash, 5, 1);
		var_dump($password);
	}
	$inc++;
}

echo implode('', $password);
