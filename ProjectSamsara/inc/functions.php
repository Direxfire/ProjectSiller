<?php
class user
{
    function admin($db_connect)
    {
        @session_start();
        $SQL = $db_connect -> prepare("SELECT `Role` FROM `login` WHERE `ID` = :id");
        $SQL -> execute(array(':id' => $_SESSION['ID']));
        $rank = $SQL -> fetchColumn(0);
        if ($rank == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function LoggedIn($db_connect)
    {
        @session_start();
        if (isset($_SESSION['Team_Number'], $_SESSION['ID'])) {
            return true;
        }
        else {
            return false;
        }
    }
    function limited($db_connect)
    {
        @session_start();
        $SQL = $db_connect -> prepare("SELECT `Role` FROM `login` WHERE `ID` = :id");
        $SQL -> execute(array(':id' => $_SESSION['ID']));
        $rank = $SQL -> fetchColumn(0);
        if($rank == 0) {
            return true;
        } else {
            return false;
        }
    }
    function contribute($db_connect)
    {
        @session_start();
        $SQL = $db_connect -> prepare("SELECT `Role` FROM `login` WHERE `ID` = :id");
        $SQL -> execute(array(':id' => $_SESSION['ID']));
        $rank = $SQL -> fetchColumn(0);
        if($rank == 2 OR $rank == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>
