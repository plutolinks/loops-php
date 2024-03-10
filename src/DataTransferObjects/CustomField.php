<?php

declare(strict_types=1);

namespace PlutoLinks\Loops\DataTransferObjects;

class CustomField
{
    /**
     * @param 'boolean'|'date'|'number'|'string' $type
     */
    public function __construct(
        public readonly string $key,
        public readonly string $label,
        public readonly string $type,
    ) {
    }

    public static function from(array $attributes): CustomField
    {
        return new CustomField(
            key: $attributes['key'],
            label: $attributes['label'],
            type: $attributes['type']
        );
    }
}
