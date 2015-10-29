<?php
include 'database/userHandler.php';
include 'database/customerHandler.php';
session_start();
?>
<div class="dcenter">
    <nav class="navbar navbar-style">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color: white" href="#"><span style="color: #D26232">+</span>vonbülow.co</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class='dropdown <?php echo $_COOKIE['medarbejder'] ?>'>
                        <div class="split-menuitem">
                            <a data-toggle="dropdown" class="dropdown-toggle" href = 'medarbejdere.php' onclick="SetActive('medarbejder');">Medarbejdere</a>
                            <a data-toggle="dropdown" class="dropdown-toggle"><span class="caret"></span></a>
                            <ul class="dropdown-menu inverse-dropdown">
                                <?php foreach ($users as $user) { ?>
                                    <li><a href = 'enkeltMedarbejder.php' onClick="SetCookie('UserName', '<?php echo $user->a_username ?>', '1');
                                                SetCookie('orderby', 't_fromWeek', '1');
                                                SetCookie('state', '0', '1');
                                                SetActive('medarbejder');"> <?php echo $user->a_name ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li  class = "dropdown <?php echo $_COOKIE['kunder'] ?>">
                        <div class="split-menuitem">
                            <a href = 'kunder.php' onclick="SetCookie('orderby', 'c_name', '1');
                                    SetCookie('state', '0', '1');
                                    SetActive('kunder');">Kunder</a>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="caret"></span></a>
                            <ul class="dropdown-menu inverse-dropdown">
                                <?php foreach ($menucustomers as $customer) { ?>
                                    <li><a href = 'enkeltKunde.php' onClick="SetCookie('Kunde', '<?php echo $customer->c_acronym ?>', '1');
                                                SetCookie('orderby', 't_fromWeek', '1');
                                                SetCookie('state', '0', '1');
                                                SetActive('kunder');"> <?php echo $customer->c_name ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class = "<?php echo $_COOKIE['overblik'] ?>"><a href = 'overblik.php' onclick="SetCookie('orderbydfjklgnsdrjkbgdrui', 't_fromWeek', '1');
                            SetCookie('orderby', 't_fromweek', '1');
                            SetCookie('state', '0', '1');
                            SetActive('overblik');">Overblik</a></li>
                    <li class = "<?php echo $_COOKIE['timeoversigt'] ?>"><a href = 'timeOversigt.php' onclick="SetCookie('orderby', 't_customer', '1');
                            SetCookie('orderby', 't_customer', '1');
                            SetCookie('state', '0', '1');
                            SetActive('timeoversigt');">Time Oversigt</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class = "<?php echo $_COOKIE['login'] ?>"><a href = 'enkeltMedarbejder.php' onclick="SetCookie('UserName', '<?php echo $_SESSION["user"]->a_username ?>', '1');
                            SetCookie('orderby', 't_fromWeek', '1');
                            SetCookie('state', '0', '1');
                            SetActive('login');"><span class = "glyphicon glyphicon-user"></span> <?php print_r($_SESSION["user"]->a_name)
                                ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
