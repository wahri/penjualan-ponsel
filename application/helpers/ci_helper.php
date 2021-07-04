<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//Untuk format number indonesia

//URL
function url_web($link)
    {
        $CI =& get_instance();
        $user = $CI->uri->segment(1);

        $root = "http://" . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

        return $root . $link;

    }