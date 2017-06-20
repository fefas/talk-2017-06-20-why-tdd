<?php

namespace TalkWhyTdd\User\Model;

use InvalidArgumentException;

class Username
{
    public function __construct(string $username)
    {
        if (false === $this->isFormatValid($username)) {
            throw new InvalidArgumentException('Invalid username provided');
        }
    }

    private function isFormatValid(string $username): bool
    {
        return ctype_alnum($username);
    }
}
