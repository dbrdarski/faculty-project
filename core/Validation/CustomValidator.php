<?php

namespace Core\Validation;

class CustomValidator
{
	private static $methods = [
		'alpha' => "/^[a-zA-Z]*$/",
		'alphanum' => "/^[a-zA-Z0-9_]*$/",
		'num' => "/^[0-9]*$/",
		'email' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'
		// 'minlength' => function($min){
		// 	return $min <= $this->input;
		// },
		// 'maxlength' => function($max){
		// 	return $max >= $this->input;
		// }
	];
	private static $messages = [
		'alpha' => 'Only letters are allowed',
		'num' => 'Only number are allowed',
		'alpha' =>'Only letters and numbers are allowed',
		'email' => 'Not a valid email address',
		'minlength' => 'Minimum of %d characters are allowed',
		'maxnlength' => 'Maximum of %d characters are allowed'
	];

	function __construct($args)
	{
		$this->patterns = [$args];
	}

   	public function __call($name, $arguments)
    {
        $this->patterns[] = func_get_args();
        return $this;
    }

   	public static function __callStatic($name, $args)
    {   
    	$v = new self(func_get_args());
    	return $v;
    }

    public function validate($input)
    {
    	$this->input = $input;
    	foreach ($this->patterns as $args){
    		$name = array_shift($args);
			$pattern = self::$methods[$name];
			$v = is_callable($pattern) ? call_user_func_array($pattern, $args) : preg_match($pattern, $input);
	    	if ($v == false) {
	    		return new CustomValidationError(vsprintf(self::$messages[$name], $args));
	    	}	    	
    	}
    	return $this;
    }

    public function isValid()
    {
    	return true;
    }
}