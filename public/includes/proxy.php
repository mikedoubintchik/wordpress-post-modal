<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ($_GET['url']) {
    echo file_get_contents($_GET['url']);
} else {
    echo "We were not able to retrieve this page, please refresh";
}
