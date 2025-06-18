<?php
$arr = ["mass", "as", "hero", "superhero"];

usort($arr, function ($a, $b) {
    return strlen($a) > strlen($b);
});

for ($i = 0; $i < count($arr); $i++) {
    for ($j = $i + 1; $j < count($arr); $j++) {
        if (str_contains($arr[$j], $arr[$i])) {
            $r[] = $arr[$i] ?? "";
        }
    }
}
var_dump($r);

?>