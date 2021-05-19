<?php
foreach (glob("src/plugins/*.php") as $filename)
{
	require_once $filename;
}