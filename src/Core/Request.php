<?php

namespace App\Core;

use Exception;

class Request
{
    /**
     * @throws Exception
     */
    public static function input(string $name): array
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        throw new Exception("The index {$name} does not exist.");
    }

    public static function all(): array
    {
        return $_POST;
    }

    /**
     * @throws Exception
     */
    public static function only(string|array $only): array
    {
        $fieldsPost = self::all();

        $fieldsPostKeys = array_keys($fieldsPost);

        foreach ($fieldsPostKeys as $index => $value) {
            $onlyField = (is_string($only) ? $only : ($only[$index] ?? null));

            if (isset($fieldsPost[$onlyField])) {
                $arr[$onlyField] = $fieldsPost[$onlyField];
            }
        }

        return $arr ?? throw new Exception("Field {$only} does not exist.");
    }

    public static function except(string|array $except): array
    {
        $fieldsPost = self::all();

        if (is_array($except)) {
            foreach ($except as $index => $value) {
                unset($fieldsPost[$value]);
            }
        }

        if (is_string($except)) {
            unset($fieldsPost[$except]);
        }

        return $fieldsPost;
    }

    /**
     * @throws Exception
     */
    public static function query(string $name): string|int
    {
        if (!isset($_GET[$name])) {
            throw new Exception("The query string {$name} does not exist.");
        }
        return $_GET[$name];
    }
}
