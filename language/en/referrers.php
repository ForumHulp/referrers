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
	'ACP_REF_MANAGE_EXPLAIN'	=> 'Display a list of websites and url\'s where visitors came from to your board.<br />You can sort on host, visits and first and last visit date.',

	'REF_HOST'	=> 'Host',
	'REF_URL'	=> 'Referrer',
	'REF_IP'	=> 'IP address',
	'REF_HITS'	=> 'Visits',
	'REF_FIRST'	=> 'First visit',
	'REF_LAST'	=> 'Latest visit',

	'LOG_REFERRER_REMOVED'		=> '<strong>Removed referrer</strong><br />» %s records',
	'LOG_REFERRER_REMOVED_ALL'	=> '<strong>Purged referrers</strong>',

	'DELETE_REFERRERS_DAYS'			=> 'Referers',
	'DELETE_REFERRERS_DAYS_EXPLAIN'	=> 'Days before cron wil delete referrers. 0 will disable this cron.'
));