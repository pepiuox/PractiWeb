<!-- content block -->

    <div class="row">    

        <?php
        if ($bid) {
            $result = $database->query("SELECT id, title, content FROM page WHERE id = '$bid'");
        }
        $row = $result->fetch_assoc();

        echo $row['content'];
        ?>
    </div>
