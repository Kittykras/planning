<?php
include 'database/userHandler.php';
include 'database/customerHandler.php';
if (session_status() == PHP_SESSION_NONE) {
    $session_expiration = time() + 3600 * 24; // +1 days
    session_set_cookie_params($session_expiration);
    session_start();
}
?>
<div class="dcenter">
    <div id="cssmenu">
        <ul>
            <div class="navbar-header">
                <a class="navbar-brand" style="color: white" href="singleAssociate.php" onclick="SetCookie('UserName', '<?php echo $_SESSION["user"]->a_username ?>', '1');
                        SetCookie('orderby', 't_fromWeek', '1');
                        SetCookie('state', '0', '1');
                        SetCookie('previous', window.location.href, '1');
                        SetActive('login');"><span style="color: #D26232">+</span>vonbülow.co</a>
            </div>
            <li class='has-sub <?php echo $_COOKIE['medarbejder'] ?>'>
                <a href = 'associates.php' onclick="SetCookie('previous', window.location.href, '1'); SetActive('medarbejder');">Medarbejdere</a>
                <ul>
                    <?php foreach ($users as $user) { ?>
                        <li><a href = 'singleAssociate.php' onClick="SetCookie('UserName', '<?php echo $user->a_username ?>', '1');
                                    SetCookie('orderby', 't_fromWeek', '1');
                                    SetCookie('state', '0', '1');
                                    SetCookie('previous', window.location.href, '1');
                                    SetActive('medarbejder');"> <?php echo $user->a_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li  class = "has-sub <?php echo $_COOKIE['kunder'] ?>">
                <a href = 'customers.php' onclick="SetCookie('orderby', 'c_name', '1');
                        SetCookie('state', '0', '1');
                        SetCookie('previous', window.location.href, '1');
                        SetActive('kunder');">Kunder</a>
                <ul>
                    <?php foreach ($menucustomers as $customer) { ?>
                        <li><a href = 'singleCustomer.php' onClick="SetCookie('Kunde', '<?php echo $customer->c_acronym ?>', '1');
                                    SetCookie('orderby', 't_fromWeek', '1');
                                    SetCookie('state', '0', '1');
                                    SetCookie('previous', window.location.href, '1');
                                    SetActive('kunder');"> <?php echo $customer->c_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li class = "<?php echo $_COOKIE['overblik'] ?>"><a href = 'overview.php' onclick="SetCookie('orderby', 't_fromWeek', '1');
                    SetCookie('state', '0', '1');
                    SetCookie('previous', window.location.href, '1');
                    SetActive('overblik');">Overblik</a></li>
            <li class = "<?php echo $_COOKIE['timeoversigt'] ?>"><a href = 'timeOverview.php' onclick="SetCookie('orderby', 't_customer', '1');
                    SetCookie('state', '0', '1');
                    SetCookie('previous', window.location.href, '1');
                    SetActive('timeoversigt');">Timer</a></li>
            <li class = "<?php echo $_COOKIE['presse'] ?>"><a href = 'press.php' onclick="SetCookie('orderby', 't_fromweek', '1');
                    SetCookie('state', '0', '1');
                    SetCookie('previous', window.location.href, '1');
                    SetActive('presse');">Presse</a></li>
            <li class = "<?php echo $_COOKIE['login'] ?>"><a href = 'singleAssociate.php' onclick="SetCookie('UserName', '<?php echo $_SESSION["user"]->a_username ?>', '1');
                    SetCookie('orderby', 't_fromWeek', '1');
                    SetCookie('state', '0', '1');
                    SetCookie('previous', window.location.href, '1');
                    SetActive('login');"><span class = "glyphicon glyphicon-user"></span> <?php print_r($_SESSION["user"]->a_name)
                    ?></a></li>
        </ul>
    </div>
</div>
