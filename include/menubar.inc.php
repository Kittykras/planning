<?php
include 'database/userHandler.php';
include 'database/customerHandler.php';
session_start();
?>
<div class="dcenter">
    <div id='cssmenu'  align="center">
        <ul>
<!--                <li><a href='#'><span style="color: orangered">+</span>vonbülow.co</a></li>-->
            <div class="navbar-header">
                <a class="navbar-brand" style="color: white" href="#"><span style="color: #D26232">+</span>vonbülow.co</a>
            </div>
            <li class='has-sub'><a href='medarbejdere.php'>Medarbejdere</a>
                <ul>
                    <?php foreach ($users as $user) { ?>
                    <li><a href = 'enkeltMedarbejder.php' onClick="SetCookie('UserName', '<?php echo $user->a_username ?>', '1'); SetCookie('orderby', 't_fromWeek', '1'); SetCookie('state', '0', '1')"> <?php echo $user->a_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li class = "has-sub"><a href = 'kunder.php'>Kunder</a>
                <ul>
                    <?php foreach ($menucustomers as $customer) { ?>
                        <li><a href = 'enkeltKunde.php' onClick="SetCookie('Kunde', '<?php echo $customer->c_acronym ?>', '1'); SetCookie('orderby', 't_fromWeek', '1'); SetCookie('state', '0', '1')"> <?php echo $customer->c_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li><a href = 'overblik.php' onclick="SetCookie('orderby', 't_fromWeek', '1')">Overblik</a></li>
            <li><a href = 'timeOversigt.php' onclick="SetCookie('orderby', 't_customer', '1')">Time Oversigt</a></li>
            <li><a href = 'enkeltMedarbejder.php' onclick="SetCookie('UserName', '<?php echo $_SESSION["user"]->a_username ?>', '1'); SetCookie('orderby', 't_fromWeek', '1'); SetCookie('state', '0', '1');"><span class = "glyphicon glyphicon-user"></span> <?php print_r($_SESSION["user"]->a_name)
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
</script>
