<?php

/**
 * PHP-Erlang erl
 * Сервис блокировок для обработки критических секций
 *
 * @category erl
 * @package  erl
 * @author   Sergey Yastrebov <serg.yastrebov@gmail.com>
 * @link     https://github.com/syastrebov/erl
 */

namespace ErlMutex\Test\Model;
use ErlMutex\Model\ProfilerCrossOrder;

/**
 * Class ProfilerCrossOrderTest
 * @package ErlMutex\Test\Model
 */
class ProfilerCrossOrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ProfilerCrossOrder
     */
    private $profilerCrossOrderModel;

    /**
     *
     */
    public function setUp()
    {
        $this->profilerCrossOrderModel = new ProfilerCrossOrder(__CLASS__);
    }

    /**
     *
     */
    public function tearDown()
    {
        $this->profilerCrossOrderModel = null;
    }

    /**
     * Повторная блокировка модели
     *
     * @expectedException \ErlMutex\Exception\ProfilerException
     */
    public function testAlreadyAcquired()
    {
        $this->profilerCrossOrderModel->acquire();
        $this->profilerCrossOrderModel->acquire();
    }

    /**
     * Разблокировка незаблокированной модели
     *
     * @expectedException \ErlMutex\Exception\ProfilerException
     */
    public function testReleaseNotAcquired()
    {
        $this->profilerCrossOrderModel->release();
    }

    /**
     * Повторное добавление ключа
     *
     * @expectedException \ErlMutex\Exception\ProfilerException
     */
    public function testContainsKeyAlreadyExists()
    {
        $this->profilerCrossOrderModel->addContainKey('A');
        $this->profilerCrossOrderModel->addContainKey('A');
    }
}