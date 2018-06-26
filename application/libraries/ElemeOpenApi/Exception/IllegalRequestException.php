<?php

require_once(dirname(__FILE__).'/ServiceException.php');

if(!class_exists('IllegalRequestException')){
	class IllegalRequestException extends ServiceException
	{

	}
}