<?php
class SpecialMediaLoaderSyntax extends SpecialPage {
	function __construct() {
		parent::__construct( 'MediaLoaderSyntax' );
	}

	/**
     * Override the parent to set where the special page appears on Special:SpecialPages
     * 'other' is the default. If that's what you want, you do not need to override.
     * Specify 'media' to use the <code>specialpages-group-media</code> system interface message, which translates to 'Media reports and uploads' in English;
     * 
     * @return string
     */
    function getGroupName() {
        return 'medialoader';
    }

	function execute( $par ) {
		$request = $this->getRequest();
		$output = $this->getOutput();
		$this->setHeaders();

		# Do stuff
		# ...
		$wikitext = '<h2><nowiki><media></nowiki></h2>
		<h3>'.wfMessage( 'medialoader-syntax-word-params')->parse().'</h3>
		 <nowiki>'.wfMessage( 'medialoader-syntax-media-example')->parse().'</nowiki>
		<h4>'.wfMessage( 'medialoader-syntax-word-forall')->parse().'</h4>
		{|class="wikitable"
		|-
		!'.wfMessage( 'medialoader-syntax-word-param')->parse().'!!'.wfMessage( 'medialoader-syntax-word-desc')->parse().'!!'.wfMessage( 'medialoader-syntax-word-example')->parse().'
		|-
		|load||'.wfMessage( 'medialoader-syntax-media-all-load-desc')->parse().'||'.wfMessage( 'medialoader-syntax-media-all-load-example')->parse().'
		|-
		|name||'.wfMessage( 'medialoader-syntax-media-all-name-desc')->parse().'||'.wfMessage( 'medialoader-syntax-media-all-name-example')->parse().'
		|-
		|group||'.wfMessage( 'medialoader-syntax-media-all-group-desc')->parse().'||'.wfMessage( 'medialoader-syntax-media-all-group-example')->parse().'
		|}
		<h4>'.wfMessage( 'medialoader-syntax-word-forimage')->parse().'</h4>
		{|class="wikitable"
		|-
		!'.wfMessage( 'medialoader-syntax-word-param')->parse().'!!'.wfMessage( 'medialoader-syntax-word-desc')->parse().'!!'.wfMessage( 'medialoader-syntax-word-example')->parse().'
		|-
		|args||'.wfMessage( 'medialoader-syntax-media-image-args-desc')->parse().'||'.wfMessage( 'medialoader-syntax-media-image-args-example')->parse().'
		|}
		<h4>'.wfMessage( 'medialoader-syntax-word-foraudiovideo')->parse().'</h4>
		{|class="wikitable"
		|-
		!'.wfMessage( 'medialoader-syntax-word-param')->parse().'!!'.wfMessage( 'medialoader-syntax-word-desc')->parse().'!!'.wfMessage( 'medialoader-syntax-word-example')->parse().'
		|-
		|volume||'.wfMessage( 'medialoader-syntax-media-audiovideo-volume-desc')->parse().'||'.wfMessage( 'medialoader-syntax-media-audiovideo-volume-example')->parse().'
		|-
		|loop||'.wfMessage( 'medialoader-syntax-media-audiovideo-loop-desc')->parse().'||'.wfMessage( 'medialoader-syntax-media-audiovideo-loop-example')->parse().'
		|-
		|width/height||'.wfMessage( 'medialoader-syntax-media-audiovideo-widthheight-desc')->parse().'||'.wfMessage( 'medialoader-syntax-media-audiovideo-widthheight-example')->parse().'
		|-
		|autoplay||'.wfMessage( 'medialoader-syntax-media-audiovideo-autoplay-desc')->parse().'||'.wfMessage( 'medialoader-syntax-media-audiovideo-autoplay-example')->parse().'
		|}
		<h2><nowiki><mediagroup></nowiki></h2>
		<h3>'.wfMessage( 'medialoader-syntax-word-params')->parse().'</h3>
		 <nowiki>'.wfMessage( 'medialoader-syntax-mediagroup-example')->parse().'</nowiki>
		<h4>'.wfMessage( 'medialoader-syntax-word-forall')->parse().'</h4>
		{|class="wikitable"
		|-
		!'.wfMessage( 'medialoader-syntax-word-param')->parse().'!!'.wfMessage( 'medialoader-syntax-word-desc')->parse().'!!'.wfMessage( 'medialoader-syntax-word-example')->parse().'
		|-
		|name||'.wfMessage( 'medialoader-syntax-mediagroup-all-name-desc')->parse().'||'.wfMessage( 'medialoader-syntax-mediagroup-all-name-example')->parse().'
		|}
		';
		$output->setPageTitle(wfMessage( 'medialoader-syntax-pagetitle')->parse());
		$output->addWikiText( $wikitext );
	}
}
?>
