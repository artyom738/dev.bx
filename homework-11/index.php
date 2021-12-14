<?php

use Entity\Service;
use Entity\User;

spl_autoload_register(function ($class) {
	include __DIR__ . '/' . str_replace("\\", "/",  $class) . '.php';
});

\Event\EventBus::getInstance()->subscribe("onServicePurchase", "\\Helper\\Subscriber::onServicePurchase");


function purchasePremiumUltimate()
{
	\Strategy\PurchaseServiceContext::purchase(new \Strategy\PurchasePremiumUltimateStrategy());
}
purchasePremiumUltimate();

function purchaseVip()
{
	\Strategy\PurchaseServiceContext::purchase(new \Strategy\PurchaseVipStrategy());
}
purchaseVip();


