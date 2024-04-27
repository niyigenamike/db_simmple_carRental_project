<?php
function generateCard($number, $cardName) {
     echo '<div class="card">';
    echo '<div>';
    echo '<div class="numbers">' . $number . '</div>';
    echo '<div class="cardName">' . $cardName . '</div>';
    echo '</div>';
    echo '<div class="iconBx">';
    echo '<ion-icon name="eye-outline"></ion-icon>';
    echo '</div>';
    echo '</div>';
 }
?>
