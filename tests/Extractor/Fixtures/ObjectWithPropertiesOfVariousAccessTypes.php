<?php

declare(strict_types=1);

namespace AutoMapper\Tests\Extractor\Fixtures;

/**
 * @author Priyadi Iman Nurcahyo <priyadi@rekalogika.com>
 */
final class ObjectWithPropertiesOfVariousAccessTypes
{
    // =========================================================================

    public \DateTime $publicPropertyWithoutGetterAndSetter;

    // =========================================================================

    public ?\DateTime $nullablePublicPropertyWithoutGetterAndSetter;

    // =========================================================================

    private \DateTime $privatePropertyWithoutGetterAndSetter;

    // =========================================================================

    public \DateTime $publicPropertyWithGetterAndSetter;

    public function getPublicPropertyWithGetterAndSetter(): \DateTime
    {
        return $this->publicPropertyWithGetterAndSetter;
    }

    public function setPublicPropertyWithGetterAndSetter(
        \DateTime $publicPropertyWithGetterAndSetter
    ): void {
        $this->publicPropertyWithGetterAndSetter = $publicPropertyWithGetterAndSetter;
    }

    // =========================================================================

    private \DateTime $privatePropertyWithGetterAndSetter;

    public function getPrivatePropertyWithGetterAndSetter(): \DateTime
    {
        return $this->privatePropertyWithGetterAndSetter;
    }

    public function setPrivatePropertyWithGetterAndSetter(
        \DateTime $privatePropertyWithGetterAndSetter
    ): void {
        $this->privatePropertyWithGetterAndSetter = $privatePropertyWithGetterAndSetter;
    }

    // =========================================================================

    // $getterWithoutProperty

    public function getGetterWithoutProperty(): \DateTime
    {
        return new \DateTime();
    }

    // =========================================================================

    // $setterWithoutProperty

    public function setSetterWithoutProperty(\DateTime $setterWithoutProperty): void
    {
    }

    // =========================================================================

    // $getterAndSetterWithoutProperty

    public function getGetterAndSetterWithoutProperty(): \DateTime
    {
        return new \DateTime();
    }

    public function setGetterAndSetterWithoutProperty(\DateTime $getterAndSetterWithoutProperty): void
    {
    }

    // =========================================================================

    // $getterAndSetterWithDifferentTypes

    public function getGetterAndSetterWithDifferentTypes(): \DateTime
    {
        return new \DateTime();
    }

    public function setGetterAndSetterWithDifferentTypes(\DateTimeImmutable $getterAndSetterWithDifferentTypes): void
    {
    }

    // =========================================================================

    public int $publicPropertyGetterSetterAllHavingDifferentTypes;

    public function getPublicPropertyGetterSetterALlHavingDifferentTypes(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }

    public function setPublicPropertyGetterSetterALlHavingDifferentTypes(\DateTime $publicPropertyGetterSetterALlHavingDifferentTypes): void
    {
    }

    // =========================================================================

    public \DateTime $publicPropertyAndGetterHavingDifferentTypes;

    public function getPublicPropertyAndGetterHavingDifferentTypes(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }

    // =========================================================================

    public \DateTime $publicPropertyAndSetterHavingDifferentTypes;

    public function setPublicPropertyAndSetterHavingDifferentTypes(\DateTimeImmutable $publicPropertyAndSetterHavingDifferentTypes): void
    {
    }

    // =========================================================================

    /**
     * @var \DateTime
     */
    public $publicPropertyWithPhpDocSignature;


    // =========================================================================

    /**
     * @var \DateTime
     */
    public \DateTimeInterface $publicPropertyWithDifferentPhpDoc;

}
