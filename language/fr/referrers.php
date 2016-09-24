<?php
/**
*
* Referrers extension for the phpBB Forum Software package.
* French translation by Galixte (http://www.galixte.com)
*
* @copyright (c) 2015 phpBB ForumHulp <http://www.forumhulp.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_REFERRERS'	=> 'Journal des référents',

	'ACP_REF_MANAGE'			=> 'Référents',
	'ACP_REF_MANAGE_EXPLAIN'	=> 'Affiche la provenance des visiteurs de votre forum sous forme d’une liste de sites Web et d’adresses URL.<br />Vous pouvez trier par hôte, par nombre de visites et selon la première et la dernière date de la visite. Une tâche CRON supprimera les enregistrements suivant la date de leur dernière visite et selon si elle est plus ancienne de x jours. La valeur x est paramétrable dans les « Fonctionnalités du forum ».',

	'REF_HOST'	=> 'Hôte',
	'REF_URL'	=> 'Référent',
	'REF_IP'	=> 'Adresse IP',
	'REF_HITS'	=> 'Visites',
	'REF_FIRST'	=> 'Première visite',
	'REF_LAST'	=> 'Dernière visite',

	'LOG_REFERRER_REMOVED'		=> '<strong>Purger les référents</strong><br />» Hôtes (%1$s),  %2$s enregistrements',
	'LOG_REFERRER_REMOVED_ALL'	=> '<strong>Référents purgés</strong>',

	'DELETE_REFERRERS_DAYS'			=> 'Référents',
	'DELETE_REFERRERS_DAYS_EXPLAIN'	=> 'Nombre de jours après lequel la tache CRON supprimera les référents. 0 désactivera cette tache CRON.',
	'FH_HELPER_NOTICE'				=> 'L’extension : « Forumhulp Helper » n’est pas installée !<br />Il est nécessaire de télécharger son archive disponible sur cette page : <a href="https://github.com/ForumHulp/helper" target="_blank">Forumhulp Helper</a>, puis de l’envoyer sur son espace FTP et de l’activer.',
	'REFERRER_NOTICE'				=> '<div class="phpinfo"><p class="entry">Cette extension se trouve dans : %1$s » %2$s » %3$s.<br>Ses paramètres se trouvent dans : %4$s » %5$s » %6$s.</p></div>',
));
