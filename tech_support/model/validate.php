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

    public function productCode($name, $value, $required = true){
        $field = $this->fields->getField($name);

        $this->text($name, $value, $required, 1, 10);
        if ($field->hasError()) {
            return;
        } else {
            $pattern = '/^\b[A-Z]+[[:digit:]]{2}\b$/';
            $message = 'Use "UPPERCASE##" format. (Ex: TEST20)';
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

    public function phone($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Call the pattern method to validate a phone number
        $pattern = '/^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/';
        $message = 'Invalid phone number. Use ###-###-#### format.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    public function email($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) { return; }

        // Split email address on @ sign and check parts
        $parts = explode('@', $value);
        if (count($parts) < 2) {
            $field->setErrorMessage('At sign required.');
            return;
        }
        if (count($parts) > 2) {
            $field->setErrorMessage('Only one at sign allowed.');
            return;
        }
        $local = $parts[0];
        $domain = $parts[1];

        // Check lengths of local and domain parts
        if (strlen($local) > 64) {
            $field->setErrorMessage('Username part too long.');
            return;
        }
        if (strlen($domain) > 255) {
            $field->setErrorMessage('Domain name part too long.');
            return;
        }

        // Patterns for address formatted local part
        $atom = '[[:alnum:]_!#$%&\'*+\/=?^`{|}~-]+';
        $dotatom = '(\.' . $atom . ')*';
        $address = '(^' . $atom . $dotatom . '$)';

        // Patterns for quoted text formatted local part
        $char = '([^\\\\"])';
        $esc  = '(\\\\[\\\\"])';
        $text = '(' . $char . '|' . $esc . ')+';
        $quoted = '(^"' . $text . '"$)';

        // Combined pattern for testing local part
        $localPattern = '/' . $address . '|' . $quoted . '/';

        // Call the pattern method and exit if it yields an error
        $this->pattern($name, $local, $localPattern,
                'Invalid username part.');
        if ($field->hasError()) { return; }

        // Patterns for domain part
        $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
        $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
        $top = '\.[[:alnum:]]{2,6}';
        $domainPattern = '/^' . $hostnames . $top . '$/';

        // Call the pattern method
        $this->pattern($name, $domain, $domainPattern,
                'Invalid domain name part.');
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
           $message = 'Invalid date. Use "yyyy-mm-dd" format.';
           $this->pattern($name, $value, $pattern, $message, $required);
	 	}
    }
}
?>
