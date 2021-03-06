<?php

/**
 * PHP-Erlang erl
 * Сервис блокировок для обработки критических секций
 *
 * @category erl
 * @package  erl
 * @author   Sergey Yastrebov <serg.yastrebov@gmail.com>
 * @link     https://github.com/syastrebov/mutex-php
 */

namespace ErlMutex\Test\Service\Storage;

use ErlMutex\Adapter\Socket;
use ErlMutex\Service\Mutex;
use ErlMutex\Service\Profiler;
use ErlMutex\Service\Storage\ProfilerStorageDummy;

/**
 * Тестирование хранилища для отладки
 *
 * Class ProfilerStorageDummyTest
 * @package Test\Service\Storage
 */
class ProfilerStorageDummyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Мьютекс
     *
     * @var Mutex
     */
    private $mutex;

    /**
     * Закрывать соединение с сервисом после каждого теста
     */
    public function tearDown()
    {
        $this->mutex = null;
    }

    /**
     * Очистка хранилища
     */
    public function testTruncate()
    {
        $this->mutex = new Mutex(new Socket());
        $this->mutex
            ->setProfiler(new Profiler(__FUNCTION__))
            ->getProfiler()
            ->setStorage(ProfilerStorageDummy::getInstance());

        $this->mutex->get('A');
        $this->mutex->acquire();
        $this->mutex->release();

        $storage = ProfilerStorageDummy::getInstance();
        $this->assertGreaterThan(0, count($storage->getList()));

        $storage->truncate();
        $this->assertEquals(0, count($storage->getList()));
    }
}