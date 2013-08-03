<?php
/**
 *
 * Copyright 2007 Michael Cochrane <code@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Michael Cochrane <code@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 */

/* jplayer  filter */
Jojo::addFilter('output', 'jplayer', 'jojo_jplayer');

/* add jplayer javascript to head */
Jojo::addHook('foot', 'foot', 'jojo_jplayer');


/* add a new field type */
$_provides['fieldTypes'] = array('musicupload' => 'MP3 Upload');

$_options[] = array(
    'id'          => 'jplayer_volumecontrol',
    'category'    => 'jPlayer',
    'label'       => 'Volume Control',
    'description' => 'Show a volume control slider with the player',
    'type'        => 'radio',
    'default'     => 'no',
    'options'     => 'yes,no',
    'plugin'      => 'jojo_jplayer'
);

$_options[] = array(
    'id'          => 'jplayer_autoplay',
    'category'    => 'jPlayer',
    'label'       => 'Autoplay',
    'description' => 'Autoplay tracks on page load.',
    'type'        => 'radio',
    'default'     => 'no',
    'options'     => 'yes,no',
    'plugin'      => 'jojo_jplayer'
);

$_options[] = array(
    'id'          => 'jplayer_download',
    'category'    => 'jPlayer',
    'label'       => 'Download',
    'description' => 'Show download button.',
    'type'        => 'radio',
    'default'     => 'no',
    'options'     => 'yes,no',
    'plugin'      => 'jojo_jplayer'
);

$_options[] = array(
    'id'          => 'jplayer_loop',
    'category'    => 'jPlayer',
    'label'       => 'Loop',
    'description' => 'Loop tracks.',
    'type'        => 'radio',
    'default'     => 'no',
    'options'     => 'yes,no',
    'plugin'      => 'jojo_jplayer'
);
