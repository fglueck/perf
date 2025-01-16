<?php
/**
Author Frank Glück
https://github.com/fglueck/perf
https://github.com/fglueck/PHP-Performance
*/
class perf {
    private array $times = [];
    private float $start = 0.0;
    
    private int   $loops = 1000;
    
    public function __construct(int $loops=1000) {
        $this->loops = $loops;
    }

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
    public function test(string $label, callable $call) {
        $this->start();
        for($i=0;$i<$this->loops;$i++) {
            $call();
        }
        $this->stop($label);
    }
}
