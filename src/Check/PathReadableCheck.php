<?php

declare(strict_types = 1);

namespace FiveLab\Component\Diagnostic\Check;

use FiveLab\Component\Diagnostic\Result\Failure;
use FiveLab\Component\Diagnostic\Result\ResultInterface;
use FiveLab\Component\Diagnostic\Result\Success;
use FiveLab\Component\Diagnostic\Result\Warning;

/**
 * Check what the path is readable.
 */
class PathReadableCheck implements CheckInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var bool
     */
    private $strict;

    /**
     * Constructor.
     *
     * @param string $path
     * @param bool   $strict
     */
    public function __construct(string $path, bool $strict = true)
    {
        $this->path = $path;
        $this->strict = $strict;
    }

    /**
     * {@inheritdoc}
     */
    public function check(): ResultInterface
    {
        if (!\file_exists($this->path)) {
            if ($this->strict) {
                return new Failure('The path not exist.');
            }

            return new Warning('The path not exist.');
        }

        $state = \is_file($this->path) ? 'file' : 'directory';

        if (\is_readable($this->path)) {
            return new Success(\sprintf('The %s is readable.', $state));
        }

        return new Failure(\sprintf('The %s is not readable.', $state));
    }

    /**
     * {@inheritdoc}
     */
    public function getExtraParameters(): array
    {
        return [
            'path' => $this->path,
        ];
    }
}