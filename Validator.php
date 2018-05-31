<?php

/**
 * Created by PhpStorm.
 * User: karellen
 * Date: 4/22/17
 * Time: 10:21 AM
 */
class Validator
{
    private $error_message_prefix = 'Invalid values: ';
    private $rules = [];
    private $labels = [];
    private $tips = [];

    public function __construct($full_rules = [])
    {
        // { field_name => pattern }
        $this->rules = array_map(function($field) { return $field['rule']; }, $full_rules);
        // { field_name => label (tip) }
        $this->labels = array_map(function($field) {
                return isset($field['tip']) && $field['tip'] ?
                    $field['title'].' ('.$field['tip'].')' :
                    $field['title'];
            }, $full_rules);
    }

    public function setRules($rules) {
        $this->rules = $rules;
    }

    public function getRules() {
        return $this->rules;
    }

    public function check($fields) {
        return array_filter( $fields, function($field_name) use ($fields) {
            return
                isset($this->getRules()[$field_name]) ?
                !preg_match($this->getRules()[$field_name], $fields[$field_name]) :
                0;
        }, ARRAY_FILTER_USE_KEY );
    }

    public function validate($fields) {
        $incorrect_fields = $this->check($fields);

        return count($incorrect_fields) ?
            $this->error_message_prefix.implode(", ",
                array_intersect_key(
                    $this->labels,
                    $incorrect_fields
                )
            ) :
            null;
    }
}
