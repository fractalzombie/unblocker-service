<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Infrastructure\Doctrine\Trait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

trait HasIdentifier
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true, updatable: false)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    public function getId(): Uuid
    {
        return $this->id;
    }
}
