<?

require_once "libs/spyc/Spyc.php";
$data = Spyc::YAMLLoadString(file_get_contents("config.yml"));
$header = $data["header"];
$theme = $header["theme"];

if (!file_exists('themes/' . $theme . '/theme.php')) {
    $theme = 'bootstrap';
}

$theme_folder_url = 'themes/' . $theme;

require_once 'themes/' . $theme . '/theme.php';
if (isset($_POST["pwd"]) && $_POST["pwd"] == $data["header"]["password"]) {
    $info_msg = "";
    if (isset($_POST["submit"])) {
        submit();
    }
    page($data, $info_msg, $_POST["pwd"]);
} else {
    signin($data);
}

function submit() {
    global $data, $header, $info_msg;
    $info_msg = postReplace($str);
    if (isset($header["exec"])) {
        $exec_str = postReplace($header["exec"]);
        $info_msg = isset($header["info"]) ? $header["info"] : "";
        $output = exec($exec_str);
        $info_msg = str_replace("{{exec_output}}", $output, $info_msg);
    }
    if (isset($header["mysql_exec"])) {
        $db = new mysqli($header["server"], $header["user"], $header["password"], $header["database"]);
        if ($db->connect_errno) {
            printf("Connect failed: %s\n", $db->connect_error);
            exit();
        }
        $ret = $db->query(postReplace($header["query"])) or print($this->db->error) && exit();
    }
}

function postReplace($str) {
    foreach ($_POST as $key => $value) {
        if ($key != "submit" && $key != "pwd") {
            $str = str_replace("{{" . substr($key, 1) . "}}", $value, $str);
        }
    }
    return $str;
}
?>