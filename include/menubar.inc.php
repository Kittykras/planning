<?php
include 'database/handler.php';
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
                        <li><a href = 'enkeltMedarbejder.php' onClick="SetCookie('UserName', '<?php echo $user->a_username ?>', '1')"> <?php echo $user->a_name ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li class = "has-sub"><a href = '#'>Kunder</a>
                <ul>
                    <li><a href = '#'>SFB</a>
                    </li>
                    <li><a href = '#'>Ekko</a>
                    </li>
                </ul>
            </li>
            <li><a href = 'overblik.php'>Overblik</a></li>
            <li><a href = '#'>Time Oversigt</a></li>
            <li><a href = '#'><span class = "glyphicon glyphicon-user"></span> <?php print_r($_SESSION["user"])
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
