<!DOCTYPE html>
<html>
<body>

<?php
$data = [
    ['Иванов', 'Математика', 5],
    ['Иванов', 'Математика', 4],
    ['Иванов', 'Математика', 5],
    ['Петров', 'Математика', 5],
    ['Сидоров', 'Физика', 4],
    ['Иванов', 'Физика', 4],
    ['Петров', 'ОБЖ', 4],
];

$sums = [];
$subjects = [];

foreach ($data as $row) {
    $student = $row[0];
    $subject = $row[1];
    $score = $row[2];

    if (!isset($sums[$student])) {
        $sums[$student] = [];
    }

    if (!isset($sums[$student][$subject])) {
        $sums[$student][$subject] = 0;
        $subjects[$subject] = true;
    }

    $sums[$student][$subject] += $score;
}

ksort($subjects);

$numStudents = count($sums);
$numSubjects = count($subjects);
$cellWidth = 100 / ($numSubjects + 1);
$cellHeight = 30;

echo '<table style="border-collapse: collapse; text-align: center; width: 100%;">';
echo '<tr>';
echo '<td style="border: 1px solid black; width: ' . $cellWidth . '%;"></td>'; // Пустая ячейка в левом верхнем углу
foreach ($subjects as $subject => $value) {
    echo '<th style="border: 1px solid black; width: ' . $cellWidth . '%;">' . $subject . '</th>';
}
echo '</tr>';

foreach ($sums as $student => $scores) {
    echo '<tr>';
    echo '<td style="border: 1px solid black; height: ' . $cellHeight . 'px;">' . $student . '</td>';
    foreach ($subjects as $subject => $value) {
        echo '<td style="border: 1px solid black; width: ' . $cellWidth . '%; height: ' . $cellHeight . 'px;">' . ($scores[$subject] ?? '') . '</td>';
    }
    echo '</tr>';
}

echo '</table>';
?>


</body>
</html>