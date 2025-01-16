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
    public function report(): string {
        asort($this->times, SORT_NUMERIC);
        $bench = current($this->times);
        foreach($this->times as $label => $time) {
            #$time = number_format($time, 5);
            $out[] = sprintf("%0.1f%% %0.5fs %s\n", bcmul(bcdiv(sprintf('%1.30f',$time),sprintf('%1.30f', $bench),10),100, 10), $time, $label);
        }
        return implode("\n", $out);
    }
    public function test(string $label, callable $call) {
        $this->start();
        for($i=0;$i<$this->loops;$i++) {
            $call();
        }
        $this->stop($label);
    }
}
