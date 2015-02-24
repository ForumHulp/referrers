<?php
/**
*
* @package Referrers
* French translation by Galixte (http://www.galixte.com)
*
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
	'ACP_REFERRERS'	=> 'Journal des référants',

	'ACP_REF_MANAGE'			=> 'Référants',
	'ACP_REF_MANAGE_EXPLAIN'	=> 'Affiche la provenance des visiteurs de votre forum sous forme d’une liste de sites Web et d’adresses URL.<br />Vous pouvez trier par Hôte, par nombre de visites et selon la première et la dernière date de la visite. Une tâche CRON supprimera les enregistrements suivant la date de leur dernière visite et selon si elle est plus ancienne de x jours. La valeur x est paramétrable dans les “Fonctionnalités du forum”.',

	'REF_HOST'	=> 'Hôte',
	'REF_URL'	=> 'Référant',
	'REF_IP'	=> 'Adresse IP',
	'REF_HITS'	=> 'Visites',
	'REF_FIRST'	=> 'Première visite',
	'REF_LAST'	=> 'Dernière visite',

	'LOG_REFERRER_REMOVED'		=> '<strong>Purger les référants</strong><br />» Hôtes (%1$s),  %2$s enregistrements',
	'LOG_REFERRER_REMOVED_ALL'	=> '<strong>Référants purgés</strong>',

	'DELETE_REFERRERS_DAYS'			=> 'Référants',
	'DELETE_REFERRERS_DAYS_EXPLAIN'	=> 'Nombre de jours après lequel la tache CRON supprimera les référants. 0 désactivera cette tache CRON.'
));
