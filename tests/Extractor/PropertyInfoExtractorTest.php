<?php

declare(strict_types=1);

namespace AutoMapper\Tests\Extractor;

use AutoMapper\Exception\InvalidMappingException;
use AutoMapper\MapperMetadata;
use AutoMapper\Tests\AutoMapperBaseTest;
use AutoMapper\Tests\Extractor\Fixtures\ObjectWithPropertiesOfVariousAccessTypes;
use AutoMapper\Tests\Fixtures;
use Symfony\Component\PropertyInfo\Extractor\PhpStanExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractorInterface;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;

/**
 * @author Priyadi Iman Nurcahyo <priyadi@rekalogika.com>
 */
class PropertyInfoExtractorTest extends AutoMapperBaseTest
{
    protected PropertyInfoExtractorInterface $propertyInfoExtractor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->propertyInfoExtractorBootstrap();
    }

    private function propertyInfoExtractorBootstrap(bool $private = true): void
    {
        $flags = ReflectionExtractor::ALLOW_PUBLIC;

        if ($private) {
            $flags |= ReflectionExtractor::ALLOW_PROTECTED | ReflectionExtractor::ALLOW_PRIVATE;
        }

        $reflectionExtractor = new ReflectionExtractor(null, null, null, true, $flags);

        $phpStanExtractor = new PhpStanExtractor();
        $this->propertyInfoExtractor = new PropertyInfoExtractor(
            [$reflectionExtractor],
            [$phpStanExtractor, $reflectionExtractor],
            [$reflectionExtractor],
            [$reflectionExtractor]
        );
    }

    /**
     * @param array<int,Type> $expectation
     * @dataProvider propertyInfoExtractorProvider
     */
    public function testPropertyInfoExtractor(
        string $propertyName,
        ?array $expectation
    ): void {
        $types = $this->propertyInfoExtractor->getTypes(
            ObjectWithPropertiesOfVariousAccessTypes::class,
            $propertyName
        );

        // dump($types);

        $this->assertEquals($types, $expectation);
    }

    public function propertyInfoExtractorProvider(): iterable
    {
        yield 'publicPropertyWithoutGetterAndSetter' => [
            'publicPropertyWithoutGetterAndSetter', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'nullablePropertyWithoutGetterAndSetter' => [
            'nullablePropertyWithoutGetterAndSetter', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'privatePropertyWithoutGetterAndSetter' => [
            'privatePropertyWithoutGetterAndSetter', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'publicPropertyWithGetterAndSetter' => [
            'publicPropertyWithGetterAndSetter', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'privatePropertyWithGetterAndSetter' => [
            'privatePropertyWithGetterAndSetter', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'getterWithoutProperty' => [
            'getterWithoutProperty', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'setterWithoutProperty' => [
            'setterWithoutProperty', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'getterAndSetterWithoutProperty' => [
            'getterAndSetterWithoutProperty', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'getterAndSetterWithDifferentTypes' => [
            'getterAndSetterWithDifferentTypes', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTimeImmutable::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'publicPropertyGetterSetterAllHavingDifferentTypes' => [
            'publicPropertyGetterSetterAllHavingDifferentTypes', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'publicPropertyAndGetterHavingDifferentTypes' => [
            'publicPropertyAndGetterHavingDifferentTypes', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTimeImmutable::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'publicPropertyAndSetterHavingDifferentTypes' => [
            'publicPropertyAndSetterHavingDifferentTypes', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTimeImmutable::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'publicPropertyWithPhpDocSignature' => [
            'publicPropertyWithPhpDocSignature', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];

        yield 'publicPropertyWithDifferentPhpDoc' => [
            'publicPropertyWithDifferentPhpDoc', [
                new Type(
                    builtinType: Type::BUILTIN_TYPE_OBJECT,
                    nullable: false,
                    class: \DateTime::class,
                    collection: false,
                    collectionKeyType: [],
                    collectionValueType: [],
                )
            ]
        ];
    }
}
