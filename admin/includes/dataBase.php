<?php

include 'connection.php';
if ($db_pass == "") {
    date_default_timezone_set('Asia/Karachi');
} else {
    date_default_timezone_set('America/Toronto');
//    echo date_default_timezone_get();
//    exit();
//    date_default_timezone_set('UTC');
}

Class DataBase {

    public function getSession_id() {

        if (isset($_SESSION['user'])) {
            return $_SESSION['user']['id'];
        }
    }

    public function query($con, $sql) {
        $result = mysqli_query($sql, MYSQLI_ASSOC);
        if (!$result) {
            error("Can not run your query");
        }
        return $result;
    }

    public function mysql_prep($value) {
        $magic_qoutes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists("mysql_real_escape_string");
        if ($new_enough_php) {
            if ($magic_qoutes_active) {
                $value = stripcslashes($value);
            }
            $value = mysql_real_escape_string($value);
        } else {
            if (!$magic_qoutes_active) {
                $value = addslashes($value);
            }
        }
        return $value;
    }

    public function getName($con, $id) {

        $query = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '" . $id . "'");
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            return $row['contact_name'];
        }
    }

    public function lastID($con) {
        return mysqli_insert_id($con);
    }

    public function select_all($tablename) {
        $query = mysql_query("SELECT * FROM $tablename");
        while ($row = mysql_fetch_array($query)) {
            
        }
    }

    public function insert_user($username) {
        $query = mysql_query("INSERT INTO `users` SET `username` = '" . $username . "'");

        if (!$query) {
            return 'error';
        }
    }

    public function error($error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }

    public function error_front($error) {
        echo '<div class="alert alert-danger col-lg-6"><i class="fa fa-exclamation-triangle"></i> ' . $error . '</div>';
    }

    public function success($success) {
        echo '<div class="alert alert-success">' . $success . '</div>';
    }

    public function warning($warning) {
        echo '<div class="alert alert-warning">' . $warning . '</div>';
    }

    public function info($info) {
        echo '<div class="alert alert-info">' . $info . '</div>';
    }

    public function getCurrentPage() {
        $currentFile = $_SERVER["PHP_SELF"];
        $parts = Explode('/', $currentFile);
        return $parts[count($parts) - 1];
    }

    public function getUserIP() {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    public function add_user_activity($con, $activity) {
        $new_activity = mysqli_real_escape_string($con, $activity);
        $queryAddActivity = mysqli_query($con, "INSERT INTO `user_activity` SET `user_id` = '" . $this->getSession_id() . "', `activity` = '" . $new_activity . "', `ip_address` = '" . $this->getUserIP() . "'");
    }

    public function delete_row($del_id, $table_name) {
        $query_delete = mysql_query("DELETE FROM $table_name WHERE `id` = '" . $del_id . "'");
        if (!$query_delete) {
            $this->error("Can not be deleted at the moment, Contact admin support");
        } else {
            $this->add_user_activity("Deleted an item from <strong>$table_name</strong> page.");
            $this->success("Your record has been deleted.");
        }
    }

    public function redirect($page) {
        header('Location:' . $page);
        exit();
    }

    public function getEach($con, $col, $table_name) {
//million dollar function
        $q = "SELECT `{$col}` FROM `{$table_name}` LIMIT 1";
        $r = mysqli_query($con, $q);
        while ($i = mysql_fetch_array($r, MYSQLI_ASSOC)) {
            $j = $i[$col];
        }
        return $j;
    }

    public function getEachById($con, $col, $table_name, $id) {
        $q = "SELECT `{$col}` FROM `{$table_name}` WHERE `id` = {$id}";
        $r = mysqli_query($con, $q);
        while ($i = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $j = $i[$col];
        }
        return $j;
    }

    public function getEachByWhere($con, $col, $table_name) {
        $q = "SELECT `{$col}` FROM `{$table_name}` WHERE `primary_image` = 1";
        $r = mysqli_query($con, $q);
        while ($i = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $j = $i[$col];
        }
        return $j;
    }

    public function getEachByEmail($con, $col, $table_name, $email) {
        $q = "SELECT `{$col}` FROM `{$table_name}` WHERE `email` = '" . $email . "'";
        $r = mysqli_query($con, $q);
        while ($i = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $j = $i[$col];
        }
        return $j;
    }

    public function getEmailByMd5($con, $col, $md5) {
        $q = "SELECT `{$col}` FROM `public_users` WHERE `forgotten` = '" . $md5 . "'";
        $r = mysqli_query($con, $q);
        while ($i = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $j = $i[$col];
        }
        return $j;
    }

    public function getIdByEach($con, $col, $table_name, $name) {
        $newName = mysqli_real_escape_string($con, $name);
        echo $q = "SELECT `{$col}` FROM `{$table_name}` WHERE `contact_name` = {$newName}";
        $r = mysqli_query($con, $q);
        while ($i = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $j = $i[$col];
        }
        return $j;
    }

    public function form_help_isset($field) {
        if (isset($_POST[$field])) {
            echo $_POST[$field];
        }
    }

    public function check_email($con, $email) {

        $dup = mysqli_query($con, "SELECT `email` FROM `users` WHERE `email` = '" . $email . "'");
        if (mysqli_num_rows($dup) > 0) {
            $email_exits = 'yes';
        } else {
            $email_exits = 'no';
        }
    }

    public function check_public_email($con, $email) {

        $dup = mysqli_query($con, "SELECT `email` FROM `public_users` WHERE `email` = '" . $email . "'");
        if (mysqli_num_rows($dup) > 0) {
            $email_exits = 'yes';
        } else {
            $email_exits = 'no';
        }
    }

    public function check_lead($con, $lead_id) {

        $dup = mysqli_query($con, "SELECT * FROM `leads` WHERE `lead_id` = '" . $lead_id . "'");
        if (mysqli_num_rows($dup) >= 0) {
            return 'yes';
        } else {
            return 'no';
        }
    }

    public function get_currency($from_Currency, $to_Currency, $amount) {
        $amount = urlencode($amount);
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);

        $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

        $ch = curl_init();
        $timeout = 0;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);
        $data = explode('bld>', $rawdata);
        $data = explode($to_Currency, $data[1]);

        return round($data[0], 2);
    }

    public function get_rate($id_by, $rate) {
        $rate = $this->get_currency('GBP', $this->getEachById('currency', 'users', $_SESSION['user']['id']), $rate);
        if ($this->getEachById('currency', 'users', $_SESSION['user']['id']) != $this->getEachById('currency', 'users', $id_by)) {
            echo $rate;
        } else {
            echo 'Currency is the same';
        }
    }

    public function get_currency_sign($id) {
        $currency_user = $this->getEachById('currency', 'users', $id);
        if ($currency_user == 'GBP') {
            $currency_sign = '<i class="fa fa-gbp"></i>';
        } else if ($currency_user == 'USD') {
            $currency_sign = '<i class="fa fa-usd"></i>';
        } else if ($currency_user == 'EUR') {
            $currency_sign = '<i class="fa fa-eur"></i>';
        }
        return $currency_sign;
    }

    public function explode($string) {
        $pieces = explode("-", $string);
        return $pieces[0]; // piece1
//        echo $pieces[1]; // piece2
    }

    public function num_rows_where($con, $table_name, $id) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name WHERE `by_id` = '" . $id . "'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function num_rows_where_active($con, $table_name, $id) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name WHERE `id` = '" . $id . "' AND `status` = 'active'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function num_rows_where_inactive($con, $table_name, $id) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name WHERE `by_id` = '" . $id . "' AND `status` = 'inactive'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function num_rows_where_complete($con, $table_name, $id) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name WHERE `by_id` = '" . $id . "' AND `status` = 'complete'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function num_rows($con, $table_name, $product) {
        $result = mysql_query("SELECT count(*) as total FROM $table_name WHERE `product` = '" . $product . "'");
        $data = mysql_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows_active($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM `$table_name` WHERE  NOT `progress`= '0' AND NOT `progress` = '100' AND NOT `progress` = 'New' ORDER BY `id` DESC ");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows_verified_web($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM `$table_name` WHERE  `verification_status` = 1");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows_active_projects($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM `$table_name` WHERE  `internal_lead_id` IS NOT NULL ORDER BY `id` DESC ");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows_residential($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM `$table_name` WHERE  `type`='residential'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo $data['total'];
    }

    public function count_rows_commercial($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM `$table_name` WHERE  `type`='commercial'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function property_type_count($con, $table_name, $property_type) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM `$table_name` WHERE  `property_type`='" . $property_type . "' AND `verification_status` = '1'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function property_city_count($con, $table_name, $city) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM `$table_name` WHERE  `city`='" . $city . "' AND `verification_status` = '1'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows_new($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name WHERE `progress` = '0'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows_new_web($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name WHERE `verification_status` = 0");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows_complete($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name WHERE `progress` = '100'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function count_rows_complete_web($con, $table_name) {
        $result = mysqli_query($con, "SELECT count(*) as total FROM $table_name WHERE `status` = 'complete'");
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $data['total'];
    }

    public function num_rows_activity($table_name, $id) {
        $result = mysql_query("SELECT count(*) as total FROM `$table_name` WHERE `user_id` = '$id' ");
        $data = mysql_fetch_assoc($result);
        return $data['total'];
    }

    public function num_rows_messages($id) {
        $result = mysql_query("SELECT count(*) as total FROM `messages` WHERE `inventory_user_id` = '$id' || `chat_by_user_id` = '" . $id . "' ");
        $data = mysql_fetch_assoc($result);
        return $data['total'];
    }

    public function num_rows_condition($table_name, $product, $condition) {
        $result = mysql_query("SELECT count(*) as total FROM `$table_name` WHERE `model` = '$product' AND `condition` = '$condition' ");
        $data = mysql_fetch_assoc($result);
        return $data['total'];
    }

    public function get_quantity($product, $condition) {
        $query = mysql_query("SELECT SUM(`qty`) as sum FROM `inventory` WHERE `model` = '$product' AND `condition` = '$condition'");
        $data = mysql_fetch_assoc($query);

        if ($data['sum'] == NULL) {
            return 0;
        } else {
            return $data['sum'];
        }
    }

    public function get_lowest_price($product, $condition) {
        $query = mysql_query("SELECT * FROM `inventory` WHERE `model` = '" . $product . "' AND `condition` = '" . $condition . "' ORDER BY `reseller_price` DESC LIMIT 1");
        while ($row = mysql_fetch_array($query)) {
            if (empty($row['reseller_price']) || $row['reseller_price'] == NULL) {
                return 0;
            } else {
                return $row['reseller_price'];
            }
        }
    }

    public function get_highest_price($product, $condition) {
        $query2 = mysql_query("SELECT * FROM `inventory` WHERE `model` = '" . $product . "' AND `condition` = '" . $condition . "' ORDER BY `reseller_price` ASC LIMIT 1");
        while ($row2 = mysql_fetch_array($query2)) {
            if (empty($row2['reseller_price']) || $row2['reseller_price'] == NULL) {
                return 0;
            } else {
                return $row2['reseller_price'];
            }
        }
    }

    public function add_search_activity($user_id, $product, $name, $company, $phone, $email) {
        $query = mysql_query("INSERT INTO `search_activity` SET `user_id` = '" . $user_id . "', `product` = '" . $product . "', `contact_name` = '" . $name . "', `company` = '" . $company . "', `phone` = '" . $phone . "', `email` = '" . $email . "'");
//        if(!$query){
//            $this->error('Your search can not be added at this moment.');
//        }
    }

    public function add_amount($amount) {
        $query = mysql_query("INSERT INTO `cash_entries` SET `amount` = '" . $amount . "'");
    }

    public function getRole($id) {
        $query = mysql_query("SELECT * FROM `users` WHERE `id` = '" . $id . "'");
        while ($row = mysql_fetch_array($query)) {
            $role = $row['role'];
        }
        return $role;
    }

    public function lock_user($id) {
        if (isset($_SESSION['user'])) {
            $this->redirect('lock?id=' . $id);
            exit();
        }
    }

    public function searched_today($product) {
        $result = mysql_query("SELECT count(*) as total FROM `search_activity` WHERE `product` = '" . $product . "' AND datediff(NOW(), `timestamp`) <= 1 ");
        $data = mysql_fetch_assoc($result);
        echo $data['total'];
    }

    public function searched_last_week($product) {
        $result = mysql_query("SELECT count(*) as total FROM `search_activity` WHERE `product` = '" . $product . "' AND datediff(NOW(), `timestamp`) <= 1 ");
        $data = mysql_fetch_assoc($result);
        echo $data['total'];
    }

    public function searched_last_month($product) {
        $result = mysql_query("SELECT count(*) as total FROM `search_activity` WHERE `product` = '" . $product . "' AND datediff(NOW(), `timestamp`) <= 1 ");
        $data = mysql_fetch_assoc($result);
        echo $data['total'];
    }

    public function get_time_ago($time_stamp) {
        $time_difference = strtotime('now') - $time_stamp;

        if ($time_difference >= 60 * 60 * 24 * 365.242199) {
            /*
             * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
             * This means that the time difference is 1 year or more
             */
            return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 365.242199, 'year');
        } elseif ($time_difference >= 60 * 60 * 24 * 30.4368499) {
            /*
             * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
             * This means that the time difference is 1 month or more
             */
            return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 30.4368499, 'month');
        } elseif ($time_difference >= 60 * 60 * 24 * 7) {
            /*
             * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
             * This means that the time difference is 1 week or more
             */
            return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 7, 'week');
        } elseif ($time_difference >= 60 * 60 * 24) {
            /*
             * 60 seconds/minute * 60 minutes/hour * 24 hours/day
             * This means that the time difference is 1 day or more
             */
            return $this->get_time_ago_string($time_stamp, 60 * 60 * 24, 'day');
        } elseif ($time_difference >= 60 * 60) {
            /*
             * 60 seconds/minute * 60 minutes/hour
             * This means that the time difference is 1 hour or more
             */
            return $this->get_time_ago_string($time_stamp, 60 * 60, 'hour');
        } else {
            /*
             * 60 seconds/minute
             * This means that the time difference is a matter of minutes
             */
            return $this->get_time_ago_string($time_stamp, 60, 'minute');
        }
    }

    public function getElapsedTime($eventTime) {
        $totaldelay = time() - strtotime($eventTime);
        if ($totaldelay <= 0) {
            return '';
        } else {
            if ($days = floor($totaldelay / 86400)) {
                $totaldelay = $totaldelay % 86400;
                return $days . ' days ago.';
            }
            if ($hours = floor($totaldelay / 3600)) {
                $totaldelay = $totaldelay % 3600;
                return $hours . ' hours ago.';
            }
            if ($minutes = floor($totaldelay / 60)) {
                $totaldelay = $totaldelay % 60;
                return $minutes . ' minutes ago.';
            }
            if ($seconds = floor($totaldelay / 1)) {
                $totaldelay = $totaldelay % 1;
                return $seconds . ' seconds ago.';
            }
        }
    }

    public function selectRows($table, $where = "") {
        $q = "SHOW COLUMNS FROM $table";
        $r = mysql_query($q, $this->dbLink);
        while ($res = mysql_fetch_array($r)) {
//echo $res[1]."<br>"; 
            if (($res[1] == "timestamp14") || ($res[1] == "datetime")) {
                $retField[] = "DATE_FORMAT($res[0], '%d %b %Y at %H:%i:%s') AS $res[0]";
            } else {
                $retField[] = $res[0];
            }
        }

        $fields = implode(",", $retField);
        $q = "select $fields from $table $where";
        $this->sql = $q;
//$this->log();
        $r = mysql_query($q, $this->dbLink);
        $num = mysql_num_rows($r);
        $i = 1;
        while ($row = mysql_fetch_array($r)) {
            $cont[$i] = $row;
            $i++;
        }
        if (mysql_num_rows($r) > 0) {
            return $cont;
        }
    }

    public function updateEachById($table, $field, $value, $id) {
        $query = mysql_query("UPDATE $table SET $field = '" . $value . "' WHERE `id` = '" . $id . "'");
        if (!$query) {
            $this->error("<strong>Error! </strong> Your query can not be updated at the moment!");
        }
    }

    public function error_log() {
        $fp = fopen("sql_error.log", "a");
        if (flock($fp, LOCK_EX)) {
            $sql = str_replace("\n", " ", $this->sql);
            fputs($fp, date("d-m-Y h:i:s") . " --> $sql\n");
            flock($fp, LOCK_UN);
        }
        fclose($fp);

        $strHTML = "<HTML><HEAD><TITLE>DEBUG CONSOLE</TITLE></HEAD><BODY>";
        $strHTML .= "<div id='mysql_error_div'><table width='70%' align='center' border='0' cellspacing='0' cellpadding='0'>";
        $strHTML .= "<tr><td width='1%' align='center' bordercolor='#000000' bgcolor='#FF0000'>&nbsp;</td>";
        $strHTML .= "<td width='98%' align='center' bordercolor='#000000' bgcolor='#FF0000'><font color=#FFFFFF face='verdana' size='+1'>DEBUG CONSOLE</font> </td>";
        $strHTML .= "<td width='1%' align='center' bordercolor='#000000' bgcolor='#FF0000'>&nbsp;</td></tr>";
        $strHTML .= "<tr><td bgcolor='#FF0000'>&nbsp;</td><td>&nbsp;</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";
        $strHTML .= "<tr><td bgcolor='#FF0000'>&nbsp;</td><td style='padding-left:10px'><strong>Query:</strong></td><td bgcolor='#FF0000'>&nbsp;</td></tr>";
        $strHTML .= "<tr><td bgcolor='#FF0000'>&nbsp;</td><td style='padding-left:20px'>$sql</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";
        $strHTML .= "<tr><td bgcolor='#FF0000'>&nbsp;</td><td>&nbsp;</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";
        $strHTML .= "<tr><td bgcolor='#FF0000'>&nbsp;</td><td style='padding-left:10px'><strong>Mysql Response:</strong></td><td bgcolor='#FF0000'>&nbsp;</td></tr>";
        $strHTML .= "<tr><td bgcolor='#FF0000'>&nbsp;</td><td style='padding-left:20px'>" . mysql_error() . "------" . $_SERVER['PHP_SELF'] . "</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";
        $strHTML .= "<tr><td bgcolor='#FF0000'>&nbsp;</td><td>&nbsp;</td><td bgcolor='#FF0000'>&nbsp;</td></tr>";
        $strHTML .= "<tr><td colspan='3' bgcolor='#FF0000' height='2'></td></tr></table>";
        $strHTML .= "</div></BODY></HTML>";

        echo $strHTML;
    }

    public function insertArr($tableName, $insData) {
        $columns = implode(", ", array_keys($insData));
        $escaped_values = array_map('mysql_real_escape_string', array_values($insData));
        foreach ($escaped_values as $idx => $data)
            $escaped_values[$idx] = "'" . $data . "'";
        $values = implode(", ", $escaped_values);
        echo $query = "INSERT INTO `$tableName` (`user_id`,`model`, `qty`,`condition`,`lead_time`,`reseller_price`,`enduser_price`, `location`) VALUES ($id,$values)";
        mysql_query($query) or die(mysql_error());
    }

    public function check_texts_status_count($id) {
        $query = mysql_query("SELECT * FROM `messages` WHERE `inventory_user_id` = '" . $id . "' || `chat_by_user_id` = '" . $id . "'");
        while ($row = mysql_fetch_array($query)) {
            echo $row['id'] . '<br />';
        }
    }

    public function limit_chars($string) {
        // strip tags to avoid breaking any html

        $string = strip_tags($string);

        if (strlen($string) > 50) {

// truncate string
            $stringCut = substr($string, 0, 50);

// make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
        }
        return $string;
    }

    public function limit_chars_by($string, $limit) {
        // strip tags to avoid breaking any html

        $string = strip_tags($string);

        if (strlen($string) > $limit) {

// truncate string
            $stringCut = substr($string, 0, $limit);

// make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
        }
        return $string;
    }

    public function getMonth($timestamp) {
        $month = date("m", strtotime($timestamp));
        return $month;
    }

    public function getYear($timestamp) {
        $month = date("y", strtotime($timestamp));
        return $month;
    }

    public function add_views($con, $gotten_post_id) {

        $getViews = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `id` = '" . $gotten_post_id . "' LIMIT 1");
        while ($row = mysqli_fetch_array($getViews, MYSQLI_ASSOC)) {
            $final_views = $row['views'] + 1;
            $queryInsertView = mysqli_query($con, "UPDATE `web_posts` SET `views` = '" . $final_views . "' WHERE `id` = '" . $gotten_post_id . "'");
        }



//        $query = mysqli_query($con,'INSERT INTO ');
    }

    public function add_views_project($con, $gotten_post_id) {

        $getViews = mysqli_query($con, "SELECT * FROM `projects` WHERE `id` = '" . $gotten_post_id . "' LIMIT 1");
        while ($row = mysqli_fetch_array($getViews, MYSQLI_ASSOC)) {
            $final_views = $row['views'] + 1;
            $queryInsertView = mysqli_query($con, "UPDATE `projects` SET `views` = '" . $final_views . "' WHERE `id` = '" . $gotten_post_id . "'");
        }



//        $query = mysqli_query($con,'INSERT INTO ');
    }

    public function getImagesFromGallery($con, $gotten_post_id) {

        $query_get_images = mysqli_query($con, "SELECT * FROM `property_images` WHERE `web_post_id` = '" . $gotten_post_id . "'");

        while ($row = mysqli_fetch_array($query_get_images, MYSQLI_ASSOC)) {

            echo '<div class="carousel-item"><img src="' . $row['image_link'] . '" class="d-block w-100" alt=""><div class="carousel-caption d-none d-md-block"><h1>that</h1></div></div>';
        }
    }

    public function getFromDateTime($timestamp) {
//        return $timestring = $timestamp->format('Y-m-d h:i:s');

        return date('Y, m, d', strtotime($timestamp));

//        $datetime = new DateTime($timestamp);
//        return $datetime->format('w');
    }

    public function getLatestTimeStamp($con, $table_name) {
        $query = mysqli_query($con, "SELECT `timestamp` FROM `$table_name` ORDER BY `id` DESC LIMIT 1");
        while ($row = mysqli_fetch_assoc($query)) {
            return $row['timestamp'];
        }
    }

    public function getMaxLeadId($con) {
        $query = mysqli_query($con, "SELECT MAX( lead_id ) AS max FROM `internal_leads`");
        while ($row = mysqli_fetch_assoc($query)) {
//            $sub_total += ((int)$item['quantity'] + (int)1);
            return (int) $row['max'] + 1;
        }
    }

    public function getDataWithId($id, $con) {
        $query = "SELECT * FROM `project_investors` WHERE `id` = $id";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}


$db = new DataBase();
