<?php

namespace External;

class FacebookPublicator
{
	public function publicate(FacebookAdvertisement $advertisement): FacebookAdResult
	{
		return (new FacebookAdResult())->setTargetingName("Response");
	}
}