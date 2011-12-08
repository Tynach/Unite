<?php

//Modules are little snippets of a page that can be put into templates. If a template loads a module, then every page using that template will have that module as part of the page... For example, if you want every page to have a list of online users at the bottom, this can do that. Note, modules are their own file - though in execution, they're treated the same as your main .php program. So, it is theoretically possible to pass arguments to modules, and allow for the main page to interract with it. I've not tried this, though, so it's not guranteed to work - I'm just saying what I think is theoretically possible.
class module
{
	public $content;
	private $file;
	private $indent;
	private $whitespace;

	function __construct($file, $whitespace = NULL, $indent = NULL)
	{
		$this->file = $file;
		$this->whitespace = $whitespace;
		$this->indent = $indent;
		ob_start();
		if ($this->file != 'this') {
			include($this->file);
			do {
				$this->content .= ob_get_contents();
			} while(ob_end_clean());

			if ($this->whitespace) {
				$this->content = str_replace("\n", "\n".str_repeat($this->indent, $this->whitespace), $this->content);
			}
			$this->content .= "\n";
		}
	}

	function complete()
	{
		if ($this->file == 'this') {
			do {
				$this->content .= ob_get_contents();
			} while(ob_end_clean());

			if ($this->whitespace) {
				$this->content = str_replace("\n", "\n".str_repeat($this->indent, $this->whitespace), $this->content);
			}
			$this->content .= "\n";
		}
	}
}

//This is the main 'page' of the document. It keeps track of some global methods and whatnot - honestly some of this can be abstracted out, but what this allows for is the module and templating setup I have.
//This class, along with the module class, are the backbone of this infrastructure. The page object contains one pre-defined module called 'content' (with the file named 'this'), which holds the output of your actual PHP script that's including this file. It makes use of output buffering, and the instructions in the template file, to display the page how it should be displayed.
//The main parts that could be taken out are the 'back()' function, and the '$noprev' array, which go back one page in the user's history except on those certain pages in the array. So, if you go to the login page, and fail the login system 4 times, then finally get in... It will go back to the page they were on before trying to log in. Yeah, should probably move that.
class page
{
	public $title;
	public $template;

	private $noprev = array('Login', 'Sign Up');

	function __construct($template, $whitespace = NULL, $indent = NULL)
	{
		$this->template = $template;
		$this->new_module('content', 'this', $whitespace, $indent);
	}

	public function new_module($name, $file, $whitespace = NULL, $indent = NULL)
	{
		$this->$name = new module($file, $whitespace, $indent);
	}

	function back()
	{
		header('Location: '.$_SESSION['prev']);
	}

	function __destruct()
	{
		$this->content->complete();

		if (!in_array($this->title, $this->noprev)) {
			$_SESSION['prev'] = $_SERVER['SCRIPT_NAME'];
		}

		header('Content-type: text/html; charset=utf-8');
		include($this->template);
	}
}

?>