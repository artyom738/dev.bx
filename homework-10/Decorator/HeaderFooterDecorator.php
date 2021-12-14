<?php

namespace Decorator;

use Service\HeaderFooterAdder;

class HeaderFooterDecorator implements HeaderFooterAdder
{
	protected $advertisement;
	protected $messageBody;

	public function __construct($advertisement)
	{
		$this->advertisement = $advertisement;
		$this->messageBody = $advertisement->getBody();
	}

	public function addHeaderFooter(): HeaderFooterAdder
	{
		$headerText = 'Attention!';
		$footerText = 'We are waiting fot you!';
		$this->messageBody = "<h1>$headerText</h1>" . $this->messageBody . "<h4>$footerText</h4>";
		return $this;
	}

	public function getMessage(): string
	{
		return $this->messageBody;
	}
}