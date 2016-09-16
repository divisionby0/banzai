<?php
// https://www.smashingmagazine.com/2013/12/modifying-admin-post-lists-in-wordpress/
class CustomizeQuotesAdminTable {

    // TODO избавиться от анонимных функций
    public function __construct(){
        $this->updateQuoteTitle();

        $this->addStateTableColumn();
        $this->setStateTableColumnValue();

        $this->removeQuickEditContextMenuButton();
    }

    private function updateQuoteTitle(){
        add_action(
            'admin_head-edit.php', function(){

                // Bring the post type global into scope
                global $post_type;

                // if not quote post type nothing to do
                if( Quote::$postType != $post_type ){
                    return;
                }

                add_filter(
                    'the_title',
                    function($title, $post_id){
                        $quoteCreation = new CreateQuote();
                        $quote = $quoteCreation->execute($post_id);
                        return $quote->getText();
                    },
                    100,
                    2
                );
            }
        );
    }

    private function addStateTableColumn(){
        add_filter('manage_quote_posts_columns', function($defaults){
            $defaults['state'] = 'State';
            return $defaults;
        });
    }

    private function setStateTableColumnValue(){
        add_action( 'manage_quote_posts_custom_column', function($column_name, $post_id){
            if ($column_name == 'state') {
                $quoteStateIndex = intval( get_post_meta( $post_id, 'state', true ) );
                $quoteState = QuoteStates::getInstance()->get($quoteStateIndex);
                echo $quoteState;
            }
        }, 10, 2 );
    }

    private function removeQuickEditContextMenuButton(){
        new RemoveQuickEditContextMenuButton();
    }
}