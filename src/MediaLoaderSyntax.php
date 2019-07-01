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
		$wikitext = 'Hello world!';
		$output->setPageTitle("Media Loader Syntax");
		$output->addWikiText( $wikitext );
	}
}
?>