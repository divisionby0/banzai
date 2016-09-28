<?php

class InitQuoteAdmin {
    public function __construct(){

        function my_plugin_menu() {
            add_menu_page( 'Цитаты опции', 'Цитаты', 'edit_posts', 'quotes', 'my_plugin_options', plugin_dir_url(__FILE__) . 'images/icon_wporg.png', 20);
        }

        function my_plugin_options() {
            if ( !current_user_can( 'manage_options' ) )  {
                wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
            }
            $quotesGetter = new GetQuotes();
            $quotes = $quotesGetter->execute();


            var_dump($quotes);

            Logger::logMessage('total quotes: '.sizeof($quotes));

            /*
            echo '<div class="wrap">';
            echo '<p>Here is where the form would go if I actually had options.</p>';
            echo '</div>';
            */
        }

        add_action( 'admin_menu', 'my_plugin_menu' );
        
    }
} 