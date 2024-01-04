<?php

declare(strict_types=1);

namespace AutoMapper\Tests\Fixtures\Inheritance\Dto;

class FishDto extends AnimalDto
{
    /** @var int<0,10> */
    public int $swimSpeed;
}
