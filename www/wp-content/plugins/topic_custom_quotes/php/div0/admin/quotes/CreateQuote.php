<?php

// TODO разобраться с автором
class CreateQuote {
    private $parentPostContent;
    private $quote;

    public function execute($postId){
        $this->quote = new Quote($postId);

        //$post_author_id = get_post_field( 'post_author', $post_id );

        $state = intval( get_post_meta( $postId, Quote::$stateMetaKey, true ) );
        $parentPostId = intval( get_post_meta( $postId, Quote::$parentPostMetaKey, true ) );
        $selectionStart = intval( get_post_meta( $postId, Quote::$selectionStartMetaKey, true ) );
        $selectionLength = intval( get_post_meta( $postId, Quote::$selectionLengthMetaKey, true ) );

        $post_author_id = the_author();

        $my_post = get_post( $postId ); // $id - Post ID
        $post_author_id = $my_post->post_author; // print post author ID


        $this->quote->setParentPostId($parentPostId);
        $this->quote->setSelectionStart($selectionStart);
        $this->quote->setSelectionLength($selectionLength);
        $this->quote->setState($state);

        $this->quote->setAuthor($post_author_id);
        //$this->quote->setAuthor(the_author_meta());


        $this->getParentPostContent();
        $this->setQuoteContent($this->parentPostContent);

        return $this->quote;
    }

    private function getParentPostContent(){
        $content_post = get_post($this->quote->getParentPostId());
        $content = $content_post->post_content;
        $this->parentPostContent = $content;
    }

    private function setQuoteContent($parentPostContent){
        $rest = substr($parentPostContent, $this->quote->getSelectionStart(), $this->quote->getSelectionLength());
        $this->quote->setText($rest);
    }
} 