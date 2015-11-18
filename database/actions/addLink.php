<?php

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

$urls = json_decode($_REQUEST['q']);
if (!empty($urls)) {
    echo '<div class="form-group">
                <input type="text" name="url" class="form-control input-style" id="url" placeholder="Link">
            </div>
            <div class="form-group">
                <input type="text" name="user" class="form-control input-style" id="user" placeholder="Brugernavn">
            </div>
            <div class=" form-group group">
                <div class="form-group col span_1_of_2">
                    <input type="text" name="pwd" class="form-control input-style" id="pwd" placeholder="Adgangskode">
                </div>
                <div class="form-group col span_1_of_2">
                    <button type="button" class="btn btn-black" onclick="addLink()">Tilføj link</button>
                </div>
            </div>';
    if (!isMobile()) {
        if (count($urls) === 1) {
            echo '<select name="viewlinks" id="viewlinks" class="form-control input-style" onclick="openLinkModal(this.value)">';
        }
    } else {
        echo '<select name="viewlinks" id="viewlinks" class="form-control input-style" onchange="openLinkModal(this.value)">';
    }
    foreach ($urls as $url) {
        echo '<option value="' . $url->d_id . '¤' . $url->d_url . '¤' . $url->d_username . '¤' . $url->d_password . '">' . $url->d_url . '</option>';
    }
    echo '</select>';
    echo '<select class="hidden" multiple name="urls[ ]" id="urls">';
    foreach ($urls as $url) {
        echo '<option value="' . $url->d_id . '¤' . $url->d_url . '¤' . $url->d_username . '¤' . $url->d_password . '">' . $url->d_url . '</option>';
    }
    echo '</select>';
} else {
    echo '<div class="form-group">
                <input type="text" name="url" class="form-control input-style" id="url" placeholder="Link">
            </div>
            <div class="form-group">
                <input type="text" name="user" class="form-control input-style" id="user" placeholder="Brugernavn">
            </div>
            <div class=" form-group group">
                <div class="form-group col span_1_of_2">
                    <input type="text" name="pwd" class="form-control input-style" id="pwd" placeholder="Adgangskode">
                </div>
                <div class="form-group col span_1_of_2">
                    <button type="button" class="btn btn-black" onclick="addLink()">Tilføj link</button>
                </div>
            </div>';
    echo 'Husk at udfylde Link feltet';
}