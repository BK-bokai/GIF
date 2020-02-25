<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GoogleMap Car</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />



    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


    <!-- materializecss icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- jqury CDN -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- font-awesom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">

    <!--css樣式-->

    <link rel="stylesheet" href="css/style.css" charset="utf-8">

    <!-- <link rel="stylesheet" href="extras/noUiSlider/nouislider.min.css">
    <script src="extras/noUiSlider/nouislider.min.js"></script> -->
    <link rel="stylesheet" href="nouislider.css">
    <script src="nouislider.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.js"></script>

</head>


<body onLoad="chImg()">
    <header style="margin-bottom: 20px">
        <nav class=" teal darken-4">
            <div class="nav-wrapper ">
                <a href="#!" class="brand-logo center">GoogleMap Car Speed</a>
            </div>
        </nav>
    </header>


    <main>
        <?php if (isset($_GET["start"]) && isset($_GET["end"])) {
            $start = date("Y-m-d H:i", strtotime($_GET["start"]));
            $end   = date("Y-m-d H:i", strtotime($_GET["end"]));
        } else {
            $start = false;
            $end = false;
        }
        ?>
        <div class="container row ">
            <div class="card col s12 m6">
                <form method="get" enctype="multipart/form-data" id="go">
                    <table class="highlight centered" style="border-collapse: unset;">
                        <tbody>
                            <tr>
                                <td>
                                    </label>
                                    <select name='start'>
                                        <?php foreach (scandir('googleCar') as $imgs) : ?>
                                            <?php if ($imgs != "." && $imgs != "..") : ?>
                                                <?php
                                                $Year = substr($imgs, 0, 4);
                                                $Month = substr($imgs, 4, 2);
                                                $Day = substr($imgs, 6, 2);
                                                $Hr = substr($imgs, 8, 2);
                                                $Min = substr($imgs, 10, 2);
                                                // $time = date("Ymdhi", strtotime(substr($imgs, 0, 12)));
                                                $time = date("Y-m-d H:i", strtotime("$Year-$Month-$Day $Hr:$Min"));
                                                ?>
                                                <option value="<?php print_r($time) ?>" <?php $start == $time ? print("selected") : "" ?>> <?php print_r($time) ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                    <span>請選擇起始時間</span>
                                    <label>
                                </td>
                                <td>
                                    </label>
                                    <select name='end'>
                                        <?php foreach (scandir('googleCar') as $imgs) : ?>
                                            <?php if ($imgs != "." && $imgs != "..") : ?>
                                                <?php
                                                $Year = substr($imgs, 0, 4);
                                                $Month = substr($imgs, 4, 2);
                                                $Day = substr($imgs, 6, 2);
                                                $Hr = substr($imgs, 8, 2);
                                                $Min = substr($imgs, 10, 2);
                                                // $time = date("Ymdhi", strtotime(substr($imgs, 0, 12)));
                                                $time = date("Y-m-d H:i", strtotime("$Year-$Month-$Day $Hr:$Min"));
                                                ?>
                                                <option value="<?php print_r($time) ?>" <?php if ($end == $time) print("selected") ?>> <?php print_r($time) ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                    <span>請選擇結束時間</span>
                                    <label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <div class="col s12 center" style="margin-top: 10px;margin-bottom: 10px">
                    <button class="btn waves-effect waves-light" id='go_start' name="action" style="margin-right: 20px;">播放
                        <i class="material-icons right"></i>
                    </button>

                    <div id="start" style="display: none;">123</div>
                    <button class="btn waves-effect waves-light" id='stop' name="action" style="margin-left: 20px;">停止
                        <i class="material-icons right"></i>
                    </button>
                </div>
            </div>

            <div class="col s12 m6">
                <h4 class="center" id='titleID'></h4>
                <img id="picID" border="0" class="responsive-img">
            </div>
        </div>
    </main>

    <footer class="page-footer  teal darken-4">
        <div class="container">
            <div class="row">
                <div class="col l6 s6">
                    <h5 class="white-text">Footer Content</h5>
                    <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2014 Copyright Text
                <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            function autoplay() {
                $('.carousel').carousel('next');
                setTimeout(autoplay, 1500);
            }


            $('.sidenav').sidenav();

            $('.carousel').carousel({
                fullWidth: true
            });
            $('select').formSelect();

            $('#go_start').click(function() {
                $('#go').submit();
            })

            let Img = new Array(
                <?php
                foreach (scandir('googleCar') as $imgs) {
                    if ($imgs != "." && $imgs != "..") {
                        $Year = substr($imgs, 0, 4);
                        $Month = substr($imgs, 4, 2);
                        $Day = substr($imgs, 6, 2);
                        $Hr = substr($imgs, 8, 2);
                        $Min = substr($imgs, 10, 2);
                        $time = date("Y-m-d H:i", strtotime("$Year-$Month-$Day $Hr:$Min"));
                        if (isset($_GET["start"]) && isset($_GET["end"])) {
                            $start = date("Y-m-d H:i", strtotime($_GET["start"]));
                            $end   = date("Y-m-d H:i", strtotime($_GET["end"]));
                            if ($time >= $start && $time <= $end) {
                                print("'googleCar/{$imgs}',");
                            }
                        } else {
                            print("'googleCar/{$imgs}',");
                        }
                    }
                }
                ?>
            );
            let title = new Array(
                <?php
                foreach (scandir('googleCar') as $imgs) {
                    if ($imgs != "." && $imgs != "..") {
                        $Year = substr($imgs, 0, 4);
                        $Month = substr($imgs, 4, 2);
                        $Day = substr($imgs, 6, 2);
                        $Hr = substr($imgs, 8, 2);
                        $Min = substr($imgs, 10, 2);
                        $time = date("Y-m-d H:i", strtotime("$Year-$Month-$Day $Hr:$Min"));
                        if (isset($_GET["start"]) && isset($_GET["end"])) {
                            $start = date("Y-m-d H:i", strtotime($_GET["start"]));
                            $end   = date("Y-m-d H:i", strtotime($_GET["end"]));
                            if ($time >= $start && $time <= $end) {
                                print("'${time}',");
                            }
                        } else {
                            print("'${time}',");
                        }
                    }
                }
                ?>
            );


            let size = Img.length;
            let i = 0;
            let picID = $('#picID')[0];
            let titleID = $('#titleID');
            let chImg = function() {
                picID.src = Img[i];
                titleID.text(title[i]);
                i++;
                if (i >= size) i = 0;
                setTimeout(chImg, 500);
            };
            chImg()

            $('#stop').click(function() {
                let highestTimeoutId = setTimeout(";");
                for (var i = 0; i < highestTimeoutId; i++) {
                    clearTimeout(i);
                }
            });
        });
    </script>
</body>

</html>