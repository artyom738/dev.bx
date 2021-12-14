<?php

namespace Service;

interface HeaderFooterAdder
{
	public function addHeaderFooter(): HeaderFooterAdder;
	public function getMessage(): string;

}