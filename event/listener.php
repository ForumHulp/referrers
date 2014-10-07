<?php
/**
*
* @package Referrers
* @copyright (c) 2014 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\referrers\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	protected $config;
	protected $helper;
	protected $user;
	protected $db;
	protected $referrerss_table;
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper    $helper        Controller helper object
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, $referrerss_table, $php_ext)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->user = $user;
		$this->db = $db;
		$this->referrerss_table = $referrerss_table;
		$this->php_ext = $php_ext;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'					=> 'get_ref',
			'core.acp_board_config_edit_add'	=> 'load_config_on_setup',
		);
	}

	public function load_config_on_setup($event)
	{
		if ($event['mode'] == 'features')
		{
			$display_vars = $event['display_vars'];

			$add_config_var['delete_referrers_days'] =
				array(
					'lang' 		=> 'DELETE_REFERRERS_DAYS',
					'validate'	=> 'int',
					'type'		=> 'number:0:99',
					'explain'	=> true
				);
			$display_vars['vars'] = phpbb_insert_config_array($display_vars['vars'], $add_config_var, array('after' =>'allow_quick_reply'));
			$event['display_vars'] = array('title' => $display_vars['title'], 'vars' => $display_vars['vars']);
		}
	}

	/**
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'forumhulp/referrers',
			'lang_set' => 'referrers',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Inspired by Geolim4
	*/
	function get_ref($event)
	{
		$this->load_language_on_setup($event);
		// get the referer
		$ref_url = strtolower($this->user->referer);

		// remove the sid, if the website runs phpbb too !
		if (strpos($ref_url, 'sid=') !== false)
		{
			$ref_url = preg_replace('/(\?)?(&amp;|&)?sid=[a-z0-9]+/', '', $ref_url);
			$ref_url = preg_replace("/$this->php_ext(&amp;|&)+?/", "$this->php_ext?", $ref_url);
		}

		// get the host
		$cur_host = $this->config['server_name'];

		if (!empty($ref_url) && (strpos($ref_url, $cur_host) === false))
		{
			$ref_host = substr($ref_url, strpos($ref_url, '//') + 2);
			if (strpos($ref_host, '/') === false)
			{
				$ref_url .= '/';
			} else
			{
				$ref_host = substr($ref_host, 0, strpos($ref_host, '/'));
			}

			if (substr($ref_host, -1) == '.')
			{
				$ref_host = substr($ref_host, 0, -1);
			}

			$sql = 'SELECT ref_url FROM ' . $this->referrerss_table . ' WHERE ref_url = \'' . $this->db->sql_escape($ref_url) . '\'';
			$result = $this->db->sql_query_limit($sql, 1);
			$found = ($row = $this->db->sql_fetchrow($result));
			$this->db->sql_freeresult($result);

			// get timestamp
			$now = time();

			$fields = array('ref_ip' => $this->user->ip, 'ref_last' => $now);
			if (!$found)
			{
				$fields += array(
					'ref_host' => str_replace('www.', '', $ref_host),
					'ref_url' => $ref_url,
					'ref_hits' => 1,
					'ref_first' => $now,
				);
				$sql = 'INSERT INTO ' . $this->referrerss_table . ' ' . $this->db->sql_build_array('INSERT', $fields);
			} else
			{
				$sql = 'UPDATE ' . $this->referrerss_table . ' SET ref_hits = ref_hits + 1, ' . $this->db->sql_build_array('UPDATE', $fields) . '
						WHERE ref_url = \'' . $this->db->sql_escape($ref_url) . '\'';
			}
			$this->db->sql_query($sql);
		}
	}
}
