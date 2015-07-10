<?php
/**
*
* @package Referrers
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
	protected $user;
	protected $log;
	protected $db;
	protected $referrers_table;

	/**
	* Constructor.
	*/
	public function __construct($phpbb_root_path, $php_ext, \phpbb\config\config $config, \phpbb\user $user, \phpbb\log\log $log, \phpbb\db\driver\driver_interface $db, $referrers_table)
	{
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->config = $config;
		$this->user = $user;
		$this->log = $log;
		$this->db = $db;
		$this->referrers_table = $referrers_table;
	}
	/**
	* Runs this cron task.
	*
	* @return null
	*/
	public function run()
	{
		$expire_date = time() - ($this->config['delete_referrers_days'] * 86400);

		// get hosts for logs
		$sql = 'SELECT DISTINCT ref_host FROM ' . $this->referrers_table . ' WHERE ref_last < ' . $expire_date;
		$result = $this->db->sql_query($sql);

		$host_list = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$host_list[] = $row['ref_host'];
		}
		$this->db->sql_freeresult($result);

		$sql = 'DELETE FROM ' . $this->referrers_table . ' WHERE ref_last < ' . $expire_date;
		$this->db->sql_query($sql);
		$this->log->add('admin', $this->user->data['user_id'], $this->user->data['session_ip'], 'LOG_REFERRER_REMOVED', false, array(implode(', ', $host_list), (int) $this->db->sql_affectedrows()));

		$this->config->set('referrers_last_gc', time());
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
		return $this->config['referrers_last_gc'] < time() - $this->config['referrers_gc'];
	}
}
