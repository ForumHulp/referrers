<?php
/**
*
* @package Inactive Users
* @copyright (c) 2014 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\referrers\cron\task\core;

/**
* @ignore
*/

class delete_referrers extends \phpbb\cron\task\base
{
	protected $phpbb_root_path;
	protected $php_ext;
	protected $config;
	protected $db;

	/**
	* Constructor.
	*
	* @param string $phpbb_root_path The root path
	* @param string $php_ext The PHP extension
	* @param phpbb_config $config The config
	* @param phpbb_db_driver $db The db connection
	*/
	public function __construct($phpbb_root_path, $php_ext, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db)
	{
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->config = $config;
		$this->db = $db;
	}
	/**
	* Runs this cron task.
	*
	* @return null
	*/
	public function run()
	{
		global $phpbb_container;

		$expire_date = time() - ($this->config['delete_referrers_days'] * 86400);

		// get hosts for logs
		$sql = 'SELECT DISTINCT ref_host FROM ' . $phpbb_container->getParameter('tables.referrers') . ' WHERE ref_last < ' . $expire_date;
		$result = $this->db->sql_query($sql);

		$host_list = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$host_list[] = $row['ref_host'];
		}
		$this->db->sql_freeresult($result);

		$sql = 'DELETE FROM ' . $phpbb_container->getParameter('tables.referrers') . ' WHERE ref_last < ' . $expire_date;
		$this->db->sql_query($sql);
		add_log('admin', 'LOG_REFERRER_REMOVED', implode(', ', $host_list), (int) $this->db->sql_affectedrows());

		$this->config->set('delete_referrers_last_gc', time());
	}

	/**
	* Returns whether this cron task can run, given current board configuration.
	*
	* @return bool
	*/
	public function is_runnable()
	{
		return (bool) $this->config['delete_referrers_days'];
	}

	/**
	* Returns whether this cron task should run now, because enough time
	* has passed since it was last run.
	*
	* @return bool
	*/
	public function should_run()
	{
		return $this->config['delete_referrers_last_gc'] < time() - $this->config['delete_referrers_gc'];
	}
}
