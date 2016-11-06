<?php
/**
*
* @package Referrers
* @copyright (c) 2014 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// Description of extension
$lang = array_merge($lang, array(
	'DESCRIPTION_PAGE'		=> 'Descripción',
	'DESCRIPTION_NOTICE'	=> 'Nota de la extensión',
	'ext_details' => array(
		'details' => array(
			'DESCRIPTION_1'		=> 'Clasificable',
			'DESCRIPTION_2'		=> 'Función Whois',
			'DESCRIPTION_3'		=> 'Cron para limpiar tabla',
		),
		'note' => array(
			'NOTICE_1'			=> 'Preparado para phpBB 3.2'
		)
	)
));
