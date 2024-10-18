<?php

declare(strict_types=1);

namespace Pagemachine\Formlog;

final class Json
{
    /**
     * @throws \JsonException if decoding fails
     */
    public static function decode(string $jsonString): array
    {
        return json_decode(
            $jsonString,
            true,
            512,
            \JSON_THROW_ON_ERROR
        );
    }

    /**
     * @throws \JsonException if encoding fails
     */
    public static function encode(mixed $value): string
    {
        return json_encode(
            $value,
            \JSON_THROW_ON_ERROR,
            512
        );
    }

    private function __construct() {}
}
