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
 * @package jojo_core
 */

///////////////////////////////FILEUPLOADFIELD///////////////////////////////
class Jojo_Field_musicupload extends Jojo_Field
{
    var $fd_size;
    var $error;

    function __construct($fielddata = array())
    {
        parent::__construct($fielddata);
        $this->fd_maxvalue   = 10000000;
        $this->thumbsize     = 200; //pixels - this should be defined in the DB rather than hard-coded here
        $this->viewthumbsize = 350;
    }

    function checkvalue()
    {
        if ( ($this->fd_required == 'yes') and ($this->isblank()) ) {
            $this->error = 'Required field';
        }
        if ( (!$this->isblank()) && (!file_exists(_DOWNLOADDIR.'/mp3s/'.$this->value)) ) {
            $this->error = 'The file is missing from the upload directory';
        }
        if (!empty($this->value) && Jojo::getFileExtension($this->value)!='mp3') {
                $this->error = 'This file isn\'t an mp3';
        }

        return empty($this->error) ? true : false;
    }

    function displayedit()
    {
        $retval = '';
        $readonly = ($this->fd_readonly) ? ' readonly="readonly"' : '';
        if (!$this->isblank()) {
            /* Make sure the file exists */
            if (file_exists(_DOWNLOADDIR."/mp3s/".$this->value)) {
                $filesize = filesize(_DOWNLOADDIR.'/mp3s/'.$this->value);
                $filetype = Jojo::getFileExtension($this->value);
                $filelogo = 'images/cms/filetypes/default.gif';

                $retval = '<span title="'. Jojo::roundBytes($filesize).'"><a href="'._SITEURL.'/downloads/mp3s/'.$this->value.'" target="_BLANK"><img src="'.$filelogo.'" border="0" align="absmiddle" /> '.$this->value.'</a></span><a href="" title="Delete File" onclick="$(\'input[@name=fm_'.$this->fd_field.'_delete]\').val(\'delete\'); alert(\'This image will be deleted when the record is saved\');return false;"><img src="images/cms/delete.gif" border="0" align="absmiddle" /></a><br />';

            } else { //the database says there should be a file, but there isn't
                $this->error = "The file is missing from the upload directory"; //this should already be set by now
            }
        }

        $class = ($this->error != "") ? ' class="error"' : '';
        $retval .= '<input type="hidden" name="fm_'.$this->fd_field."\" value=\"".$this->value."\" /><input type=\"hidden\" name=\"fm_".$this->fd_field."_delete\" value=\"\" />";
        $retval .= '<div style="color: #999">'.$this->value.'</div>';
        $retval .= '<input type="hidden" name="MAX_FILE_SIZE" value="'.$this->fd_maxvalue.'" />'."\n".'<input'.$class.' type="file" name="fm_FILE_'.$this->fd_field.'" id="fm_FILE_'.$this->fd_field.'"  size="'.$this->fd_size.'" value=""'.$readonly.' onchange="fullsave=true;" title="'.htmlentities($this->fd_help).'" />';

        return $retval;
    }


    function displayview()
    {
        $retval = '';
        if (!$this->isblank()) {
            /* Make sure the file exists */
            if (file_exists(_DOWNLOADDIR.'/mp3s/'.$this->value)) {
                $filesize = filesize(_DOWNLOADDIR.'/mp3s/'.$this->value);
                $filetype = strtolower(Jojo::getfileextension($this->value));
                /* display logo image (dependent on file extension) if one exists, otherwise use the default (txt) */
                if (file_exists(_BASEPLUGINDIR . '/jojo_core/images/cms/filetypes/' . $filetype . '.gif')) {
                    $filelogo = 'images/cms/filetypes/' . $filetype . '.gif';
                } else {
                    $filelogo = 'images/cms/filetypes/default.gif';
                }
                $retval = '<span title="' . Jojo::roundBytes($filesize)."\"><a href=\""._SITEURL."/downloads/mp3s/".$this->value."\" target=\"_BLANK\"><img src=\"".$filelogo."\" border=\"0\" align=\"absmiddle\"> " . $this->value . "</a></span><br>";

            } else { //the database says there should be a file, but there isn't
                $this->error = 'The file is missing from the upload directory'; //this should already be set by now
            }
        }

        if ($this->error != '') {$class = ' class="error"';}

        return $retval;
    }

    function getfilesize()
    {
        $filesize = 0;
        if (file_exists(_DOWNLOADDIR . '/mp3s/' . $this->value)) {
            $filesize = filesize(_DOWNLOADDIR . '/mp3s/' . $this->value);
        }
        return Jojo::roundBytes($filesize);
    }

    //TODO: Add error checking to this..
    function getrelativeurl()
    {
        return 'downloads/mp3s/' . $this->value;
    }

    //TODO: Add error checking to this..
    function getabsoluteurl()
    {
        return _SITEURL . '/downloads/mp3s/' . $this->value;
    }

    function setvalue($newvalue)
    {
        /* delete the file if the _delete field has been set */
        if (!empty($_POST['fm_'.$this->fd_field.'_delete'])) {
            return $this->deletefile();
        }

        /* ensure we have data to work with */
        if (!isset($_FILES["fm_FILE_".$this->fd_field])) return false;

        /* set some variables for convenience */
        $filename = str_replace(array('?','&',"'",',','[',']'), '', stripslashes($_FILES["fm_FILE_".$this->fd_field]['name']));
        $tmpfilename = $_FILES["fm_FILE_".$this->fd_field]['tmp_name'];

        $this->value = $newvalue;

        /* Check error codes */
        switch ($_FILES['fm_FILE_'.$this->fd_field]['error']) {
            case UPLOAD_ERR_INI_SIZE: //1
                $this->error = 'The uploaded file exceeds the maximum size allowed ('.$this->fd_maxvalue.')';
                break;
            case UPLOAD_ERR_FORM_SIZE: //2
                $this->error = 'The uploaded file exceeds the maximum size allowed in PHP.INI';
                break;
            case UPLOAD_ERR_PARTIAL: //3
                $this->error = 'The file has only been partially uploaded. There may have been an error in transfer, or the server may be having technical problems.';
                break;

            case UPLOAD_ERR_NO_FILE: //4 - this is only a problem if it's a required field
                //remember, a required field only needs to be set the first time, perhaps its better to check this somewhere else
                break;

            case 6: // UPLOAD_ERR_NO_TMP_DIR - for some odd reason the constant wont work
                $this->error = 'There is no temporary folder on the server - please contact the webmaster ('._WEBMASTERADDRESS.')';
                break;

            case UPLOAD_ERR_OK: //0
                /* check for empty file */
                if($_FILES['fm_FILE_'.$this->fd_field]['size'] == 0) {
                    $this->error = 'The uploaded file is empty.';
                    return false;
                }

                /* ensure file is uploaded correctly */
                if (!is_uploaded_file($tmpfilename)) {
                    /* improve this code when you have time - will work, but needs fleshing out */
                    $this->error = 'Possible hacking attempt. Script will now halt.';
                    die($this->error);
                }

                /* All appears good, so prepare to move file to final resting place */
                $destination = _DOWNLOADDIR."/mp3s/".basename($filename);

                /* create the folder if it does not already exist */
                Jojo::RecursiveMkdir(dirname($destination));

                /* Ensure file does not already exist on server, rename if it does */
                $i=1;
                $newname = '';
                while (file_exists($destination)){
                    $i++;
                    $newname = $i."_".$filename;
                    $destination = _DOWNLOADDIR."/mp3s/".$newname;
                }

                /* move to final location */
                if (move_uploaded_file($tmpfilename, $destination)) {
                    $message = "Upload successful";
                    $this->value =  Jojo::either($newname, $filename);
                } else {
                    $this->error = "Possible hacking attempt. Script will now halt.";
                    die($this->error);
                }
                break;
            default:
                /* this code shouldn't execute - 0 should be the default */
                $this->error = 'An unknown error occurred - please contact the webmaster ('._WEBMASTERADDRESS.')';
        }
        return true;
    }

    function deletefile()
    {
        /* Make sure there is a file set (ie cant delete empty variable) */
        if ($this->isblank()) {
            $this->error = "There is no file to delete."; //TODO: come up with a decent error message
            return false;
        }

        /* check file exists */
        if (!file_exists(_DOWNLOADDIR.'/mp3s/'.$this->value)) {
            $this->error = "The file does not exist on the server. It may have already been deleted.";
            return false;
        }

        /* Check it's a file, not a directory (previous check will return true if a directory exists of same name) */
        if (!is_file(_DOWNLOADDIR."/mp3s/".$this->value)) {
            $this->error = "The file specified is not a file (it may be a directory, or may not exist).";
            return false;
        }

        /* delete the file */
        if (!unlink(_DOWNLOADDIR.'/mp3s/'.$this->value)) {
            $this->error = "Unable to delete the specified file. The file permissions may not be set correctly.";
            return false;
        }

        /* check file exists again (it shouldn't because we just deleted it) */
        if (file_exists(_DOWNLOADDIR.'/mp3s/'.$this->value)) {
            $this->error = "The file still exists on the server. It may not have been deleted properly.";
            return false;
        }

        /* clear field in database to reflect deleted file */
        if ($this->table->getRecordID() != 0) {
            $query = sprintf("UPDATE {%s} SET `%s` = '' WHERE `%s` = ? LIMIT 1",
                                $this->fd_table,
                                $this->fd_field,
                                $this->table->getOption('primarykey')
                            );
            Jojo::updateQuery($query, array($this->table->getRecordID()));
        }
        $this->value = '';

        /* file is gone */
        return true;
    }

    /* delete the file when the database record is deleted */
    function ondelete()
    {
        $this->deletefile();
        return true;
    }
}