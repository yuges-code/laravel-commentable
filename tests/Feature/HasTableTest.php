<?php

namespace Yuges\Commentable\Tests\Feature;

use Yuges\Commentable\Tests\TestCase;
use Yuges\Commentable\Tests\Stubs\Models\User;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
    }
}
