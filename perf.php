<?php

class perf {
    private $times = [];
    private $start = null;

    public function start() {
        $this->start = microtime(true);
    }
    public function stop(string $label) {
        $this->times[$label] = microtime(true) - $this->start;
    }
    public function report() {
        asort($this->times, SORT_NUMERIC);
        $bench = current($this->times);
        foreach($this->times as $label => $time) {
            $time = number_format($time, 5);
            echo sprintf("%s%% %ss %s\n", number_format(bcmul(bcdiv($time,$bench,10),100, 10),1), $time, $label);
        }
    }
}
