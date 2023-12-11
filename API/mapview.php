<?php
if (isset($_GET['address']) && isset($_GET['city'])) {
    $address = $_GET['address'];
    $city = $_GET['city'];
    ?> 
    <div class="googlemaps">
        <iframe style="width: 100%" height="349" style="border: 0" allowfullscreen="" loading="lazy" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCb3U_z-owpRwGS321AP0JX09crvvQj4dw&q=<?= $address?>+<?= $city?>"> 
        </iframe>
    </div>
    <?php
}
?>