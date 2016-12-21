<?php

namespace WyriHaximus\React\AsyncInteropLoop;

use Interop\Async\Loop;
use React\EventLoop\LoopInterface;
use React\EventLoop\Timer\TimerInterface;

class ReactAsyncInteropTimer implements TimerInterface
{
    private $timerKey;
    private $interval;
    private $callback;
    private $loop;
    private $data;
    private $isPeriodic;

    public function __construct($timerKey, $interval, callable $callback, LoopInterface $loop, $isPeriodic = false, $data = null)
    {
        $this->timerKey = $timerKey;
        $this->interval = $interval;
        $this->loop = $loop;
        $this->callback = $callback;
        $this->isPeriodic = $isPeriodic;
        $this->data = null;
    }

    public function getLoop()
    {
        return $this->loop;
    }

    public function getInterval()
    {
        return $this->interval;
    }

    public function getCallback()
    {
        return $this->callback;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function isPeriodic()
    {
        return $this->isPeriodic;
    }

    public function isActive()
    {
        return true;
    }

    public function cancel()
    {
        Loop::get()->cancel($this->timerKey);
    }
}