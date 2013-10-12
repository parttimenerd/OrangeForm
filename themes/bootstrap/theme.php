<?php

function page($data, $info_msg, $password){
    global $data, $info_msg, $header, $theme_folder_url;
    include('templates/page.php');
}

/**
 * Outputs an html input element
 * 
 * @param array $args array("value" => "", "label" => "", "type" => "textarea|inputfield|checkbox|password|usermode|color|email", "css_class" => "", "js_onchange" => "")
 */
function tpl_input($name = "default", $args = array("value" => "", "placeholder" => "", "onchange" => "")) {
    $value = isset($args["default"]) ? $args["default"] : (isset($args["value"]) ? $args["value"] : "");
    $type = "inputfield";
    if (isset($args["type"])) {
        $type = $args["type"];
    } else if (is_numeric($value)) {
        $type = "number";
    } else if ($value == "true" || $value == "false") {
        $type = "checkbox";
    }
    $id = isset($args["id"]) ? $args["id"] : $name;
    $str = 'name="' . $name . '" id="' . $id . '"';
    if (isset($args["placeholder"]) && $args["placeholder"] != "")
        $str .= ' placeholder="' . $args["placeholder"] . '" ';
    if (isset($args["js_onchange"]) && $args["js_onchange"] != "")
        $str .= ' onchange="' . $args["js_onchange"] . '" ';
    if (isset($args["required"]) && $args["required"] != "")
        $str .= ' required="' . $args["required"] . '" ';
    switch ($type) {
        case "textarea":
            echo '<textarea ' . $str . ' class="textarea">' . $value . '</textarea>';
        case "number":
            echo "<input type='number' " . $str . " value='" . $value . "'/>";
            break;
        case "inputfield":
            echo "<input type='text' " . $str . " value=\"" . $value . "\"/>";
            break;
        case "password":
            echo '<input type="password" ' . $str . ' value="' . $value . '"/>';
            break;
        case "checkbox":
            echo '<input type="checkbox" ' . $str . ' value="true"' . ($value == "true" ? ' checked="checked"' : '') . '/>';
            break;
        case "color":
            tpl_color_selector($name, $value, isset($args["js_onchange"]) && $args["js_onchange"] != "" ? $args["js_onchange"] : "", $id);
            break;
        case "email":
            echo '<input type="email" ' . $str . ' value="' . $value . '"/>';
            break;
    }
}

function tpl_color_selector($name, $default_value = "#ff0000", $js_onchange = "", $id = "") {
    if ($id == "") {
        $id = $name . rand(0, 100);
    }
    ?>
    <input type="text" name="<?php echo $name ?>" style="background: <?= $default_value ?>" value="<?php echo $default_value ?>" id="<?php echo $id ?>"/>
    <script>
        $('body').ready(function() {
            $('#<?php echo $id ?>').colorPicker({
                color: '<?php echo $default_value ?>',
                onShow: function(colpkr) {
                    $(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function(colpkr) {
                    $(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function(hsb, hex, rgb) {
                    $('#<?= $id ?>').css('backgroundColor', '#' + hex);
                    $("#<?= $id ?>").attr("value", "#" + hex);
    <?php
    if ($js_onchange != "") {
        echo $js_onchange . (substr($js_onchange, strlen($js_onchange) - 2) != ';' ? ';' : '');
    }
    ?>
                },
                onSubmit: function(hsb, hex, rgb) {
                    $('#<?php echo $id ?>').css('backgroundColor', '#' + hex);
    <?php
    if ($js_onchange != "") {
        echo $js_onchange . (substr($js_onchange, strlen($js_onchange) - 2) != ';' ? ';' : '');
    }
    ?>
                }
            });
        });
    </script>
    <?php
}

function signin($data){
    global $header, $theme_folder_url;
    include 'templates/signin.php';
}

function footer(){
    include 'templates/footer.php';
}
?>
