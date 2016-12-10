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
		$pos = substr($hash, 5, 1);

		if (is_numeric($pos) && (int)$pos < 8 && !array_key_exists($pos, $password)) {

			$password[$pos] = substr($hash, 6, 1);

		}
	}
	$inc++;
}

ksort($password);
var_dump($password);
echo implode('', $password);
