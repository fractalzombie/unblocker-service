<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Unit\Command\Subnet;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnBlockerService\Command\Subnet\AddSubnetListCommand;
use UnBlockerService\Domain\Common\Service\Manipulator\ClockManipulatorInterface;
use UnBlockerService\Domain\Subnet\Publisher\EventPublisherInterface;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Tests\Helper\TestHelper;

test('Test AddSubnetListCommand', function (array $subnets, string $country, int $expectedCommandStatus, ?\Throwable $expectedException): void {
    $repository = $this->createMock(SubnetRepositoryInterface::class);
    $eventPublisher = $this->createMock(EventPublisherInterface::class);
    $clockManipulator = $this->createMock(ClockManipulatorInterface::class);
    $input = $this->createMock(InputInterface::class);
    $output = $this->createMock(OutputInterface::class);
    $countOfSubnetListWithNotifierEvent = \count($subnets) + 1;

    $expectedException
        ? $repository
            ->expects($this->once())
            ->method('getByStates')
            ->willThrowException($expectedException)
        : $repository
            ->expects($this->once())
            ->method('getByStates')
            ->willReturn($subnets)
    ;

    $eventPublisher
        ->expects($expectedException ? $this->never() : $this->exactly($countOfSubnetListWithNotifierEvent))
        ->method('publish')
    ;

    $clockManipulator
        ->expects($expectedException ? $this->never() : $this->once())
        ->method('nowAsFormatted')
        ->willReturn((new \DateTimeImmutable())->format(\DateTimeInterface::RFC3339))
    ;

    $executedCommandStatus = (new AddSubnetListCommand($repository, $eventPublisher, $clockManipulator))
        ->run($input, $output)
    ;

    expect($executedCommandStatus)->toBe($expectedCommandStatus);
})->with(function () {
    yield 'Test UA subnets fetch from DB success' => [
        'subnets' => TestHelper::getDatabaseSubnetsAsArray(TestHelper::COUNTRY_UA),
        'country' => TestHelper::COUNTRY_UA,
        'expectedCommandStatus' => Command::SUCCESS,
        'expectedException' => null,
    ];

    yield 'Test USA subnets fetch from DB success' => [
        'subnets' => TestHelper::getDatabaseSubnetsAsArray(TestHelper::COUNTRY_USA),
        'country' => TestHelper::COUNTRY_USA,
        'expectedCommandStatus' => Command::SUCCESS,
        'expectedException' => null,
    ];

    yield 'Test USA subnets fetch from DB failure' => [
        'subnets' => TestHelper::getDatabaseSubnetsAsArray(TestHelper::COUNTRY_USA),
        'country' => TestHelper::COUNTRY_USA,
        'expectedCommandStatus' => Command::FAILURE,
        'expectedException' => new EntityNotFoundException(TestHelper::MESSAGE),
    ];
});
