<!doctype html>
<html lang='html5'>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css"><link rel="stylesheet" href="html5reset.css">
        <!--Latest compiled and minified CSS--> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!--Optional theme--> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!--Latest compiled and minified JavaScript--> 
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="script.js"></script>
        <link rel="stylesheet" href="styles.css">
        <title>vonbulow</title>
    </head>
    <body>

        <div id='cssmenu' style="max-width: 940px; margin: auto">
            <ul>
<!--                <li><a href='#'><span style="color: orangered">+</span>vonbülow.co</a></li>-->
                <div class="navbar-header">
                    <a class="navbar-brand" style="color: white" href="#"><span style="color: orangered">+</span>vonbülow.co</a>
                </div>
                <li class='has-sub'><a href='#'>Medarbejdere</a>
                    <ul>
                        <li class='has-sub'><a href='#'>Rikke</a>
                        </li>
                        <li class='has-sub'><a href='#'>Ane</a>
                        </li>
                    </ul>
                </li>
                <li><a href='#'>Kunder</a>
                    <ul>
                        <li class='has-sub'><a href='#'>SFB</a>
                        </li>
                        <li class='has-sub'><a href='#'>Ekko</a>
                        </li>
                    </ul>
                </li>
                <li><a href='#'>Overblik</a></li>
                <li><a href='#'>Time Oversigt</a></li>
                <li><a href='#'><span class="glyphicon glyphicon-user"></span> Rikke</a></li>
            </ul>
        </div>

        <!--        <div class="section group">
                    <div class="col span_1_of_2"><h2>Overblik</h2></div>
                    <div class="col span_2_of_2"><br><button type="button" class="btn btn-black"align="right">Default</button></div>
                </div>-->
        <div class="container img-responsive" style="width: 940px; background-image: url('images/about-sm.jpg')">
            <div class="section group">
                <div class="col span_1_of_2">
                    <h2 style="color: white">Overblik</h2>
                </div>
                <div class="col span_1_of_2" align="right">
                    <br>
                    <button type="button" class="btn btn-black">Ny Kunde</button>
                </div>
            </div>
            <div class="row" align="center">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                            Status <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-black" role="menu">
                            <li><a href="#">Rød</a></li>
                            <li><a href="#">Gul</a></li>
                            <li><a href="#">Almindelig</a></li>
                            <li><a href="#">Grøn</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-black">Uge</button>
                    <button type="button" class="btn btn-black">Kunde</button>
                    <button type="button" class="btn btn-black">Medarbejder</button>
                </div>
            </div>
        </div>
        <br>
        <div class="panel panel-default" style="max-width: 940px; margin: auto">
            <table class="table table-condensed table-responsive" style="background-color: white">
                <thead style="background-color: #D26232; color: black">
                    <tr>
                        <th>Uge</th>
                        <th>Opgave</th>
                        <th>Kunde</th>
                        <th>Medarbejder</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><span>●</span> Presse</td>
                        <td>Høier</td>
                        <td>Rikke</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><span>●</span> LinkedIn</td>
                        <td>Høier</td>
                        <td>Rikke</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><span style="color: #FFCC00">●</span> Web-koks</td>
                        <td>Advodan</td>
                        <td>Ane</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><span style="color: red">●</span> MailChimp / nyhed</td>
                        <td>MI</td>
                        <td>Ane</td>
                    </tr>
                </tbody>
            </table>
    </div>

    </body>
    <html>
