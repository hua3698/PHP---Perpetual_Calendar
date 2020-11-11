<!--
 * 目標功能 
1. 連結動畫效果 ok
2. 改變today底色
3. 邊緣修圓角 ok 
4. 節日位置調整
5. 練習RWD效果     -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .box {
            width: 500px;
            margin: auto;
            border-radius: 20px;
        }

        table {
            width: 500px;
            background: #eee;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        table td {
            text-align: center;
            /* padding: 3px; */
            border-radius: 50%;
        }

        .pic {
            width: 500px;
            height: 250px;
            background-image: url("beach.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.8;
            color: #3e62e6;
            text-shadow: 3px 3px 0px #fff;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .weekend {
            color: #f94949;
        }

        .today {
            background: #ffa5a5;
        }

        .th {
            width: 45px;
            height: 45px;
            color: #6ba6e6;
            font-weight: bold;
        }

        .cr {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: translateX(25%);
            user-select: none;
            position: relative;
        }

        .cr:hover {
            background: #ffe79be3;
        }

        .animate {
            animation: arrowA 2s infinite;
            
        }

        .animateB {
            animation: arrowB 2s infinite;
            /* animation-fill-mode: forwards; */
        }

        @keyframes arrowA {
            50% {
                transform: translateX(-5%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        @keyframes arrowB {
            50% {
                transform: translateX(5%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        .hol {
            font-size: 5px;
            position: absolute;
            top: 70%;
            left: 10%;
            color: #9e9e9e;
        }
    </style>
</head>

<body class="alert-warning p-5">
    <?php

    if (isset($_GET['y']) && isset($_GET['m'])) {
        $year = $_GET['y'];
        $month = $_GET['m'];
    } else {
        $year = date("Y");
        $month = date("m");
    }

    if ($month >= 12) {
        $nextYear = $year + 1;
        $nextMonth = 1;
    } else {
        $nextYear = $year;
        $nextMonth = $month + 1;
    }

    if ($month <= 1) {
        //下一年和下一月
        $lastYear = $year - 1;
        $lastMonth = 12;
    } else {
        //下一年和下一月
        $lastYear = $year;
        $lastMonth = $month - 1;
    }

    // $today = date("d", strtotime($year-$month-$_GET['d]))
    $firstDay = "$year-$month-01";

    $monthDay = date("t", strtotime($firstDay));
    // 當月有幾天
    $startDay = date("w", strtotime($firstDay));
    // 當月第一天是星期幾    
    $lastDay = date("w", strtotime("$year-$month-$monthDay"));
    // 當月的最後一天是星期幾    


    // echo $year . "<br>";     // 某年
    // echo $month . "<br>";    // 某月
    // echo "當月有幾天：" . $monthDay . "<br>";
    // echo "某年某月1日：" . $firstDay . "<br>";
    // echo "當月第一天是星期幾：" . $startDay . "<br>";
    ?>

    <div class="container d-flex align-items-center justify-content-around">
        <a href="calendar.php?y=<?= $lastYear ?>&m=<?= $lastMonth ?>" class="animate" style="text-decoration: none;"><< Last Month</a> 
        <div class="box shadow-lg my-5">
                <div class="pic pl-4">
                    <div style="font-size: 6rem;">
                        <?php
                        echo date("d");
                        ?>
                    </div>
                    <div style="font-size: 2.5rem;">
                        <?php echo date("F , Y", strtotime($firstDay)); ?>
                    </div>
                </div>
                <div class="">
                    <table class="">
                        <tr>
                            <td class="th">Sun</td>
                            <td class="th">Mon</td>
                            <td class="th">Tue</td>
                            <td class="th">Wed</td>
                            <td class="th">Thu</td>
                            <td class="th">Fri</td>
                            <td class="th">Sat</td>
                        </tr>
                        <?php
                        $holiday = [
                            '1-1'=>'元旦',
                            '2-28' => '和平紀念日',
                            '3-8'=>'婦女節',
                            '4-1' => '愚人節',
                            '4-4'=>'兒童節',
                            '5-15' => '破蛋日',
                            '9-28' => '教師節',
                            '10-10' => '雙十節',
                            '10-30' => '萬聖節',
                            '11-11' => '光棍節',
                            '12-25' => '聖誕節'
                        ];

                        for ($i = 0; $i < 6; $i++) {
                            echo "<tr>";
                            for ($j = 0; $j < 7; $j++) {
                                echo "<td>";
                                echo "<div class='cr'>";
                                if ($j == 0 || $j == 6) {
                                    echo "<div class='weekend'>";
                                }

                                $date = "";
                                if ($j < $startDay && $i == 0) {
                                    echo  "&nbsp";
                                } else if ((($i * 7) + ($j + 1) - $startDay) > $monthDay) {
                                    // echo  "&nbsp";
                                    break;
                                } else {
                                    $date = (($i * 7) + ($j + 1) - $startDay);
                                }
                                echo  $date;

                                if (!empty($holiday[$month . '-' . $date])) {
                                    echo "<div class='hol'>" . $holiday[$month . '-' . $date] . "</div>";
                                }
                                if ($date == date("d")) {
                                echo "<div class='today bg-dark'></div>";  #adbdf9
                                }
                                echo "</div>";
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
    </div>
    <a href="calendar.php?y=<?= $nextYear ?>&m=<?= $nextMonth ?>" class="animateB" style="text-decoration: none;">Next Month >></a>
    </div>
</body>

</html>