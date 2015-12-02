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
	'ACP_REFERRERS'	=> 'Referrers log',

	'ACP_REF_MANAGE'			=> 'Referrers',
	'ACP_REF_MANAGE_EXPLAIN'	=> 'Display a list of websites and url’s where visitors came from to your board.<br />You can sort on host, visits and first and last visit date. A cron jobs will delete records where last visit is older then x days, adjustable in Board features.',

	'REF_HOST'	=> 'Host',
	'REF_URL'	=> 'Referrer',
	'REF_IP'	=> 'IP address',
	'REF_HITS'	=> 'Visits',
	'REF_FIRST'	=> 'First visit',
	'REF_LAST'	=> 'Latest visit',

	'LOG_REFERRER_REMOVED'		=> '<strong>Prune referrers</strong><br />» Hosts (%1$s),  %2$s records',
	'LOG_REFERRER_REMOVED_ALL'	=> '<strong>Purged referrers</strong>',

	'DELETE_REFERRERS_DAYS'			=> 'Referrers',
	'DELETE_REFERRERS_DAYS_EXPLAIN'	=> 'Days after cron wil delete referrers. 0 will disable this cron.',
	'FH_HELPER_NOTICE'		=> 'Forumhulp helper application does not exist!<br />Download <a href="https://github.com/ForumHulp/helper" target="_blank">forumhulp/helper</a> and copy the helper folder to your forumhulp extension folder.',
	'REFERRER_NOTICE'		=> '<div class="phpinfo"><p class="entry">This extension resides in %1$s » %2$s » %3$s.<br>Config settings are in %4$s » %5$s » %6$s.</p></div>',
));
