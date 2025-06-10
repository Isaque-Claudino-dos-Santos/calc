<?php

system('clear');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$totalCorrect = 0;
$totalErrors = 0;
$inProcess = true;

$histories = [];

$noRepeatFor = 7;

while ($inProcess) {
    echo PHP_EOL;

    $operators = ['+', '-', '*'];
    $n1 = random_int(0, 9);
    $n2 = random_int(0, 9);
    $operator = $operators[random_int(0, count($operators) - 1)];
    $alreadyQuested = false;
    $lastFiveHistories = array_slice($histories, 0, $noRepeatFor);

    foreach ($lastFiveHistories as $history) {
        if (!key_exists('h1', $history)) {
            continue;
        }

        if ($history['n1'] == $n1 && $history['n2'] == $n2 && $history['operator'] == $operator) {
            $alreadyQuested = true;
            break;
        }
    }

    if ($alreadyQuested) {
        continue;
    }

    if ($operator === '/' && $n2 == 0) {
        continue;
    }

    $expectedResult = match ($operator) {
        '+' => $n1 + $n2,
        '-' => $n1 - $n2,
        '*' => $n1 * $n2,
    };


    foreach ($lastFiveHistories as $history) {
        if(key_exists('result', $history) && $history['result'] == $expectedResult) {
            $alreadyQuested = true;
        }
    }

    if($alreadyQuested) {
        continue;
    }

    $result = readline("$n1 $operator $n2 = ");

    $histories[] = compact('n1', 'operator', 'n2', 'result');

    if ($result == 'end') {
        echo PHP_EOL;
        echo "✅ Total Erros: $totalCorrect";
        echo PHP_EOL;
        echo "❌ Total Erros: $totalErrors";
        echo PHP_EOL;
        break;
    }

    $resultIsCorrect = $result == $expectedResult;

    if ($resultIsCorrect) {
        $totalCorrect++;
        echo "✅ Resposta certa: $n1 $operator $n2 = $expectedResult";
        echo PHP_EOL;
    } else {
        $totalErrors++;
        echo "❌ Resposta errada: $n1 $operator $n2 = $expectedResult";
        echo PHP_EOL;
    }
}

