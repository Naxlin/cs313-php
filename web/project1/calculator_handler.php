<?php
    // $requestString = $_REQUEST['request'];
    // $request = json_decode($requestString, true);
    $request['cmd'] = 'singularity';
    $request['name'] = '';

    $commandMap = array('singularity'=>'singularity', 'thaumcraft'=>'thaumcraft', 'tinkers'=>'tinkers');
    $commandMap[$request['cmd']]($request);

    class Rows
    {
        public $rows;
        function __set($col, $value) { $this->rows[$col] = $value; }
        function __get($col) { return $this->rows[$col]; }
    }

    class Parents {
        public $singularity;
        public $parent1;
        public $parent2;
        public $parent3;
        public $parent4;
        public $parent5;
        public $parent6;
        public $parent7;
        public $parent8;
        public $parent9;
    }

    class Singularity {
        public $singularity_id;
        public $singularity_name;
        public $compound;
        public $item_cost;
        public $item;
    }

    function connect() {
        try {
            $dbUrl = getenv('DATABASE_URL');

            $dbOpts = parse_url($dbUrl);

            $dbHost = $dbOpts['host'];
            $dbPort = $dbOpts['port'];
            $dbUser = $dbOpts['user'];
            $dbPassword = $dbOpts['pass'];
            $dbName = ltrim($dbOpts['path'],'/');

            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $ex) {
            echo 'Error!: ' . $ex->getMessage();
            die();
        }
    }

    function singularity($obj) {
        $name = $obj['name'];
        $parents = new Rows();
        $singularities = new Rows();
        $comp_list = '';
        $db = connect();
        $sql = 'SELECT * FROM singularities WHERE singularity_name LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_INTO, $singularities);
        $stmt->execute();
        $singularities = $stmt->fetchAll(PDO::FETCH_CLASS, 'Singularity');
        // echo json_encode($singularities);

        foreach ($singularities as $row) {
            echo $row;
        }

            // $sql = 'SELECT * FROM singularity_parents WHERE singularity = :singularity_id';
            // $stmt = $db->prepare($sql);
            // $stmt->bindValue(':singularity_id', 1, PDO::PARAM_INT);
            // $stmt->setFetchMode(PDO::FETCH_INTO, $parents);
            // $stmt->execute();
            // $parents = $stmt->fetchAll(PDO::FETCH_CLASS, "Parents");
    }

    function thaumcraft($obj) {
        // $name = $obj['name'];
        // $list = '';
        // $comp_list = '';
        // $db = connect();
        // $sql = 'SELECT (item, aspect, amount) FROM thaumcraft WHERE aspect LIKE :name';
        // $stmt = $db->prepare($sql);
        // $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        // $stmt->execute();
        // $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($list as $row => $item) {
        //     $items = explode(',', $item['row']);
        //     $comp_list = $comp_list . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ';
        // }
        // $compiled_list = $compiled_list . '</ul>';
        echo "thaumcraft - "; //. $comp_list;
    }

    function tinkers($obj) {
        // $name = $obj['name'];
        // $list = '';
        // $comp_list = '';
        // $db = connect();
        // $sql = 'SELECT (part, stat, material, level) FROM tinkers WHERE part LIKE :part AND material LIKE :material';
        // $stmt = $db->prepare($sql);
        // $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        // $stmt->execute();
        // $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($list as $row => $item) {
        //     $items = explode(',', $item['row']);
        //     $comp_list = $comp_list . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ' . substr($items[3], 0, -1) . ' ';
        // }
        // $compiled_list = $compiled_list . '</ul>';
        echo "tinkers - ";// . $comp_list;
    }
?>

