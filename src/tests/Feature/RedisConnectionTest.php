<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RedisConnectionTest extends TestCase
{
    /**
     * Test Redis connection.
     *
     * @return void
     */
    public function testRedisConnection()
    {
        // Attempt to set and get a value in Redis
        Redis::set('test_key', 'test_value');
        $value = Redis::get('test_key');

        // Assert that the value is as expected
        $this->assertEquals('test_value', $value);
    }
}
