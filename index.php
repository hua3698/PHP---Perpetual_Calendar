<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            width: 100vw;
            height: 100vh;
            margin: 0 auto;
            background-image: url("2021-calendar.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .content {
            width: 80%;
            height: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .content>a {
            width: 150px;
            height: auto;
            background: aliceblue;
            border-radius: 20px;
            padding: 5px 15px;
        }

        a:link {
            text-decoration: none;
        }

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
        }

        .pic {
            width: 500px;
            height: 250px;
            background-image: url("beach.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.8;
            color: #3e62e6;
            text-shadow: 3px 3px 3px #fff;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .weekend {
            color: #f94949;
        }

        .today {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ffe79be3;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .th {
            width: 45px;
            height: 45px;
            color: #6ba6e6;
            font-weight: bold;
            background: #e8e8e8;
        }

        .cr {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: translateX(25%);
            user-select: none;
        }

        .cr:hover {
            background: #ffe79b8a;
        }

        .animate:hover {
            animation: arrowA 2s infinite;
        }

        .animateB:hover {
            animation: arrowB 2s infinite;
            /* animation-fill-mode: forwards; */
        }

        @keyframes arrowA {
            50% {
                transform: translateX(-10%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        @keyframes arrowB {
            50% {
                transform: translateX(10%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        .hol {
            font-size: 10px;
            position: absolute;
            bottom: 2%;
            left: 45%;
            color: #f44336;
        }
    </style>
</head>

<body class="alert-warning">
    <?php
    $holiday = [
        '1-1' => '●',
        '2-28' => '●',
        '3-8' => '●',
        '4-1' => '●',
        '4-4' => '●',
        '5-15' => '●',
        '8-8' => '●',
        '9-28' => '●',
        '10-10' => '●',
        '10-30' => '●',
        '11-11' => '●',
        '12-25' => '●'
    ];

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

    $firstDay = "$year-$month-01";
    $monthDay = date("t", strtotime($firstDay));
    $startDay = date("w", strtotime($firstDay));
    $lastDay = date("w", strtotime("$year-$month-$monthDay"));
    ?>

    <div class="content">
        <a href="index.php?y=<?= $lastYear ?>&m=<?= $lastMonth ?>" class="animate">&lt;&lt; Last Month</a>
        <div class="box shadow-lg m-3">
            <div class="pic pl-4">
                <a href="index.php">
                    <div style="font-size: 6rem;">
                        <?php
                        echo date("d");
                        ?>
                    </div>
                </a>
                <div style="font-size: 2.5rem;">
                    <?php echo date("F , Y", strtotime($firstDay)); ?>
                </div>
            </div>
            <div>
                <table>
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
                    for ($i = 0; $i < 6; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < 7; $j++) {
                            $date = (($i * 7) + ($j + 1) - $startDay);
                            echo "<td>";
                            echo "<div class='cr'>";
                            if ($j == 0 || $j == 6) {
                                echo "<div class='weekend'>";
                            }
                            // $date = "";
                            if ($j < $startDay && $i == 0) {
                                echo  "&nbsp";
                            } else if ((($i * 7) + ($j + 1) - $startDay) > $monthDay) {
                                echo  "&nbsp";
                            } else if ($date == date("d")) {
                                echo "<div class='today'>$date</div>";
                            } else {
                                echo  $date;
                            }
                            if (!empty($holiday[$month . '-' . $date])) {
                                echo "<div class='hol'>●</div>";
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
        <a href="index.php?y=<?= $nextYear ?>&m=<?= $nextMonth ?>" class="animateB">Next Month &gt;&gt;</a>
    </div>
</body>

</html>