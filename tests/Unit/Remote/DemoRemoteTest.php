<?php

namespace Wexample\SymfonyRemoteDemo\Tests\Unit\Remote;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;
use Wexample\SymfonyRemote\Enum\RemoteState;
use Wexample\SymfonyRemoteDemo\Remote\DemoRemote;

class DemoRemoteTest extends TestCase
{
    public function testItAnswersItsFixedStateAfterItsDelay(): void
    {
        $remote = new DemoRemote('demo_slow', 'Slow', RemoteState::Up, 'Late.', 0.2);

        $start = microtime(true);
        $status = $remote->checkStatus();

        $this->assertGreaterThanOrEqual(0.2, microtime(true) - $start);
        $this->assertSame(RemoteState::Up, $status->state);
        $this->assertSame('Late.', $status->message);
    }

    public function testTheShowcaseDeclaresEveryState(): void
    {
        $services = Yaml::parseFile(__DIR__.'/../../../src/Resources/config/services.yaml', Yaml::PARSE_CONSTANT)['services'];

        $states = array_map(
            static fn (array $service): RemoteState => $service['arguments']['$state'],
            array_filter($services, static fn (mixed $service): bool => is_array($service) && isset($service['arguments']['$state']))
        );

        $this->assertEqualsCanonicalizing(
            [RemoteState::Up, RemoteState::Down, RemoteState::Unconfigured, RemoteState::Up],
            array_values($states)
        );
    }
}
