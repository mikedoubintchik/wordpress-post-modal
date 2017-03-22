<?php

/**
 * Special proxy handler
 *
 *
 * @link       https://allurewebsolutions.com
 * @since      1.0.0
 *
 * @package    WP_Post_Modal
 * @subpackage WP_Post_Modal/public/includes
 */


if (isset($_GET['url'])) {
    echo file_get_contents($_GET['url']);
} else {
    echo "We were not able to retrieve this page, please refresh";
}