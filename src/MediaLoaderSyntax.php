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

		$version = file_get_contents("https://raw.githubusercontent.com/FunPL/MediaWiki-MediaLoader/master/version.txt");

		if(isset($version)){
			if($version == "0.4.1"){
				$update = "";
			}
			else{
				$update = "<b>There is a new version of MediaLoader available at [https://github.com/FunPL/MediaWiki-MediaLoader/releases/latest GitHub]</b>\n";
			}
		}
		else{
			$update = "";
		}

		# Do stuff
		# ...
		$wikitext = $update.'<h2><nowiki><media></nowiki></h2>
		<h3>Parameters</h3>
		 <nowiki><media>File:example.png</media></nowiki>
		<h4>For all</h4>
		{|class="wikitable"
		|-
		!Parameter!!Description!!Example
		|-
		|load||If used theload feature of the MediaLoader will be activated||<nowiki><media load>File:example.png</media></nowiki>
		|-
		|name||(load required) Name of the file to be shown||<nowiki><media load name="example file">File:example.png</media></nowiki><br>Results in: Load example file
		|-
		|group||(load required) Load group||<nowiki><media group="example/pictures">File:example.png</media></nowiki>
		|}
		<h4>Image</h4>
		{|class="wikitable"
		|-
		!Parameter!!Description!!Example
		|-
		|args||Picture arguments||<nowiki><media args="300px">File:example.png</media></nowiki><br><nowiki><media args="thumb">File:example.png</media></nowiki>
		|}
		<h4>Audio/Video</h4>
		{|class="wikitable"
		|-
		!Parameter!!Description!!Example
		|-
		|volume||Volume||<nowiki><media volume="0.1">File:example.mp3</media></nowiki>
		|-
		|loop||Loop||<nowiki><media loop>File:example.mp3</media></nowiki>
		|-
		|width/height||Width/Height of the video file||<nowiki><media width="1000" height="400">File:example.mp4</media></nowiki>
		|-
		|autoplay||May not work without load due to browser rules||<nowiki><media autoplay>File:example.mp4</media></nowiki>
		|}
		<h2><nowiki><mediagroup></nowiki></h2>
		<h3>Parameters</h3>
		 <nowiki><mediagroup>group/subgroup</mediagroup></nowiki>
		<h4>For all</h4>
		{|class="wikitable"
		|-
		!Parameter!!Description!!Example
		|-
		|name||Name to be shown||<nowiki><mediagroup name="example">group/subgroup</mediagroup></nowiki><br>Results in: Load all example files
		|}
		';
		$output->setPageTitle("Media Loader Syntax");
		$output->addWikiText( $wikitext );
	}
}
?>