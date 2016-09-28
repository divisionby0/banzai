<?php

class InitQuoteAdmin {
    public function __construct(){

        //new CreateDBTable();
        
        add_meta_box( 'edit_quote_meta_box',
            'Quote Details',
            'displayQuoteAdminMetaBox',
            Quote::$postType, 'normal', 'high'
        );
    }
} 