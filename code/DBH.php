<?php
/**
 * Core file contains all db activity methods
 *
 * Contains all methods for CRUD with MySQL database using PHP
 *
 * @author  Srikanth Matheesh <phpsri@gmail.com>
 *
 * @version 1.0
 *
 * @since 1.0
 *
 */
    class DBH
    {
        /**
         * @var  $dbhost
        */
        protected $dbhost = 'localhost';

        /**
         * @var  $dbuser
        */
        protected $dbuser = 'root';

        /**
         * @var  $dbpass
        */
        protected $dbpass = '';

        /**
         * @var  $dbname
        */
        protected $dbname = 'exads';

        /**
         * @var  $num_rec_per_page
        */
        protected $num_rec_per_page = 20;

        /**
        * Connection to MySql database using PDO
        * @param null
        * @return database connection string
        */
        public function getConnection()
        {
            $dbhost = $this->dbhost;
            $dbuser = $this->dbuser;
            $dbpass = $this->dbpass;
            $dbname = $this->dbname;

            try {
                $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $dbh;
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }

        /**
        * Generate page count for a table
        * @param string $table
        * @return int page_count
        */
        public function getPageCount($table)
        {
            $sql = "select count(*) as total from {$table}";
            try {
                $db = $this->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $count = $stmt->fetch(PDO::FETCH_ASSOC);
                $db = null;
                if (!empty($count)) {
                    return ceil($count['total'] / RECORDS_PER_PAGE);
                } else {
                    return 0;
                }
            } catch (PDOException $e) {
                return 0;
            }
        }

        /**
        * insert records into a specific table
        * @param string $table
        * @param array $options
        * @return array $output
        */
        public function insert_record($table, $options = array())
        {
            $db = $this->getConnection();

            $post_keys = array_keys($options);
            $table_keys = "`" . implode("`, `", $post_keys) . "`";
            $table_keys_map = ':'. implode(", :", $post_keys);

            $sql = "INSERT into `{$table}` ({$table_keys}) VALUES ({$table_keys_map})";

            $stmt = $db->prepare($sql);
            foreach ($options as $key => $value) {
                $ukey = ":{$key}";
                $uvalue = $value;
                $stmt->bindParam($ukey, $uvalue);
                unset($ukey);
                unset($uvalue);
            }
            if ($stmt->execute()) {
                $output['status'] = 'MESSAGE_SUCCESS';
            } else {
                $output['status'] = 'MESSAGE_FAILURE';
            }

            $db = null;
            return $output;
        }

        /**
        * update a record on specific table
        * @param string $table
        * @param array $options
        * @return array $output
        */
        public function update_record($table, $options = array())
        {
            $output = '';
            $db = $this->getConnection();
            $post_keys = array_keys($options);

            if (!empty($options['conditions'])) {
                $conditions =  ' WHERE ';
                $conditions .=  $output = implode(' AND ', array_map(
                function ($v, $k) {
                    return sprintf("%s=:%s", $k, $k);
                },
                $options['conditions'],
                array_keys($options['conditions'])
            ));
            }

            if (!empty($options['fields'])) {
                $fields =  '';
                $fields .=  $output = implode(' AND ', array_map(
                function ($v, $k) {
                    return sprintf("%s=:%s", $k, $k);
                },
                $options['fields'],
                array_keys($options['fields'])
            ));
            }

            $sql = "UPDATE `{$table}` SET {$fields} {$conditions}";

            $stmt = $db->prepare($sql);

            foreach ($options['fields'] as $fkey => $fvalue) {
                $fkey = ":{$fkey}";
                $stmt->bindParam($fkey, $fvalue);
                unset($fkey);
            }

            foreach ($options['conditions'] as $ckey => $cvalue) {
                $ckey = ":{$ckey}";
                $stmt->bindParam($ckey, $cvalue);
                unset($ckey);
            }

            if ($stmt->execute()) {
                // $stmt->debugDumpParams();
                $output = 'MESSAGE_SUCCESS';
            } else {
                $output = 'MESSAGE_FAILURE';
            }

            //$file = 'log.txt';
            //file_put_contents($file, $ukey);
            //file_put_contents($file, $uvalue);

            $db = null;
            return json_encode($output);
        }

        /**
        * update a record on specific table
        * @param string $table
        * @param array $options
        * @return array $table_values
        */
        public function get_records($table, $options = array())
        {
            $orderby = $pagelimit = $conditions = '';
            $fields = '*';

            $page = (!empty($options['page'])) ? $options['page'] : 0;
            $num_rec_per_page = $this->num_rec_per_page;
            $start_from = ($page - 1) * $num_rec_per_page;
            $db = $this->getConnection();

            if (!empty($options['orderby'])) {
                $orderfield = $options['orderby'];
                $orderby = "order by {$orderfield}";
            }

            if (!empty($options['fields'])) {
                $fields = '`' . implode('`, `', $options['fields']) . '`';
            }
            if (!empty($page)) {
                $pagelimit = "LIMIT {$start_from}, {$num_rec_per_page}";
            }

            if (!empty($options['conditions'])) {
                $conditions .=  ' WHERE ';
                $conditions .=  $output = implode(' AND ', array_map(
                function ($v, $k) {
                    return sprintf("%s='%s'", $k, $v);
                },
                $options['conditions'],
                array_keys($options['conditions'])
            ));
            }

            $sqlquery = "select {$fields} from `{$table}` {$conditions} {$orderby} {$pagelimit};";
            $stmt = $db->prepare($sqlquery);
            $stmt->execute();

            $table_values = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $db = null;

            return $table_values;
        }

        /**
        * get single record on specific table with filter in $options array
        * @param string $table
        * @param array $options
        * @return array $table_values
        */
        public function get_single_record($table, $options = array())
        {
            $fields = '*';
            $db = $this->getConnection();

            if (!empty($options['orderby'])) {
                $orderfield = $options['orderby'];
                $orderby = "order by {$orderfield}";
            }

            if (!empty($options['fields'])) {
                $fields = '`' . implode('`, `', $options['fields']) . '`';
            }

            if (!empty($options['conditions'])) {
                $conditions =  ' WHERE ';
                $conditions .=  $output = implode(' AND ', array_map(
                function ($v, $k) {
                    return sprintf("%s='%s'", $k, $v);
                },
                $options['conditions'],
                array_keys($options['conditions'])
            ));
            }

            $sqlquery = "select {$fields} from `{$table}` {$conditions};";
            $stmt = $db->prepare($sqlquery);
            $stmt->execute();

            $table_values = $stmt->fetch(PDO::FETCH_ASSOC);

            $db = null;

            return $table_values;
        }

        /**
        * Get record on specific query
        * @param string $sqlquery
        * @return array $output
        */
        public function raw_query($sqlquery)
        {
            $db = $this->getConnection();
            $stmt = $db->prepare($sqlquery);
            $stmt->execute();

            $table_values = $stmt->fetch(PDO::FETCH_ASSOC);

            $db = null;

            return $table_values;
        }

		/**
		* Validating data
		* @param string $data
		* @return string $data
		*/
        public function checkinput($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
