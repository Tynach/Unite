<?php

class container
{
	public $content;

	function __construct($content, $whitespace = NULL, $indent = NULL)
	{
		$this->content = $content;
		$this->indent($whitespace, $indent);
	}

	function indent($whitespace, $indent)
	{
		$this->content = str_replace("\n", "\n".str_repeat($indent, $whitespace), $this->content);
		$this->content .= "\n";
	}

	function ob_process($file = NULL, $content = '')
	{
		if ($file) {
			include($file);
		}

		do {
			$content .= ob_get_contents();
		} while (ob_end_clean());

		return $content;
	}
}

class module extends container
{
	function __construct($file, $whitespace = NULL, $indent = NULL)
	{
		$this->file = $file;
		ob_start();
		$content = $this->ob_process($file);

		parent::__construct($content, $whitespace, $indent);
	}
}

class page extends container
{
	public $title;
	private $template;

	function __construct($template)
	{
		$this->template = $template;
		ob_start();
	}

	function new_module($name, $file, $whitespace = NULL, $indent = NULL)
	{
		$this->$name = new module($file, $whitespace, $indent);
	}

	function indent($whitespace, $indent)
	{
		$this->content = $this->ob_process();
		parent::indent($whitespace, $indent);
	}

	function __destruct()
	{
		header('Content-type: text/html; charset=utf-8');
		include($this->template);
	}
}

?>