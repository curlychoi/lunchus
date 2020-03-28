<?php

namespace Tests\Unit;

use App\Rules\BackpackrEmail;
use PHPUnit\Framework\TestCase;

class BackpackrEmailRuleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPassRule()
    {
        /** @var BackpackrEmail $backpackrEmailRule */
        $backpackrEmailRule = app(BackpackrEmail::class);
        $this->assertFalse($backpackrEmailRule->passes('', 'curlychoi@gmail.com'));
        $this->assertFalse($backpackrEmailRule->passes('', 'curlychoi@backpackr.com'));
        $this->assertTrue($backpackrEmailRule->passes('', 'curlychoi@backpac.kr'));
        $this->assertTrue($backpackrEmailRule->passes('', '1231.afa@backpac.kr'));

    }
}
