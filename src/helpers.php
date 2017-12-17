<?php

if (!function_exists('c')) {
    function c($code) {
        return \MantasDone\ShortClosures\ShortClosure::generate($code);
    }
}
