<?php
/**
*
* @package Referrers
* @copyright (c) 2014 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\referrers\migrations\v31x;
use ext\forumhulp\helper\helper;

/**
 * Migration stage 1: Initial schema
 */
class m1_initial_schema extends \phpbb\db\migration\migration
{
	/**
	 * Assign migration file dependencies for this migration
	 *
	 * @return array Array of migration files
	 * @static
	 * @access public
	 */
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\gold');
	}

	public function update_schema()
	{
		return array(
			// We have to create our own tables
			'add_tables'	=> array(
				$this->table_prefix . 'referrers'	=> array(
					'COLUMNS'		=> array(
						'ref_id' 	=> array('UINT', null, 'auto_increment'),
						'ref_host'	=> array('TEXT', ''),
						'ref_url'	=> array('TEXT', ''),
						'ref_ip'	=> array('VCHAR:40', ''),
						'ref_hits'	=> array('UINT', null),
						'ref_first'	=> array('TIMESTAMP', 0),
						'ref_last'	=> array('TIMESTAMP', 0),
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
}
