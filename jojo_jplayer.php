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

class JOJO_Plugin_jojo_jplayer extends JOJO_Plugin
{
    public static function jplayer($content)
    {
        if (strpos($content, '[[jplayer:') === false && strpos($content, '[[mp3player:') === false) {
            return $content;
        }
        global $smarty;
        if (strpos($content, '[[mp3player:') !== false) {
            $content = str_replace('[[mp3player:', '[[jplayer:', $content);
        }
        $smarty->assign('mp3autoplay', (boolean)(Jojo::getOption('jplayer_autoplay', 'no')=='yes'));
        $smarty->assign('mp3loop', (boolean)(Jojo::getOption('jplayer_loop', 'no')=='yes'));
        $smarty->assign('mp3volumecontrol', (boolean)(Jojo::getOption('jplayer_volumecontrol', 'no')=='yes'));
        $smarty->assign('mp3download', (boolean)(Jojo::getOption('jplayer_download', 'no')=='yes'));
        /* Find all [[jplayer: name]] tags */
        preg_match_all('/\[\[jplayer: ?([^\]]*)\]\]/', $content, $matches);
        foreach($matches[1] as $id => $mp3name) {
            /* Get the url */
            if (strpos($mp3name, '.mp3')) {
                $mp3 = Jojo::selectRow("SELECT * FROM {mp3} WHERE filename = ?", array($mp3name));
                $mp3['file'] = $mp3 ? $mp3['file'] : $mp3name;
            } else {
                $mp3 = Jojo::selectRow("SELECT * FROM {mp3} WHERE name = ?", array($mp3name));
            }
            $mp3['id'] = $id;
            $mp3['file'] = urlencode($mp3['file']);
            $mp3['displayname'] = isset($mp3['displayname']) ? htmlspecialchars($mp3['displayname'], ENT_COMPAT, 'UTF-8', false) : '';
            $smarty->assign('mp3', $mp3);
            /* Get the embed html */
            $html = $smarty->fetch('jojo_jplayer.tpl');
            $content = str_replace($matches[0][$id], $html, $content);
        }
        return $content;
    }

     public static function foot() {
        return '<script type="text/javascript" src="'._SITEURL.'/external/jQuery.jPlayer.2/jquery.jplayer.min.js"></script>'."\n";
    }
}
