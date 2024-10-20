<?php

declare(strict_types=1);

namespace Pagemachine\Formlog\Rendering;

/*
 * This file is part of the Pagemachine TYPO3 Formlog project.
 */

/**
 * Format arbitrary values as string
 */
final class ValueFormatter
{
    private string $dateTimeFormat = \DateTimeInterface::W3C;

    public function setDateTimeFormat(string $dateTimeFormat): self
    {
        $this->dateTimeFormat = $dateTimeFormat;

        return $this;
    }

    /**
     * @throws \UnexpectedValueException for unsupported types
     */
    public function format($value): string
    {
        if (is_null($value)) {
            return $this->formatNull();
        }

        if (is_scalar($value)) {
            return $this->formatScalar($value);
        }

        if (is_array($value)) {
            return $this->formatArray($value);
        }

        if ($value instanceof \DateTimeInterface) {
            return $this->formatDateTime($value);
        }

        throw new \UnexpectedValueException(
            sprintf('Could not convert value of type "%s" to string', get_debug_type($value)),
            1610097797
        );
    }

    private function formatNull(): string
    {
        return '';
    }

    private function formatScalar($value): string
    {
        return (string)$value;
    }

    private function formatArray(array $value, int $level = 0): string
    {
        $indentation = str_repeat('    ', $level);
        $arrayValues = [];

        foreach ($value as $key => $arrayValue) {
            $separator = ' ';

            if (is_array($arrayValue)) {
                $separator = "\n";
                $arrayValue = $this->formatArray($arrayValue, $level + 1);
            }

            $arrayValues[] = sprintf(
                '%s%s:%s%s',
                $indentation,
                $key,
                $separator,
                $arrayValue
            );
        }

        return implode("\n", $arrayValues);
    }

    private function formatDateTime(\DateTimeInterface $value): string
    {
        return $value->format($this->dateTimeFormat);
    }
}
