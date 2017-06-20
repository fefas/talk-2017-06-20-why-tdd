<?php

namespace TalkWhyTdd\User\Model;

use PHPUnit\Framework\TestCase;

class UsernameTestTest extends TestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid username provided
     * @dataProvider invalidUsernames
     */
    public function exceptionOccursIfFormatIsInvalid($invalidUsername)
    {
        new Username($invalidUsername);
    }

    public function invalidUsernames()
    {
        return [
            ['-fefas'],
            [' fefas'],
            ['fef@s'],
            ['14f&fas'],
            ['14fe_fas'],
        ];
    }
}
