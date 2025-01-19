<?php

namespace Snippet\Helpers;

class JsonField
{
    static function ensureArray($mixed)
    {
        if (empty($mixed)) {
            return [];
        }

        if (is_array($mixed)) {
            return $mixed;
        }

        return (array)json_decode($mixed, true);
    }

    static function ensureJson($mixed, $flags = JSON_UNESCAPED_UNICODE)
    {
        if (empty($mixed)) {
            return null;
        }

        if (is_string($mixed)) {
            return $mixed;
        }

        return json_encode($mixed, $flags);
    }
}
