<?php

include_once 'trash-post-type.php';
include_once 'ajax.php';

add_filter( 'comments_open', '__return_true' );