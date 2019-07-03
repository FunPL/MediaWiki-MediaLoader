<?php
class SpecialMediaLoaderSyntax extends SpecialPage {
	function __construct() {
		parent::__construct( 'MediaLoaderSyntax' );
	}

	function execute( $par ) {
		$request = $this->getRequest();
		$output = $this->getOutput();
		$this->setHeaders();

		# Get request data from, e.g.
		$param = $request->getText( 'param' );

		# Do stuff
		# ...
		$wikitext = ' <nowiki><media>File:example.png</media></nowiki>

		<h2>Parameters</h2>
		
		<h3>For all</h3>
		{| class="wikitable"
		|-
		! Parameter !! Description !! Example
		|-
		| load || If used the load feature of the Media Loader will be activated || <nowiki><media load>File:example.png</media></nowiki>
		|-
		| name || (load required) Name of the file to be shown || <nowiki><media load name="example file">File:example.png</media></nowiki><br>Results in: Load example file
		|-
		| group || (load required) Load group || <nowiki><media group="example files">File:example.png</media></nowiki>
		|}
		<h3>Image</h3>
		{| class="wikitable"
		|-
		! Parameter !! Description !! Example
		|-
		| args || Picture arguments || <nowiki><media args="300px">File:example.png</media></nowiki><br><nowiki><media args="thumb">File:example.png</media></nowiki>
		|}
		<h3>Audio/Video</h3>
		{| class="wikitable"
		|-
		! Parameter !! Description !! Example
		|-
		| volume || Volume || <nowiki><media volume="0.1">File:example.mp3</media></nowiki>
		|-
		| loop || Loop || <nowiki><media loop>File:example.mp3</media></nowiki>
		|-
		| width/height || Width/Height of the video file || <nowiki><media width="1000" height="400">File:example.mp4</media></nowiki> 
		|}
		';
		$output->setPageTitle("Media Loader Syntax");
		$output->addWikiText( $wikitext );
	}
}
?>