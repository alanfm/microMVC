<?php

namespace App\Controller;

class Home
{
	public static function index()
	{
		print('Página Inicial');
	}

	public function teste($param = array())
	{
		var_dump($param);
		if (count($param)) {
			print(implode(' ', $param));
		}
	}
}