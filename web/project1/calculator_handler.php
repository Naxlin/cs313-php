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
        $list = array();
        $parents;
        $singularities;
        $comp_list = '<ul class="singularity-list">';
        $db = connect();
        $sql = 'SELECT (singularity_id, singularity_name, compound, item_cost, item) FROM singularities WHERE singularity_name LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $singularities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = 0;
        foreach ($singularities as $row => $item) {
            $items = explode(',', $item['row']);
            $list[$count] = array(
                "id" => substr($items[0], 1),
                "name" => $items[1], 
                "comp" => $items[2], 
                "cost" => $items[3], 
                "item" => substr($items[4], 0, -1)
            );

            $comp_list = $comp_list . '<li class="singularity">' . substring($list[$count]['name'], 1, -1) . ' - ' . $list[$count]['item'] . ' : ' . $list[$count]['cost'];

            if ($list[$count]['comp'] == 't') {
                $comp_list = $comp_list . '<ul class="parents">';
                $sql = 'SELECT (parent1, parent2, parent3, parent4, parent5, parent6, parent7, parent8, parent9) FROM singularity_parents WHERE singularity = :singularity_id';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':singularity_id', $list[$count]['id'], PDO::PARAM_INT);
                $stmt->execute();
                $parents = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // foreach ($parents as $a => $l) {
                //     $stuffs = explode(',', $l['row']);
                //     $comp_list = $comp_list . '<li class="parent">' . substring($stuffs[0], 1) . '</li>';
                //     $comp_list = $comp_list . '<li class="parent">' . $stuffs[1] . '</li>';
                //     $comp_list = $comp_list . '<li class="parent">' . $stuffs[2] . '</li>';
                //     $comp_list = $comp_list . '<li class="parent">' . $stuffs[3] . '</li>';
                //     $comp_list = $comp_list . '<li class="parent">' . $stuffs[4] . '</li>';
                //     $comp_list = $comp_list . '<li class="parent">' . $stuffs[5] . '</li>';
                //     $comp_list = $comp_list . '<li class="parent">' . $stuffs[6] . '</li>';
                //     $comp_list = $comp_list . '<li class="parent">' . $stuffs[7] . '</li>';
                //     $comp_list = $comp_list . '<li class="parent">' . substring($stuffs[8], 0, -1) . '</li>';
                // }
                $comp_list = $comp_list . '</ul>';
            }

            $comp_list = $comp_list . '</li>';
            $count++;
        }
        echo $comp_list;
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

