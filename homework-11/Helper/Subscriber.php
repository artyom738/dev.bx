<?php

namespace Helper;

class Subscriber
{
	public static function onUserAdd($data)
	{
		echo $data->getId() . PHP_EOL;
	}
	public static function onUserUpdate($data)
	{
		echo $data->getName() . PHP_EOL;
	}
	public static function onServicePurchase($data)
	{
		echo 'Subscription ' . $data->getType() . ', until ' . $data->getActivatedUntil()->format('Y-m-d') . PHP_EOL;
	}
}