<?php

function renderTemplate(string $path, array $templateData = []): string
{
	if (!file_exists($path))
	{
		trigger_error('Path is wrong', E_USER_ERROR);
		return '';
	}

	extract($templateData, EXTR_OVERWRITE);

	ob_start();

	include $path;

	return ob_get_clean();
}

function renderLayout(string $content, array $templateData = []): void
{
	$data = array_merge($templateData, [
		'content' => $content
	]);
	$result = renderTemplate("./resources/pages/layout.php", $data);

	echo $result;
}