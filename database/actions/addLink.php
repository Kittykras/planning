<?php

$urls = json_decode($_REQUEST['q']);
if (!empty($urls)) {
    echo '<div class="form-group group">
                <div class="col span_1_of_3">
                    <input type="text" name="url" class="form-control input-style" id="url" placeholder="Link">
                </div>
                <div class="col span_1_of_3">
                    <input type="text" name="user" class="form-control input-style" id="user" placeholder="Brugernavn">
                </div>
                <div class="col span_1_of_3">
                    <input type="text" name="pwd" class="form-control input-style" id="pwd" placeholder="Adgangskode">
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-black span_1_of_3" onclick="addLink()">Tilføj link</button>
            </div>';
    foreach ($urls as $url) {
        echo '<div class="form-group">';
        echo '<input onclick="openLinkModal(this.value)" class="form-control input-style" value="' . $url->d_url . ' // ' . $url->d_username . ' // ' . $url->d_password . '">';
        echo '</div>';
    }
    echo '<select class="hidden" multiple name="urls[ ]" id="urls">';
    foreach ($urls as $url) {
        echo '<option value="' . $url->d_id . '¤' . $url->d_url . '¤' . $url->d_username . '¤' . $url->d_password . '">' . $url->d_url . '</option>';
    }
    echo '</select>';
} else {
    echo '<div class="form-group group">
                <div class="col span_1_of_3">
                    <input type="text" name="url" class="form-control input-style" id="url" placeholder="Link">
                </div>
                <div class="col span_1_of_3">
                    <input type="text" name="user" class="form-control input-style" id="user" placeholder="Brugernavn">
                </div>
                <div class="col span_1_of_3">
                    <input type="text" name="pwd" class="form-control input-style" id="pwd" placeholder="Adgangskode">
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-black span_1_of_3" onclick="addLink()">Tilføj link</button>
            </div>';
    echo 'Husk at udfylde Link feltet';
}