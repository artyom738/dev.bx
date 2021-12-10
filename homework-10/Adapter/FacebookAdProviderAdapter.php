<?php

namespace Adapter;

use Entity\Advertisement;
use Entity\AdvertisementResponse;
use External\FacebookAdvertisement;
use External\FacebookPublicator;

class FacebookAdProviderAdapter implements \Service\AdvertisementProviderInterface
{

	public function publicate(Advertisement $advertsement): AdvertisementResponse
	{
		$facebookAd = new FacebookAdvertisement();

		$facebookAdTitle = $facebookAd -> getTitle();
		if (!$facebookAdTitle)
		{
			$facebookAd->setTitle('Default Title');
			$facebookAdTitle = 'Default Title';
		}

		$facebookAd
			->setTitle($advertsement->getTitle())
			->setMessageBody($advertsement->getBody());

		$result = (new FacebookPublicator())->publicate($facebookAd);

		return (new AdvertisementResponse())->setTargeting($result->getTargetingName());

	}

}