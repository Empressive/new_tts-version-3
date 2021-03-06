<?php

class MVcore
{
    public $user_id = '';

    public $user_access = '';

    public $page = "";

    public static function gInst()
    {
        $core = new MVcore();
        $core->AUsr();
        $core->LReq();
        $core->ICont();
    }

    public function AUsr()
    {
        include_once('library/MVdb.php');

        MVdb::connect();

        $this->user_id = 0;

        if (isset($_SESSION['user_id'])) {

            $this->user_id = $id = intval($_SESSION['user_id']);

            $query = mysql_query("SELECT access_id FROM staff_login WHERE id = '$id'");
            $result = mysql_fetch_assoc($query);

            $this->user_access = $result['access_id'];
        } elseif (isset($_COOKIE['user_id']) && isset($_COOKIE['token'])) {

            $id = intval($_COOKIE['user_id']);

            $query = mysql_query("SELECT token, access_id FROM staff_login WHERE id = '$id'");
            $result = mysql_fetch_assoc($query);

            $user_token = $result['token'];

            if ($_COOKIE['token'] == $user_token) {

                session_start();

                $this->user_id = $_COOKIE['user_id'];
                $this->user_access = $result['access_id'];
                $_SESSION['user_id'] = $_COOKIE['user_id'];

            }
        }
    }

    public function LReq()
    {
        if ($this->user_id !== 0 && $this->user_access > 0) {
            if ($_GET['page']) {

                $request = htmlspecialchars(trim($_GET['page']));
                $page = "pages/$request.php";
                $error = "pages/404.php";

                if (file_exists($page)) $this->page = $page;
                else $this->page = $error;

            } else {

                $tablePage = "pages/table.php";
                $this->page = $tablePage;

            }
        } else $this->page = "pages/log.php";
    }

    public function ICont()
    {
        session_start();

        include_once('include/header.php');

        if (!isset($_GET['page']) && $this->user_id > 0 && $this->user_access > 0) include_once('include/announce.php');

        if (!isset($_GET['page']) && $this->user_id > 0 && $this->user_access > 0) include_once('include/filter.php');

        include_once("$this->page");

        include_once('include/footer.php');
    }
}
