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

$lang = array_merge($lang, array(
	'ACP_REFERRERS'	=> 'Registro de referidos',

	'ACP_REF_MANAGE'			=> 'Referidos',
	'ACP_REF_MANAGE_EXPLAIN'	=> 'Muestra una lista de sitios web y URL de donde los visitantes llegan a su foro.<br />Puede clasificar el host, las visitas, la primera y la última fecha de visita.',

	'REF_HOST'	=> 'Host',
	'REF_URL'	=> 'Referido',
	'REF_IP'	=> 'Dirección IP',
	'REF_HITS'	=> 'Visita(s)',
	'REF_FIRST'	=> 'Primera visita',
	'REF_LAST'	=> 'Última visita',

	'LOG_REFERRER_REMOVED'		=> '<strong>Purgar referidos</strong><br />» Hosts (%1$s),  %2$s registros',
	'LOG_REFERRER_REMOVED_ALL'	=> '<strong>Referidos purgados</strong>',

	'DELETE_REFERRERS_DAYS'			=> 'Referidos',
	'DELETE_REFERRERS_DAYS_EXPLAIN'	=> 'Días después para que el cron elimine los referidos. 0 desactivará este cron.',
	'FH_HELPER_NOTICE'		=> '¡La aplicación Forumhulp helper no existe!<br />Descargar <a href="https://github.com/ForumHulp/helper" target="_blank">forumhulp/helper</a> y copie la carpeta helper dentro de la carpeta de extensión forumhulp.',
	'REFERRER_NOTICE'		=> '<div class="phpinfo"><p class="entry">La extensión está en %1$s » %2$s » %3$s.<br>Los ajustes de configuración están en %4$s » %5$s » %6$s.</p></div>',
));
