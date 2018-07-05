<?php
function modulo($int, $n)
{
    $mod = $int;

    if ($mod >= 0)
    {
        while($mod >= $n)
            $mod -= $n;
    }
    else
    {
        while($mod  < -$n)
            $mod += $n;
        $mod += $n;
    }
    return ($mod);
}

function inv_modulo($a, $n)
{
    for ($i = 2; $i <= $n; $i++)
    {
        if (modulo(($i * $a), $n) == 1)
            return $i;
    }
}

function pgcd($a, $b)
{
    while($a > 1)
    {
        $c = modulo($a, $b);

        if($c == 0)
        break;

        $a = $b;
        $b = $c;
    }
    return $b;
}





?>