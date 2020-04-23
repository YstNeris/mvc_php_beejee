<?php

function lnk($link, $arr)
{
	$saved = ['page', 'sort', 'order', 'task'];
	$arr = array_merge($_GET, $arr);
	if (!isset($_GET)) return $link;
	$url = $link . "?";
	foreach ($arr as $key => $value)
		foreach ($saved as $s) if ($key == $s) $url .= "$key=$value&";

	return mb_substr($url, 0, -1);
}
