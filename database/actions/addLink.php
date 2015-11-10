<?php
$urls = $_GET['q'];
echo '<div class="form-group">
                <input type="text" name="url" class="form-control input-style" id="url" placeholder="Link">
            </div>
            <div class="form-group">
                <input type="text" name="user" class="form-control input-style" id="user" placeholder="Link">
            </div>
            <div class="form-group span_1_of_2">
                <input type="text" name="pwd" class="form-control input-style" id="pwd" placeholder="Link">
            </div>';
echo '<select name="urls" id="urls" class="form-control input-style">';
foreach ($urls as $url) {
    echo '<option value="'.$url->url.'">'.$url->url.'</option>';
}
echo '<div class="form-group span_1_of_2">
                <button class="btn btn-black" onclick="addLink()">Tilføj link</button>
            </div>';
