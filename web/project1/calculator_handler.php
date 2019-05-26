<?php
    // $requestString = $_REQUEST['request'];
    // $request = json_decode($requestString, true);
    $request['cmd'] = 'singularity';
    $request['name'] = '';

    $commandMap = array('singularity'=>'singularity', 'thaumcraft'=>'thaumcraft', 'tinkers'=>'tinkers');
    $commandMap[$request['cmd']]($request);

    class Rows
    {
        protected $cols;
        function __set($name, $value) { $this->cols[$name] = $value; }
        function __get($name) { return $this->cols[$name]; }
    }

    class Parents {
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
        public $sing_id;
        public $sing_name;
        public $sing_comp;
        public $sing_cost;
        public $sing_item;
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
            echo $dbName;

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
        $sql = 'SELECT (singularity_id, singularity_name, compound, item_cost, item) FROM singularities WHERE singularity_name LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_INTO, $singularities);
        $stmt->execute();
        $singularities = $stmt->fetchAll(PDO::FETCH_CLASS, 'Singularity');
        $sql = 'SELECT (parent1, parent2, parent3, parent4, parent5, parent6, parent7, parent8, parent9) FROM singularity_parents WHERE singularity = :singularity_id';
        $stm = $db->prepare($sql);
        $stm->bindValue(':singularity_id', $id, PDO::PARAM_INT);
        $stm->setFetchMode(PDO::FETCH_INTO, $parents);
        $stm->execute();
        $tools = $stmt->fetchAll(PDO::FETCH_CLASS, "Parents");
        $parents = $stm->fetch();
        echo $parents;
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

