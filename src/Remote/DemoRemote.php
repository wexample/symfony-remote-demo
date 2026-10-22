<?php

namespace Wexample\SymfonyRemoteDemo\Remote;

use Wexample\PhpRemote\Class\RemoteStatus;
use Wexample\PhpRemote\Enum\RemoteState;
use Wexample\PhpRemote\Interface\RemoteInterface;

/**
 * A remote answering a fixed state, after an optional delay, so the showcase
 * shows every state of the remotes screen without a real service behind it.
 */
final readonly class DemoRemote implements RemoteInterface
{
    public function __construct(
        private string $key,
        private string $label,
        private RemoteState $state,
        private ?string $message = null,
        private float $delay = 0.0,
    ) {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function checkStatus(): RemoteStatus
    {
        usleep((int) round($this->delay * 1_000_000));

        return new RemoteStatus($this->state, $this->message);
    }
}
