<?php
    $requestString = $_REQUEST['request'];
    $request = json_decode($requestString, true);

    $commandMap = array('singularity'=>'singularity', 'thaumcraft'=>'thaumcraft', 'tinkers'=>'tinkers');
    $commandMap[$request['cmd']]($request);

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
        $list = '';
        $comp_list = '';
        $db = connect();
        $sql = 'SELECT (singularity_name, compound, item_cost, item) FROM singularities WHERE singularity_name LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO:PARAM_STR);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($list as $row => $item) {
            $items = explode(',', $item['row']);
            $comp_list = $comp_list . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ';
        }
        // $compiled_list = $compiled_list . '</ul>';
        echo "singularity - " . $comp_list;
    }

    function thaumcraft($obj) {
        $name = $obj['name'];
        $list = '';
        $comp_list = '';
        $db = connect();
        $sql = 'SELECT (item, aspect, amount) FROM thaumcraft WHERE aspect LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO:PARAM_STR);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($list as $row => $item) {
            $items = explode(',', $item['row']);
            $comp_list = $comp_list . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ';
        }
        // $compiled_list = $compiled_list . '</ul>';
        echo "thaumcraft - " . $comp_list;
    }

    function tinkers($obj) {
        $name = $obj['name'];
        $list = '';
        $comp_list = '';
        $db = connect();
        $sql = 'SELECT (part, stat, material, level) FROM tinkers WHERE part LIKE :part AND material LIKE :material';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO:PARAM_STR);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($list as $row => $item) {
            $items = explode(',', $item['row']);
            $comp_list = $comp_list . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ' . substr($items[3], 0, -1) . ' ';
        }
        // $compiled_list = $compiled_list . '</ul>';
        echo "tinkers - " . $comp_list;
    }
?>

