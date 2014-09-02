<?php
/**
*
* @package Referrers
* @copyright (c) 2014 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\referrers\migrations;

class install_referrers extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['referrers_version']) && version_compare($this->config['referrers_version'], '3.1.0', '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_schema()
	{
		return array(
			// We have to create our own f1 webtip tables
			'add_tables'	=> array(
				// F1 driver table
				$this->table_prefix . 'referrers'	=> array(
					'COLUMNS'		=> array(
						'ref_id' => array('UINT', null, 'auto_increment'),
						'ref_host' => array('TEXT', ''),
						'ref_url' => array('TEXT', ''),
						'ref_ip' => array('VCHAR:40', ''),
						'ref_hits' => array('UINT', null),
						'ref_first' => array('TIMESTAMP', 0),
						'ref_last' => array('TIMESTAMP', 0),
					),
					'PRIMARY_KEY'	=> 'ref_id',
				)
			)
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables' => array(
				$this->table_prefix . 'referrers'
			)
		);
	}

	public function update_data()
	{
		return array(
			array('config.add', array('referrers_version', '3.1.0')),
			array('config.add', array('delete_referrers_days', 30)),
			array('config.add', array('delete_referrers_gc', 86400)),
			array('config.add', array('delete_referrers_last_gc', 0, 1)),
			array('module.add', array(
				'acp', 'ACP_FORUM_LOGS', array(
					'module_basename'	=> '\forumhulp\referrers\acp\referrers_module',
					'auth'				=> 'ext_forumhulp/referrers && acl_a_viewlogs',
					'modes'				=> array('log'),
				),
			)),
		);
	}
}
