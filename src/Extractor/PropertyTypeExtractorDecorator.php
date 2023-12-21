<?php

declare(strict_types=1);

namespace AutoMapper\Extractor;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;

final readonly class PropertyTypeExtractorDecorator implements PropertyTypeExtractorInterface
{
    public function __construct(
        private PhpDocExtractor $phpDocExtractor,
        private ReflectionExtractor $reflectionExtractor,
    ) {
    }

    public function getTypes(string $class, string $property, array $context = []): ?array
    {
        $phpdocResult = $this->phpDocExtractor
            ->getTypes($class, $property, $context) ?? [];

        $reflectionResult = $this->reflectionExtractor
            ->getTypes($class, $property, $context) ?? [];

        if (
            isset($phpdocResult[0])
            && $phpdocResult[0]->isCollection()
        ) {
            return [...$phpdocResult, ...$reflectionResult];
        }

        return [...$reflectionResult, ...$phpdocResult];
    }
}
