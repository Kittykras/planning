<?php
include 'database/userHandler.php';
include 'database/customerHandler.php';
session_start();
?>
<div class="dcenter">
    <div id='cssmenu'  align="center">
        <ul>
            <div class="navbar-header">
                <a class="navbar-brand" style="color: white" href="#"><span style="color: #D26232">+</span>vonbülow.co</a>
            </div>
            <li  id="nav" class='has-sub'><a href='medarbejdere.php'>Medarbejdere</a>
                <ul>
                    <?php foreach ($users as $user) { ?>
                        <li><a id="nav" href = 'enkeltMedarbejder.php' onClick="SetCookie('UserName', '<?php echo $user->a_username ?>', '1');
                                    SetCookie('orderby', 't_fromWeek', '1');
                                    SetCookie('state', '0', '1')"> <?php echo $user->a_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li  id="nav" class = "has-sub"><a id="nav" href = 'kunder.php' onclick="SetCookie('orderby', 'c_name', '1');
                    SetCookie('state', '0', '1')">Kunder</a>
                <ul>
                    <?php foreach ($menucustomers as $customer) { ?>
                        <li><a href = 'enkeltKunde.php' onClick="SetCookie('Kunde', '<?php echo $customer->c_acronym ?>', '1');
                                    SetCookie('orderby', 't_fromWeek', '1');
                                    SetCookie('state', '0', '1')"> <?php echo $customer->c_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li id="nav"><a id="nav" href = 'overblik.php' onclick="SetCookie('orderby', 't_fromWeek', '1')">Overblik</a></li>
            <li id="nav"><a id="nav" href = 'timeOversigt.php' onclick="SetCookie('orderby', 't_customer', '1')">Time Oversigt</a></li>
            <li id="nav"><a id="nav" href = 'enkeltMedarbejder.php' onclick="SetCookie('UserName', '<?php echo $_SESSION["user"]->a_username ?>', '1');
                    SetCookie('orderby', 't_fromWeek', '1');
                    SetCookie('state', '0', '1');"><span class = "glyphicon glyphicon-user"></span> <?php print_r($_SESSION["user"]->a_name)
                    ?></a></li>
        </ul>
    </div>
</div>

<script type="text/javascript">
    function SetCookie(c_name, value, expiredays) {
        var exdate = new Date()
        exdate.setDate(exdate.getDate() + expiredays)
        document.cookie = c_name + "=" + escape(value) +
                ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString())
    }
//    $(document).ready(function () {
////    var path = window.location.pathname;
////            path = path.replace(/\//vonbulowPlanning / , "");
////            path = decodeURIComponent(path);
//    var href = $('a#nav').attr('href');
//            if (href === 'kunder.php') {
//    $('li#nav').addClass('active');
//    }
//    }
</script>
