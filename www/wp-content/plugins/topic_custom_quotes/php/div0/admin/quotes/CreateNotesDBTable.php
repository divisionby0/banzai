<?php

class CreateNotesDBTable {
    public function __construct(){
        global $wpdb;
        global $quotes_db_version;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'custom_quotes_notes';

        $tableExists = $wpdb->get_var("show tables like '$table_name'") == $table_name;

        if(!$tableExists) {
            $sql = "CREATE TABLE " . $table_name . " (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  note text NOT NULL,
	  author int NOT NULL,
	  authorName text NOT NULL,
	  quote int NOT NULL,
	  state int(11) NOT NULL DEFAULT '0',
	  UNIQUE KEY id (id)
	);";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);

            add_option("quotes_db_version", $quotes_db_version);
        }
    }
} 