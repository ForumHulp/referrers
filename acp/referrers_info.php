<?php
/**
*
* @package Referrers
* @copyright (c) 2014 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\referrers\acp;

class referrers_info
{
	function module()
	{
		return array(
			'filename'	=> 'forumhulp\referrers\acp\referrers_info',
			'title'		=> 'ACP_REFERRERS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'log'	=> array(
					'title'	=> 'ACP_REFERRERS',
					'auth'	=> 'ext_forumhulp/referrers && acl_a_viewlogs',
					'cat'	=> array('ACP_FORUM_LOGS')
				),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}
