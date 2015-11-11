<?php

$urls = json_decode($_REQUEST['q']);
//class foo {
//    public $url = 'business.dk';
//}
//
//$bar = new foo;
//$urls = array($bar);
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
    echo '<select name="urls" id="urls" class="form-control input-style">';
    foreach ($urls as $url) {
        echo '<option value="' . $url->url . '¤' . $url->user . '¤' . $url->pwd . '">' . $url->url . '</option>';
    }
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