<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>
        .container {
            width: 500px;
            margin: auto;
        }

        table {
            width: 500px;
            background: #eee;
        }

        table td {
            width: 80px;
            text-align: center;
            padding: 5px;
            border-radius: 50%;
        }

        /* table td:hover {
            background: #ccc;
            color: #fff;
        } */

        .pic {
            width: 500px;
            height: 250px;
            background-image: url("beach.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.8;
            color: #3e62e6;
            text-shadow: 3px 3px 0px #fff;
        }

        .weekend {
            color: #ffa5a5;
        }

        .today {
            background: #ffa5a5;
        }

        .cr {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .cr:hover {
            /* border: 1px solid #ccc; */
            background: #ffe79be3;
        }
    </style>
</head>

<body class="alert-warning p-5">
    <?php
    date_default_timezone_set("Asia/Taipei");

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

    <div class="box">
        <a href="calendar.php?y=<?= $lastYear ?>&m=<?= $lastMonth ?>">
            < Last Month</a> <a href="calendar.php?y=<?= $nextYear ?>&m=<?= $nextMonth ?>">Next Month >
        </a>
        <div class="container">
            <div class="pic pl-3 shadow rounded-top">
                <div style="font-size: 6rem;">
                    <?php
                    echo date("d");
                    // if(empty($_GET['d'])){
                    //     echo date("d");
                    // }
                    ?>
                </div>
                <div style="font-size: 2.5rem;">
                    <?php echo date("F , Y", strtotime($firstDay)); ?>
                </div>
            </div>
            <div class="">
                <table class="rounded-bottom shadow">
                    <tr>
                        <td style="color:#6ba6e6; font-weight: bold;">Sun</td>
                        <td style="color:#6ba6e6; font-weight: bold;">Mon</td>
                        <td style="color:#6ba6e6; font-weight: bold;">Tue</td>
                        <td style="color:#6ba6e6; font-weight: bold;">Wed</td>
                        <td style="color:#6ba6e6; font-weight: bold;">Thu</td>
                        <td style="color:#6ba6e6; font-weight: bold;">Fri</td>
                        <td style="color:#6ba6e6; font-weight: bold;">Sat</td>
                    </tr>
                    <?php
                    $holiday = [
                        '2-28'=> '和平紀念日',
                        '10-10' => '雙十節',
                        '10-30' => '萬聖節',
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
                                echo "<br>" . $holiday[$month . '-' . $date];
                            };
                            // if ($date == date("d")) {
                            //     echo "<div class='today'>" . date('d') . "</div>";  #adbdf9
                            // }
                            echo "</div>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>