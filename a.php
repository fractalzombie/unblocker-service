<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping\Entity;
use UnBlockerService\Infrastructure\Common\Service\Manipulator\TargetManipulator;

require_once './vendor/autoload.php';

$tm = new TargetManipulator();

#[Entity('A')]
class A {}
#[Entity('B')]
class B extends A {}
#[Entity('C')]
class C extends B {}
#[Entity('D')]
class D extends C {}

dd($tm->getInheritanceListOf(new D(), Entity::class));
