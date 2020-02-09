<?php

function traducefecha() {
    $diasemana = date("w"); // optiene el número del dia de la semana. El 0 es domingo
    switch ($diasemana) {
        case "0":
            $diasemana = "Domingo";
            break;
        case "1":
            $diasemana = "Lunes";
            break;
        case "2":
            $diasemana = "Martes";
            break;
        case "3":
            $diasemana = "Miércoles";
            break;
        case "4":
            $diasemana = "Jueves";
            break;
        case "5":
            $diasemana = "Viernes";
            break;
        case "6":
            $diasemana = "Sábado";
            break;
    }
    $dia = date("d"); // día del mes en número
    $mes = date("m"); // número del mes de 01 a 12
    switch ($mes) {
        case "01":
            $mes = "Enero";
            break;
        case "02":
            $mes = "Febrero";
            break;
        case "03":
            $mes = "Marzo";
            break;
        case "04":
            $mes = "Abril";
            break;
        case "05":
            $mes = "Mayo";
            break;
        case "06":
            $mes = "Junio";
            break;
        case "07":
            $mes = "Julio";
            break;
        case "08":
            $mes = "Agosto";
            break;
        case "09":
            $mes = "Septiembre";
            break;
        case "10":
            $mes = "Octubre";
            break;
        case "11":
            $mes = "Noviembre";
            break;
        case "12":
            $mes = "Diciembre";
            break;
    }
    $ano = date("Y"); // optenemos el año en formato 4 digitos
    $fecha = $diasemana . ", " . $dia . " de " . $mes . " de " . $ano; // unimos el resultado en una unica cadena
    return $fecha; //enviamos la fecha al programa
}
?>
<!doctype html>
<html lang="en">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="apple-mobile-web-app-capable" content="yes" />        
        <title><?php echo SITE_NAME; ?></title>
        <link rel="shortcut icon" href="<?php echo B_URL; ?>system/img/favicon.ico"/>
        <link rel="icon" sizes="16x16 32x32 64x64" href="<?php echo B_URL; ?>system/img/favicon.ico"/>
        <link rel="icon" type="image/png" sizes="196x196" href="<?php echo B_URL; ?>system/img/favicon-192.png"/>
        <link rel="icon" type="image/png" sizes="160x160" href="<?php echo B_URL; ?>system/img/favicon-160.png"/>
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo B_URL; ?>system/img/favicon-96.png"/>
        <link rel="icon" type="image/png" sizes="64x64" href="<?php echo B_URL; ?>system/img/favicon-64.png"/>
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo B_URL; ?>system/img/favicon-32.png"/>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo B_URL; ?>system/img/favicon-16.png"/>
        <link rel="apple-touch-icon" href="<?php echo B_URL; ?>system/img/favicon-57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo B_URL; ?>system/img/favicon-114.png"/>
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo B_URL; ?>system/img/favicon-72.png"/>
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo B_URL; ?>system/img/favicon-144.png"/>
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo B_URL; ?>system/img/favicon-60.png"/>
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo B_URL; ?>system/img/favicon-120.png"/>
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo B_URL; ?>system/img/favicon-76.png"/>
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo B_URL; ?>system/img/favicon-152.png"/>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo B_URL; ?>system/img/favicon-180.png"/>
        <meta name="msapplication-TileColor" content="#FFFFFF"/>
        <meta name="msapplication-TileImage" content="<?php echo B_URL; ?>system/img/favicon-144.png"/>
        <meta name="msapplication-config" content="<?php echo B_URL; ?>system/img/browserconfig.xml"/>
        <link href="<?php echo B_URL; ?>site/system/css/columnal.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo B_URL; ?>site/system/css/stylemenu.css" rel="stylesheet" />
        <link href="<?php echo B_URL; ?>site/system/css/meanmenu.css" rel="stylesheet" type="text/css"/>        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
        <script src="<?php echo B_URL; ?>system/js/image-scale.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $("img.scale").imageScale({
                    rescaleOnResize: true
                });
            });
        </script>
        <script src="<?php echo B_URL; ?>system/js/jquery.easing.1.3.js" type="text/javascript"></script>
        <script src="<?php echo B_URL; ?>system/js/jquery-te-1.4.0.min.js" type="text/javascript"></script>               
        <script src="<?php echo SYST; ?>ckeditor/ckeditor.js" type="text/javascript"></script> 
        <script type="text/javascript">
            CKEDITOR.on('dialogDefinition', function (event) {
                var editor = event.editor,
                        dialogDefinition = event.data.definition,
                        tabCount = dialogDefinition.contents.length,
                        uploadButton, submitButton, inputId,
                        elfUrl = editor.config.filebrowserUploadUrl,
                        // elFinder configs
                        elfDirHashMap = {// Dialog name / elFinder holder hash Map
                            image: '',
                            flash: '',
                            files: '',
                            link: '',
                            fb: 'l1_Lw' // fallback target
                        },
                        customData = {}; // any custom data to post

                for (var i = 0; i < tabCount; i++) {
                    uploadButton = dialogDefinition.contents[i].get('upload');
                    submitButton = dialogDefinition.contents[i].get('uploadButton');

                    if (uploadButton !== null && submitButton !== null) {
                        uploadButton.hidden = false;
                        submitButton.hidden = false;
                        uploadButton.onChange = function () {
                            inputId = this.domId;
                        }
                        submitButton.onClick = function (e) {
                            dialogName = CKEDITOR.dialog.getCurrent()._.name;
                            var target = elfDirHashMap[dialogName] ? elfDirHashMap[dialogName] : elfDirHashMap['fb'],
                                    name = $('#' + inputId),
                                    input = name.find('iframe').contents().find('form').find('input:file'),
                                    error = function (err) {
                                        alert(err.replace('<br>', '\n'));
                                    };

                            if (input.val()) {
                                var fd = new FormData();
                                fd.append('cmd', 'upload');
                                fd.append('overwrite', 0); // disable upload overwrite to make to increment file name
                                fd.append('target', target);
                                $.each(customData, function (key, val) {
                                    fd.append(key, val);
                                });
                                fd.append('upload[]', input[0].files[0]);
                                $.ajax({
                                    url: elfUrl,
                                    type: 'POST',
                                    data: fd,
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json'
                                })
                                        .done(function (data) {
                                            if (data.added && data.added[0]) {
                                                var url = data.added[0].url;
                                                var dialog = CKEDITOR.dialog.getCurrent();
                                                if (dialogName == 'image') {
                                                    var urlObj = 'txtUrl'
                                                } else if (dialogName == 'flash') {
                                                    var urlObj = 'src'
                                                } else if (dialogName == 'files' || dialogName == 'link') {
                                                    var urlObj = 'url'
                                                } else {
                                                    return;
                                                }
                                                dialog.selectPage('info');
                                                dialog.setValueOf(dialog._.currentTabId, urlObj, url);
                                            } else {
                                                error(data.error || data.warning || 'errUploadFile');
                                            }
                                        })
                                        .fail(function () {
                                            error('errUploadFile');
                                        })
                                        .always(function () {
                                            input.val('');
                                        });
                            }
                            return false;
                        }
                    }
                }
            });
        </script>
        <script>
            $(function () {
                $("#slider-range-min").slider({
                    range: "min",
                    value: 4,
                    min: 1,
                    max: 10,
                    slide: function (event, ui) {
                        $("time").val(ui.value + "000");
                    }
                });
                $("#time").val($("#slider-range-min").slider("value") + "000");
            });
        </script>
        <script>
            $('textarea').ckeditor();

            $('form').ajaxSubmit({
                beforeSubmit: function () {
                    // The textarea is already updated now and has the same value as the editor, so you can validate it.
                }
            });
        </script>  
        <script>
            //(set the floating bar)            
            $(function () {

                var menu = $('#headm'),
                        pos = menu.offset();

                $(window).scroll(function () {
                    if ($(this).scrollTop() > pos.top + menu.height() && menu.hasClass('default')) {
                        menu.fadeOut('fast', function () {
                            $(this).removeClass('default').addClass('fixed').fadeIn('fast');
                        });
                    } else if ($(this).scrollTop() <= pos.top && menu.hasClass('fixed')) {
                        menu.fadeOut('fast', function () {
                            $(this).removeClass('fixed').addClass('default').fadeIn('fast');
                        });
                    }
                });

            });
        </script>           
    </head>
    <body>
        <div id="main">