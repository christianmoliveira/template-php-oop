<?php

declare(strict_types=1);

namespace App\Support;

class Filter
{
    private static array $sanitization_rules = [];
    private static array $validation_rules = [];

    /**
     * @param array $data
     * @param array $fields
     * @param array $messages
     *
     * @return array
     */
    public static function filter(array $data, array $fields, array $messages = []): array
    {
        foreach ($fields as $field => $rules) {
            if (strpos($rules, '|')) {
                [self::$sanitization_rules[$field], self::$validation_rules[$field]] = explode('|', $rules, 2);
            } else {
                self::$sanitization_rules[$field] = $rules;
            }
        }

        $inputs = Sanitize::sanitize($data, self::$sanitization_rules);
        $errors = Validate::validate($inputs, self::$validation_rules, $messages);

        return [$inputs, $errors];
    }
}
