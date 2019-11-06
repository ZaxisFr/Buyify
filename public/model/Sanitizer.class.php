<?php

class Sanitizer {
    static function sanitizeString(string $variable) : string {
        return htmlspecialchars($variable, ENT_QUOTES | ENT_HTML5);
    }

    static function sanitize($variable) {
        foreach ($variable as $key => $value) {
            if (is_array($value)) {
                $variable[$key] = self::sanitize($value);
            } else if (is_string($value)) {
                $variable[$key] = self::sanitizeString($value);
            }
        }

        return $variable;
    }
}
