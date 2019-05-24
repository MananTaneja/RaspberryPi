<?php
    require 'header.php'
?>


    <main>
    <?php
    if(isset($_SESSION['userId'])) {
        echo "<p>You are logged in right now </p>";
    }
    else {
        echo "<p>You are logged out right now </p>";
    }
    ?>

    </main>


<?php 
 require 'footer.php';
?>