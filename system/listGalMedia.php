<?php
include "include/classes/session.php";
$mypage = $_SERVER['PHP_SELF'];
$page = $mypage;

include 'top.php';
include 'header.php';
if ($session->logged_in) {
    ?> 
    <div class='container'> 
        <main class="main">
            <div class="col_m_3">
                <h3>Páginas</h3>
                <?php include 'editmenu.php'; ?> 
            </div>
            <div class='col_m_9 last'> 
                <?php
                if (isset($_GET['gal']) && !empty($_GET['gal'])) {
                    $id = (int) $_GET['gal'];
                    $rowg = mysqli_fetch_array($database->query("SELECT * FROM `galleries` WHERE `idGal` = '$id' "));
                }
                ?>
                <p>
                    <a class="button" href='newmultimedia.php?id=<?php echo $rowg['idGal']; ?>'>Agregar Nuevo Multimedia</a> 
                </p>

                <h3>Lista de Multimedia de <?php echo $rowg['name']; ?></h3>

                <style>
                    #sort
                    {                        
                        border-collapse: collapse;
                        width: 98%;
                    }
                    #sort a{
                        cursor: pointer;
                    }
                    #sort thead tr
                    {
                        border-bottom: 1px solid #ccc;
                    }

                    #sort tr
                    {
                        vertical-align: middle !important;
                        line-height: 2rem !important;
                        margin-bottom: 3px;
                    }                     
                    #sort th, #sort td
                    {
                        border: 1px solid #ddd;
                        padding: 10px;
                        white-space: nowrap;
                    }
                </style>
                <script>
                    $(document).ready(function () {
                        sortable_tables.sorting_field_table();
                    });
                    $('table#sort tbody').sortable({
                        items: ">tr",
                        appendTo: "parent",
                        opacity: 1,
                        containment: "document",
                        placeholder: "placeholder-style",
                        cursor: "move",
                        delay: 150,
                        update: function (event, ui) {
                            $(this).children().each(function (index) {
                                $(this).find('tr').last().html(index + 1);
                            });
                        }
                    });


                    var sortable_tables =
                            {
                                sorting_field_table: function ()
                                {
                                    $('table#sort tbody').sortable({
                                        helper: sortable_tables.fixWidthHelper
                                    }).disableSelection();
                                },

                                fixWidthHelper: function (e, ui) {
                                    ui.children().each(function () {
                                        $(this).width($(this).width());
                                    });
                                    return ui;
                                }
                            };

                    function saveOrderImg() {
                        var selectedLanguage = new Array();
                        $('#sort tr').each(function () {
                            selectedLanguage.push($(this).attr("id"));
                        });
                        document.getElementById("img_order").value = selectedLanguage;
                    }
                    $('table#sort tr:last').index() + 1;

                </script>
                <?php
                if (isset($_POST["submitOrd"])) {
                    $id_ary = explode(",", $_POST["img_order"]);
                    for ($i = 1; $i < count($id_ary); $i++) {
                        $database->query("UPDATE multimedia_gal SET sort='$i' WHERE id='$id_ary[$i]' AND galId='$id' ");
                    }
                }
                ?>

                <form action='' method='POST'> 
                    <input type = "hidden" name="img_order" id="img_order" /> 

                    <?php
                    echo "<table id='sort' border=1 cellpadding=0 cellspacing=0 > \n";
                    echo "<thead>";
                    echo "<tr class=title>";
                    echo "<th><b>Orden</b></th>";
                    echo "<th><b>Nombre</b></th>";
                    echo "<th><b>Origen</b></th>";
                    echo "<th><b>Id Video</b></th>";
                    echo "<th></th><th></th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    $result = $database->query("SELECT * FROM multimedia_gal WHERE galId='$id' ORDER BY sort") or trigger_error($database->error);
                    while ($row = $result->fetch_array()) {
                        foreach ($row AS $key => $value) {
                            $row[$key] = stripslashes($value);
                        }
                        echo "<tr id=" . $row['id'] . "> \n";
                        echo "<td valign='top'>" . $row['sort'] . "</td>";
                        echo "<td valign='top'>" . $row['name'] . "</td>";
                        echo "<td valign='top'>";
                        if ($row['source'] == 0) {
                            echo 'youtube';
                        } elseif ($row['source'] == 1) {
                            echo 'vimeo';
                        } else {
                            echo 'daylimotion';
                        }
                        echo "</td>";
                        echo "<td valign='top'>" . $row['idlink'] . "</td>";
                        echo "<td valign='top'><a href='editMedia.php?id={$row['id']}'>Editar</a></td><td><a href='deleteMedia.php?id={$row['id']}'>Eliminar</a></td> ";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "<tfoot>";
                    echo "<tr class=title>";
                    echo "<th><b>Orden</b></th>";
                    echo "<th><b>Nombre</b></th>";
                    echo "<th><b>Origen</b></th>";
                    echo "<th><b>Id Video</b></th>";
                    echo "<th></th><th></th>";
                    echo "</tr>";
                    echo "</tfoot>";
                    echo "</table>";
                    ?> 
                    <input type="submit" class="btnSave" name="submitOrd" value="Guardar Orden" onClick="saveOrderImg();" />
                </form>
            </div>
            <div class="clear"></div>
        </main>
    </div>
    <?php
}
include 'footer.php';
?> 
