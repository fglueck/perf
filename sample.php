<?php
# https://phpsandbox.io/n/performance-strrpos-vs-strpos-substr-compare-vs-posvs-preg-match-vs-str-contains-op6yr
#error_reporting (0);
require_once('perf.php');

$p = new perf(1000000);

$p->test('strrpos()', function () use ($string) {
    if(strrpos($string, ':'));
});

$p->test('strrpos(+pos)', function () use ($string) {
    if(strrpos($string, ':', -4));
});

$p->test('strpos()', function () use ($string) {
    if(strpos($string, ':'));
});

$p->test('strpos(+pos)', function () use ($string) {
    if(strpos($string, ':', 12));
});

$p->test('substr_compare()', function () use ($string) {
    if(substr_compare($string, ':', -3,1)===1);
});

$len = strlen($string);
$p->test("[x]===':'", function () use ($string, $len) {
    if($len-3>0 and $string[$len-3]===':');
});

$p->test('preg_match', function () use ($string) {
    preg_match('/\d{4}-\d{2}-\d{2}( \d\d:\d\d\:?\d?\d?)?/', $string);
});

$p->report();
