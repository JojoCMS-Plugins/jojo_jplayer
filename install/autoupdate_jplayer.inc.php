<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2007-2008 Harvey Kane <code@ragepank.com>
 * Copyright 2007-2008 Michael Holt <code@gardyneholt.co.nz>
 * Copyright 2007 Melanie Schulz <mel@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Harvey Kane <code@ragepank.com>
 * @author  Michael Cochrane <code@gardyneholt.co.nz>
 * @author  Melanie Schulz <mel@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

$table = 'mp3';
$o = 1;

$default_td[$table]['td_displayfield']  = 'name';
$default_td[$table]['td_rolloverfield'] = 'displayname';
$default_td[$table]['td_orderbyfields'] = 'name';
$default_td[$table]['td_topsubmit']     = 'yes';
$default_td[$table]['td_deleteoption']  = 'yes';
$default_td[$table]['td_menutype']      = 'list';
$default_td[$table]['td_categoryfield'] = '';
$default_td[$table]['td_categorytable'] = '';
$default_td[$table]['td_help']          = '';

/* ID */
$field = 'mp3id';
$default_fd[$table][$field]['fd_order'] = $o++;
$default_fd[$table][$field]['fd_type']  = 'readonly';
$default_fd[$table][$field]['fd_help']  = 'A unique ID, automatically assigned by the system';
$default_fd[$table][$field]['fd_tabname'] = "Content";

/* Title */
$field = 'name';
$default_fd[$table][$field]['fd_order']    = $o++;
$default_fd[$table][$field]['fd_type']     = 'text';
$default_fd[$table][$field]['fd_required'] = 'yes';
$default_fd[$table][$field]['fd_size']     = '50';
$default_fd[$table][$field]['fd_help']     = 'A short name to use in the filter';
$default_fd[$table][$field]['fd_tabname'] = "Content";


/* Display Name */
$field = 'displayname';
$default_fd[$table][$field]['fd_order']    = $o++;
$default_fd[$table][$field]['fd_name']     = 'Display Name';
$default_fd[$table][$field]['fd_type']     = 'text';
$default_fd[$table][$field]['fd_required'] = 'no';
$default_fd[$table][$field]['fd_size']     = '60';
$default_fd[$table][$field]['fd_help']     = 'The name of the track to show above the player';
$default_fd[$table][$field]['fd_tabname'] = "Content";


// Image Field
$default_fd[$table]['file'] = array(
        'fd_name' => "mp3",
        'fd_type' => "musicupload",
        'fd_help' => "",
        'fd_order' => $o++,
        'fd_mode' => "standard",
        'fd_tabname' => "Content",
        'fd_quickedit' => "yes",
    );

