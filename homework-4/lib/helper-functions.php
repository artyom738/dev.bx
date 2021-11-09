<?php

function str_contains(string $haystack, string $needle): bool
{
	return empty($needle) || mb_stripos($haystack, $needle) !== false;
}
