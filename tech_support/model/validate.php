<?php
class Validate {
    private $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    public function getFields() {
        return $this->fields;
    }

    public function text($name, $value,
            $required = true, $min = 1, $max = 255) {

        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('Too short.');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('Too long.');
        } else {
            $field->clearErrorMessage();
        }
    }

    public function code($name, $value, $required = true){
        $field = $this->fields->getField($name);

        $this->text($name, $value, $required, 1, 10);
        if ($field->hasError()) {
            return;
        } else {
            $pattern = '/^\b[A-Z]+[[:digit:]]{2}\b$/';
            $message = 'Invalid Product Code format. (Ex: UPPERCASE##)';
            $this->pattern($name, $value, $pattern, $message, $required);
        }

    }

    public function pattern($name, $value, $pattern, $message,
            $required = true) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        $match = preg_match($pattern, $value);
        if ($match === false) {
            $field->setErrorMessage('Error testing field.');
        } else if ( $match != 1 ) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }

    public function number($name, $value, $required = true) {
        $field = $this->fields->getField($name);
	
		if ($required && empty($value)) {
	    	$field->setErrorMessage('Required.');
		} else {
           $pattern = '/^[[:digit:]]/';
           $message = 'Invalid format. Please enter a number.';
           $this->pattern($name, $value, $pattern, $message, $required);
	 	}
    }

    public function date($name, $value, $required = true){
    	$field = $this->fields->getField($name);
	
		if ($required && empty($value)) {
	    	$field->setErrorMessage('Required.');
		} else {
           $pattern = '/^[[:digit:]]{4}-(0?[1-9]|1[0-2])-(0?[1-9]|[12][[:digit:]]|3[01])$/';
           $message = 'Invalid format. Use "yyyy-mm-dd" format';
           $this->pattern($name, $value, $pattern, $message, $required);
	 	}
    }
}
?>
