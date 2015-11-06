<?php
include 'database/userHandler.php';
include 'database/customerHandler.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="dcenter">
    <!--<nav class="navbar navbar-style">-->
    <div id="cssmenu">
        <ul>
            <div class="navbar-header">
                <!--                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>-->
                <a class="navbar-brand" style="color: white" href="#"><span style="color: #D26232">+</span>vonbülow.co</a>
            </div>
            <!--<div class="collapse navbar-collapse" id="myNavbar">-->
            <li class='has-sub <?php echo $_COOKIE['medarbejder'] ?>'>
                <!--<div class="split-menuitem">-->
                <a href = 'associates.php' onclick="SetActive('medarbejder');">Medarbejdere</a>
                <ul>
                    <?php foreach ($users as $user) { ?>
                        <li><a href = 'singleAssociate.php' onClick="SetCookie('UserName', '<?php echo $user->a_username ?>', '1');
                                SetCookie('orderby', 't_fromWeek', '1');
                                SetCookie('state', '0', '1');
                                SetActive('medarbejder');"> <?php echo $user->a_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li  class = "has-sub <?php echo $_COOKIE['kunder'] ?>">
                <!--<div class="split-menuitem">-->
                <a href = 'customers.php' onclick="SetCookie('orderby', 'c_name', '1');
                        SetCookie('state', '0', '1');
                        SetActive('kunder');">Kunder</a>
                <ul>
                    <?php foreach ($menucustomers as $customer) { ?>
                        <li><a href = 'singleCustomer.php' onClick="SetCookie('Kunde', '<?php echo $customer->c_acronym ?>', '1');
                                SetCookie('orderby', 't_fromWeek', '1');
                                SetCookie('state', '0', '1');
                                SetActive('kunder');"> <?php echo $customer->c_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li class = "<?php echo $_COOKIE['overblik'] ?>"><a href = 'overview.php' onclick="SetCookie('orderby', 't_fromWeek', '1');
                    SetCookie('orderby', 't_fromweek', '1');
                    SetCookie('state', '0', '1');
                    SetActive('overblik');">Overblik</a></li>
            <li class = "<?php echo $_COOKIE['timeoversigt'] ?>"><a href = 'timeOverview.php' onclick="SetCookie('orderby', 't_customer', '1');
                    SetCookie('orderby', 't_customer', '1');
                    SetCookie('state', '0', '1');
                    SetActive('timeoversigt');">Time Oversigt</a></li>
            <li class = "<?php echo $_COOKIE['login'] ?>"><a href = 'singleAssociate.php' onclick="SetCookie('UserName', '<?php echo $_SESSION["user"]->a_username ?>', '1');
                    SetCookie('orderby', 't_fromWeek', '1');
                    SetCookie('state', '0', '1');
                    SetActive('login');"><span class = "glyphicon glyphicon-user"></span> <?php print_r($_SESSION["user"]->a_name)
                    ?></a></li>
        </ul>
    </div>
</div>
</nav>
</div>
