<?php

if (c::get('MinifyHTML')) {
	// require_once(__DIR__ . DS . 'library' . DS . 'Minify_HTML.php');

	function minifyhtml($buffer) {
		return preg_replace(
			 '/(?>[^\S ]\s*|\s{2,})(?=(?:(?:[^<]++|<(?!\/?(?:textarea|pre)\b))*+)
			 (?:<(?>textarea|pre)\b|\z))/ix', '', $buffer
	 );
	}

	ob_start('minifyhtml');
}
