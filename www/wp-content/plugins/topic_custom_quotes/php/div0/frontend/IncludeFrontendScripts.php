<?php

class IncludeFrontendScripts {

    private $pluginDir;

    public function __construct(){
        add_action('wp_enqueue_scripts', array($this, 'start'));
    }

    public function start(){
        $this->pluginDir = $this->getPluginDir();
        $this->registerJsScripts();
        $this->enqueueJSScripts();
        $this->addCSS();
    }

    private function getPluginDir(){
        return plugins_url().'/'.Plugin::$name.'/';
    }
    private function registerJsScripts(){
        wp_register_script( 'eventBus', $this->pluginDir.'/js/libs/EventBus.js' );
        wp_register_script( 'htmlElementUtils', $this->pluginDir.'/js/frontend/div0/utils/HtmlElementUtils.js' );
        wp_register_script( 'user', $this->pluginDir.'/js/frontend/div0/user/User.js' );
        wp_register_script( 'userDataParser', $this->pluginDir.'/js/frontend/div0/user/UserDataParser.js' );
        wp_register_script( 'tooltipButton', $this->pluginDir.'/js/frontend/div0/quote/TooltipButton.js' );

        wp_register_script( 'quoteEvent', $this->pluginDir.'/js/frontend/div0/quote/events/QuoteEvent.js' );
        wp_register_script( 'quote', $this->pluginDir.'/js/frontend/div0/quote/Quote.js' );
        wp_register_script( 'getQuoteTextDuplicationId', $this->pluginDir.'/js/frontend/div0/quote/GetQuoteTextDuplicationId.js' );
        wp_register_script( 'saveNote', $this->pluginDir.'/js/frontend/div0/quote/SaveNote.js' );
        wp_register_script( 'saveQuote', $this->pluginDir.'/js/frontend/div0/quote/SaveQuote.js' );
        wp_register_script( 'buildQuote', $this->pluginDir.'/js/frontend/div0/quote/BuildQuote.js' );
        wp_register_script( 'quoteInputView', $this->pluginDir.'/js/frontend/div0/quote/QuoteInputView.js' );
        wp_register_script( 'frontend', $this->pluginDir.'/js/frontend/div0/quote/Frontend.js' );
        wp_register_script( 'applicationInit', $this->pluginDir.'js/frontend/div0/Initor.js' );
    }
    private function enqueueJSScripts(){
        wp_enqueue_script("jquery-ui-core", array('jquery'));
        wp_enqueue_script("jquery-ui-tooltip", array('jquery','jquery-ui-core'));

        wp_enqueue_script( 'quoteEvent' );
        wp_enqueue_script( 'eventBus' );
        wp_enqueue_script( 'htmlElementUtils' );
        wp_enqueue_script( 'user' );
        wp_enqueue_script( 'userDataParser' );
        wp_enqueue_script( 'tooltipButton' );

        wp_enqueue_script( 'quote' );
        wp_enqueue_script( 'getQuoteTextDuplicationId' );
        wp_enqueue_script( 'saveQuote' );
        wp_enqueue_script( 'saveNote' );
        wp_enqueue_script( 'buildQuote' );

        wp_enqueue_script( 'quoteInputView' );
        wp_enqueue_script( 'frontend' );
        wp_enqueue_script( 'applicationInit' );
    }

    private function addCSS(){
        wp_enqueue_style( 'topicCustomQuotesCSS', $this->pluginDir.'css/style.css', false );
    }
} 