<?php
session_start();
?>
<div class="dcenter">
<div id='cssmenu'  align="center">
            <ul>
<!--                <li><a href='#'><span style="color: orangered">+</span>vonbülow.co</a></li>-->
                <div class="navbar-header">
                    <a class="navbar-brand" style="color: white" href="#"><span style="color: orangered">+</span>vonbülow.co</a>
                </div>
                <li class='has-sub'><a href='#'>Medarbejdere</a>
                    <ul>
                        <li><a href='#'>Rikke</a>
                        </li>
                        <li><a href='#'>Ane</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub"><a href='#'>Kunder</a>
                    <ul>
                        <li><a href='#'>SFB</a>
                        </li>
                        <li><a href='#'>Ekko</a>
                        </li>
                    </ul>
                </li>
                <li><a href='#'>Overblik</a></li>
                <li><a href='#'>Time Oversigt</a></li>
                <li><a href='#'><span class="glyphicon glyphicon-user"></span> <?php print_r($_SESSION["user"])?></a></li>
            </ul>
        </div>
</div>