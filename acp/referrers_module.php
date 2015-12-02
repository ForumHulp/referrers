<?php
/**
*
* @package Referrers
* @copyright (c) 2014 ForumHulp.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\referrers\acp;

class referrers_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $db, $config, $phpbb_root_path, $user, $template, $request, $phpbb_extension_manager, $phpbb_container;

		$user->add_lang_ext('forumhulp/referrers', 'referrers');

		$this->referrers_table	= $phpbb_container->getParameter('tables.referrers');
		$this->page_title		= $user->lang['ACP_REFERRERS'];
		$this->tpl_name			= 'acp_referrers';

		$action = $request->variable('action', '');
		switch ($action)
		{
			case 'details':
				$user->add_lang_ext('forumhulp/referrers', 'info_acp_referrers');
				$phpbb_container->get('forumhulp.helper')->detail('forumhulp/referrers');
				$this->tpl_name = 'acp_ext_details';
			break;

			case 'prune':
				$this->tpl_name = 'acp_prune_referrers';
				$this->page_title = 'ACP_REF_PRUNE';
				$this->ref_prune($id, $mode);
			break;

			default:
				$this->tpl_name = 'acp_referrers';
				$this->page_title = 'ACP_REF_MANAGE';
				$this->ref_manage($id, $mode);

			break;
		}
	}

	protected function ref_manage($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request, $phpbb_container;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		// define vars here
		$action		= $request->variable('action', '');
		$ref_id		= $request->variable('id', 0);
		$start		= $request->variable('start', 0);
		$deletemark = $request->variable('delmarked', false, false, \phpbb\request\request_interface::POST);
		$deleteall	= $request->variable('delall', false, false, \phpbb\request\request_interface::POST);
		$mark		= $request->variable('mark', array(0));

		// sort keys
		$sort_key	= $request->variable('sk', 'v');
		$sort_dir	= $request->variable('sd', 'd');

		// form name
		$form_name	= 'acp_referrers';
		add_form_key($form_name);

		// whois (special case)
		if ($action == 'whois')
		{
			include $phpbb_root_path . 'includes/functions_user.' . $phpEx;

			$this->page_title	= 'WHOIS';
			$user->add_lang('acp/users');
			$this->tpl_name		= 'simple_body';

			$ref_ip				= $request->variable('ref_ip', '');
			$domain				= gethostbyaddr($ref_ip);
			$ipwhois			= user_ipwhois($ref_ip);

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $user->lang('IP_WHOIS_FOR', $domain),
				'MESSAGE_TEXT' => nl2br($ipwhois),
			));
			return;
		}

		if ($deletemark || $deleteall)
		{
			if (confirm_box(true))
			{
				$sql_where = '';

				if ($deletemark && sizeof($mark))
				{
					$sql_in = array();
					foreach ($mark as $marked)
					{
						$sql_in[] = $marked;
					}
					$sql_where = ' WHERE ' . $db->sql_in_set('ref_id', $sql_in);
					unset($sql_in, $marked);

					// get hosts for logs
					$sql = 'SELECT ref_host FROM ' . $this->referrers_table . $sql_where;
					$result = $db->sql_query($sql);

					$host_list = array();
					while ($row = $db->sql_fetchrow($result))
					{
						$host_list[] = $row['ref_host'];
					}
					$db->sql_freeresult($result);
				}

				if ($sql_where)
				{
					$sql = 'DELETE FROM ' . $this->referrers_table . $sql_where;
					$db->sql_query($sql);

					add_log('admin', 'LOG_REFERRER_REMOVED', implode(', ', array_unique($host_list)), (int) $db->sql_affectedrows());
				}
				else if ($deleteall)
				{
					// clear table
					switch ($db->get_sql_layer())
					{
						case 'sqlite':
						case 'sqlite3':
							$db->sql_query('DELETE FROM ' . $this->referrers_table);
						break;

						default:
							$db->sql_query('TRUNCATE TABLE ' . $this->referrers_table);
						break;
					}
					add_log('admin', 'LOG_REFERRER_REMOVED_ALL');
				}
			} else
			{
				confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
					'i'			=> $id,
					'start'		=> $start,
					'delmarked'	=> $deletemark,
					'delall'	=> $deleteall,
					'mark'		=> $mark,
					'sk'		=> $sort_key,
					'sd'		=> $sort_dir,
					'mode'		=> $mode,
					'id'		=> $ref_id,
					'action'	=> $action,
				)));
			}
		}

		// sorting
		$sort_by_sql = array('h' => 'ref_host', 'v' => 'ref_hits', 'f' => 'ref_first', 'l' => 'ref_last');

		// define sort sql for use in displaying referrers
		$sql_sort = $sort_by_sql[$sort_key] . ' ' . (($sort_dir == 'd') ? 'DESC' : 'ASC');
		$dateformats = array_keys($user->lang['dateformats']);
		$sql = 'SELECT * FROM ' . $this->referrers_table . ' ORDER BY ' . $sql_sort;
		$result = $db->sql_query_limit($sql, $config['topics_per_page'], $start);

		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('row', array(
				'REF_ID'		=> (int) $row['ref_id'],
				'REF_HOST'		=> $row['ref_host'],
				'REF_URL'		=> $row['ref_url'],
				'REF_IP'		=> $row['ref_ip'],
				'REF_HITS'		=> (int) $row['ref_hits'],
				'REF_FIRST'		=> $user->format_date($row['ref_first'], str_replace(' M ', '-n-', $dateformats[1])),
				'REF_LAST'		=> $user->format_date($row['ref_last'], str_replace(' M ', '-n-', $dateformats[1])),

				'U_WHOIS'		=> $this->u_action . '&amp;action=whois&amp;ref_ip=' . $row['ref_ip'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['ref_id'],
			));
		}
		$db->sql_freeresult($result);

		// used for pagination
		$sql = 'SELECT COUNT(ref_id) AS total_entries FROM ' . $this->referrers_table;
		$result = $db->sql_query($sql);
		$count = (int) $db->sql_fetchfield('total_entries');
		$db->sql_freeresult($result);

		$pagination = $phpbb_container->get('pagination');
		$base_url = $this->u_action . '&amp;sk=' . $sort_key . '&amp;sd=' . $sort_dir;
		$pagination->generate_template_pagination($base_url, 'pagination', 'start', $count, $config['topics_per_page'], $start);

		// send to template
		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'S_SORT_KEY'		=> $sort_key,
			'S_SORT_DIR'		=> $sort_dir,

			'S_REFDEL'			=> $auth->acl_get('a_clearlogs'),
		));
	}
}
