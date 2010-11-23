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
 * @author  Michael Cochrane <mikec@jojocms.org>
 * @author  Melanie Schulz <mel@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 * @package jojo_gallery3
 */

/* Edit mp3s */
$data = Jojo::selectQuery("SELECT * FROM {page} WHERE pg_url='admin/edit/mp3'");
if (!count($data)) {
    echo "Adding <b>Edit mp3s</b> Page to menu<br />";
    Jojo::insertQuery("INSERT INTO {page} SET pg_title='Edit mp3s', pg_link='Jojo_Plugin_Admin_Edit', pg_url='admin/edit/mp3', pg_parent = ?, pg_order=6", array($_ADMIN_CONTENT_ID));
}

/* Ensure there is a folder for uploading mp3s */
$res = Jojo::RecursiveMkdir(_DOWNLOADDIR . '/mp3s');
if ($res === true) {
    echo "Created folder: " . _DOWNLOADDIR . '/mp3s';
} elseif($res === false) {
    echo 'Could not automatically create ' .  _DOWNLOADDIR . '/mp3s' . 'folder on the server. Please create this folder and assign 777 permissions.';
}

