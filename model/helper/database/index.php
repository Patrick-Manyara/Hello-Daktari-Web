<?php

define('DB_PATH', realpath(dirname(__FILE__)) .  '/');

require_once DB_PATH . 'connect_db.php';
require_once DB_PATH . 'count_data_query.php';
require_once DB_PATH . 'delete_query_helper.php';
require_once DB_PATH . 'insert_delete_edit_helper.php';
require_once DB_PATH . 'insert_query_helper.php';
require_once DB_PATH . 'select_data_query_helper.php';
require_once DB_PATH . 'update_query_helper.php';