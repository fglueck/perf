<?php
# https://phpsandbox.io/n/performance-strrpos-vs-strpos-substr-compare-vs-posvs-preg-match-vs-str-contains-op6yr

#error_reporting (0);

$string = '2021-02-11 14:28:34';
#$string = 'very long other text and not a timestamp';
#$string = '2';
$len = strlen($string);
$times = 10000000;

require_once('perf.php');

$p = new perf();
$p->start();
for($i=$times;$i;$i--) {
    if(strrpos($string, ':'));
}
$p->stop('strrpos()');

$p->start();
for($i=$times;$i;$i--) {
    if(strrpos($string, ':', -4));
}
$p->stop('strrpos(+pos)');

$p->start();
for($i=$times;$i;$i--) {
    if(strpos($string, ':'));
}
$p->stop('strpos()');

$p->start();
for($i=$times;$i;$i--) {
    if(strpos($string, ':', 12));
}
$p->stop('strpos(+pos)');

$p->start();
for($i=$times;$i;$i--) {
    if(substr_compare($string, ':', -3,1)===1);
}
$p->stop('substr_compare()');

$p->start();
for($i=$times;$i;$i--) {
    if($len-3>0 and $string[$len-3]===':');
}
$p->stop("[x]===':'");

$p->start();
for($i=$times;$i;$i--) {
    preg_match('/\d{4}-\d{2}-\d{2}( \d\d:\d\d\:?\d?\d?)?/', $string);
}
$p->stop("preg_match");

$p->report();
