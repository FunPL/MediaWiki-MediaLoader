<?php


function error(String $msg, Parser $parser, PPFrame $frame){
	$syntax = $parser->recursiveTagParse("[[Special:MediaLoaderSyntax|Correct syntax]]", $frame);
	return "MediaLoader Error: $msg $syntax";
}
class MediaLoaderPHP {
	public static function onBeforePageDisplay( OutputPage $out, Skin $skin ) {
		require 'vendor\ivopetkov\html5-dom-document-php\autoload.php';
		$output = $out->getOutput();
		$output->addModules( 'ext.mediaLoader' );
		$output->addModuleStyles('ext.mediaLoader');
		$html = $output->getHTML();
		$dom = new IvoPetkov\HTML5DOMDocument();
		$dom->loadHTML($html);
		$node = $dom->querySelector('#file');
		$node2 = $dom->querySelector('.fullMedia');
		if($node != null && $node2 != null){
			$node2child = $node2->querySelector('.internal');
			if($node2child == null){
				return;
			}
			$allowedtypes = array(
				'ogg' => 'audio',
				'mp3' => 'audio',
				'wav' => 'audio',
				'mp4' => 'video'
			);
			$child = $node->childNodes[0];
			if($child == null){return;}
			$href = $child->getAttribute("href");
			if($href == null){return;}
			$hrefsplit = explode(".", $href);
			$fileext = end($hrefsplit);
			if(!isset($allowedtypes[$fileext])){
				return;
			}
			$filetype = $allowedtypes[$fileext];
			$node->outerHTML = "";
			if($filetype == "audio"){
				$node2child->outerHTML = "<div class='MediaLoaderOuter'>
					<audio class='MediaLoader MediaLoaderAudio' src='$href' controls></audio>
					</div>";
				$readyhtml = $dom->saveHTML($dom->querySelector('body'));
				$output->clearHTML();
				$output->addHTML(substr($readyhtml, 6, strlen($readyhtml)-13));
			}
			if($filetype == "video"){
				$node2child->outerHTML = "<div class='MediaLoaderOuter'>
					<video class='MediaLoader MediaLoaderAudio' src='$href' controls width='500px'></video>
					</div>";
				$readyhtml = $dom->saveHTML($dom->querySelector('body'));
				$output->clearHTML();
				$output->addHTML(substr($readyhtml, 6, strlen($readyhtml)-13));
			}
		}
	}
	
	// Register any render callbacks with the parser
	public static function onParserFirstCallInit( Parser $parser ) {
		// When the parser sees the <sample> tag, it executes renderTagSample (see below)
		$parser->setHook( 'media', [ self::class, 'renderTagMedia' ] );
	}
	
	public static function renderTagMedia( $input, array $args, Parser $parser, PPFrame $frame ) {
		global $wgMediaLoaderLoadText;
		global $wgMediaLoaderUnloadText;
		$allowedtypes = array(
			'ogg' => 'audio',
			'mp3' => 'audio',
			'wav' => 'audio',
			'png' => 'image',
			'jpg' => 'image',
			'gif' => 'image',
			'bmp' => 'image',
			'mp4' => 'video'
		);
		if(substr($input, 0, 5) === "File:"){
			$filename = substr($input, 5);
			$mediaoutput = $parser->recursiveTagParse( "[[Media:".$filename."]]", $frame );
			$dom = new DOMDocument;
			libxml_use_internal_errors(true);
			$dom->loadHTML($mediaoutput);
			libxml_clear_errors();
			$node = $dom->getElementsByTagName('a');
			if(count($node) == 0){
				return error("Not a file!", $parser, $frame);
			}
			$node = $node[0];
			if(!$node->hasAttribute( 'href' )){
				return error("Incorrect file!", $parser, $frame);
			}
			$href = $node->getAttribute( 'href' );
			$class = $node->getAttribute( 'class' );
			if($class == "new"){
				$parsed = $parser->recursiveTagParse("[[File:".$filename."]]", $frame);
				return error("File $parsed does not exist!", $parser, $frame);
			}
			$hrefsplit = explode(".", $href);
			$fileext = end($hrefsplit);
			if(!isset($allowedtypes[$fileext])){
				return error("Unsupported file type <b>$fileext</b>!", $parser, $frame);
			}
			$filetype = $allowedtypes[$fileext];

			if(!isset($args["load"])){
				$load = false;
			}
			else{
				$load = true;
			}

			if(!isset($args["group"])){
				$group = "";
			}
			else{
				$group = $args["group"];
			}

			if(!isset($args["name"])){
				$name = $filename;
			}
			else{
				$name = $args["name"];
			}

			if(!isset($args["volume"])){
				$volume = 1;
			}
			else{
				$volume = $args["volume"];
			}

			if(!isset($args["loop"])){
				$loop = "";
			}
			else{
				$loop = "loop";
			}

			if(!isset($args["args"])){
				$uargs = "";
			}
			else{
				$uargs = str_replace(" ", "|", $args["args"]);
			}

			if($filetype == "image"){
				$readyimage = $parser->recursiveTagParse("[[File:$filename|$uargs]]");
				if(!$load){
					return "<div class='MediaLoaderOuter'>
					<div class='MediaLoader MediaLoaderImage'>$readyimage</div>
					</div>";
				}
				else{
					return "<div class='MediaLoaderOuter'>
					<div class='MediaLoader MediaLoaderInner MediaLoad MediaLoaderID' image='$readyimage' setto='$wgMediaLoaderLoadText$name'>
					<div class='MediaLoadText'>$wgMediaLoaderLoadText$name<br></div>
					<div class='MediaUnloadText'>$wgMediaLoaderUnloadText$name<br></div>
					<div class='MediaLinkText'>$mediaoutput</div>
					</div>
					</div>";
				}
			}
			if($filetype == "audio"){
				if(!$load){
					return "<div class='MediaLoaderOuter'>
					<audio class='MediaLoader MediaLoaderAudio MediaLoaderToSet' src='$href' volume='$volume' controls $loop></audio>
					</div>";
				}
				else{
					return "<div class='MediaLoaderOuter'>
					<div class='MediaLoader MediaLoaderInner MediaLoad MediaLoaderID' src='$href' volume='$volume' $loop>
					<div class='MediaLoadText'>$wgMediaLoaderLoadText$name<br></div>
					<div class='MediaUnloadText'>$wgMediaLoaderUnloadText$name<br></div>
					<div class='MediaLinkText'>$mediaoutput</div>
					</div>";
				}
			}
			if($filetype == "video"){
				if(!$load){
					return "<div class='MediaLoaderOuter'>
					<video class='MediaLoader MediaLoaderVideo MediaLoaderToSet' src='$href' volume='$volume' controls $loop></video>
					</div>";
				}
				else{
					return "<div class='MediaLoaderOuter'>
					<div class='MediaLoader MediaLoaderInner MediaLoad MediaLoaderID' src='$href' volume='$volume' $loop setto='$wgMediaLoaderLoadText$name'>
					<div class='MediaLoadText'>$wgMediaLoaderLoadText$name<br></div>
					<div class='MediaUnloadText'>$wgMediaLoaderUnloadText$name<br></div>
					<div class='MediaLinkText'>$mediaoutput</div>
					</div>";
				}
			}
			return htmlspecialchars($uargs);
		}
		else{
			return error("Not a file!", $parser, $frame);
		}
	}
}

?>