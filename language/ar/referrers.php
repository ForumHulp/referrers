<?php
/**
*
* @package Referrers
* @copyright (c) 2014 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
* Translated By : Bassel Taha Alhitary - www.alhitary.net
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
	'ACP_REFERRERS'	=> 'سجلات المواقع',

	'ACP_REF_MANAGE'			=> 'روابط إلى موقعك',
	'ACP_REF_MANAGE_EXPLAIN'	=> 'اظهار قائمة بالمواقع والروابط التي جاء منها الزائرين لمنتداك.<br />تستطيع الترتيب بحسب المستضيف , عدد الزيارات , تاريخ أول أو آخر زيارة. سيتم حذف هذه السجلات عند وصول آخر زيارة إلى أكثر من x أيام ( يتم تحديد الايام من خصائص المنتدى ).',

	'REF_HOST'	=> 'المستضيف',
	'REF_URL'	=> 'رابط الموقع',
	'REF_IP'	=> 'عنوان الIP',
	'REF_HITS'	=> 'عدد الزيارات',
	'REF_FIRST'	=> 'أول زيارة',
	'REF_LAST'	=> 'آخر زيارة',

	'LOG_REFERRER_REMOVED'		=> '<strong>حذف سجلات المواقع</strong><br />» مستضيف (%1$s),  %2$s سجلات',
	'LOG_REFERRER_REMOVED_ALL'	=> '<strong>تم حذف سجلات المواقع</strong>',

	'DELETE_REFERRERS_DAYS'			=> 'وقت سجلات المواقع ',
	'DELETE_REFERRERS_DAYS_EXPLAIN'	=> 'عدد الأيام التي سيتم بعدها حذف سجلات المواقع. القيمة صفر يعني تعطيل هذا الخيار.'
));
