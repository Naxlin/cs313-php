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
        $l = array();
        $singularities;
        $comp_list = '<ul class="singularity-list">';
        $db = connect();
        $sql = 'SELECT (singularity_id, singularity_name, compound, item_cost, item) FROM singularities WHERE singularity_name LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $singularities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($singularities as $row => $item) {
            $items = explode(',', $item['row']);
            $id = substr($items[0], 1);
            $l[$id] = array(
                "name" => $items[1], 
                "comp" => $items[2], 
                "cost" => $items[3], 
                "item" => substr($items[4], 0, -1)
            );

            $sql = 'SELECT (item_name) FROM items WHERE item_id = :id';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', (int) $l[$id]['item'], PDO::PARAM_INT);
            $stmt->execute();
            $name = $stmt->fetch(PDO::FETCH_ASSOC);
            $name = $name['item_name'];
            if ($name != 'No Item') {
                $comp_list = $comp_list . '<li class="singularity">' . substr($l[$id]['name'], 1, -1) . ' - ' . $name . ' : ' . $l[$id]['cost'];
            }

            if ($l[$id]['comp'] == 't') {
                $sql = 'SELECT (parent1, parent2, parent3, parent4, parent5, parent6, parent7, parent8, parent9) FROM singularity_parents WHERE singularity = :singularity_id';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':singularity_id', (int) $id, PDO::PARAM_INT);
                $stmt->execute();
                $p = $stmt->fetch(PDO::FETCH_ASSOC);
                $help = str_replace(')', '', $p['row']);
                $help = str_replace('(', '', $help);
                $help = explode(',', $p);
                $comp_list = $comp_list . json_encode($help);
                $comp_list = $comp_list . '<ul class="parents"><li class="parent">' . $l[$help[0]]['name'] . '</li>';
                $comp_list = $comp_list . '<li class="parent">' . $l[$help[1]]['name'] . '</li>';
                $comp_list = $comp_list . '<li class="parent">' . $l[$help[2]]['name'] . '</li>';
                $comp_list = $comp_list . '<li class="parent">' . $l[$help[3]]['name'] . '</li>';
                $comp_list = $comp_list . '<li class="parent">' . $l[$help[4]]['name'] . '</li>';
                $comp_list = $comp_list . '<li class="parent">' . $l[$help[5]]['name'] . '</li>';
                $comp_list = $comp_list . '<li class="parent">' . $l[$help[6]]['name'] . '</li>';
                $comp_list = $comp_list . '<li class="parent">' . $l[$help[7]]['name'] . '</li>';
                $comp_list = $comp_list . '<li class="parent">' . $l[$help[8]]['name'] . '</li></ul>';
            }
            $comp_list = $comp_list . '</li>';
        }
        echo $comp_list;
    }

    function thaumcraft($obj) {
        // $name = $obj['name'];
        // $l = '';
        // $comp_list = '';
        // $db = connect();
        // $sql = 'SELECT (item, aspect, amount) FROM thaumcraft WHERE aspect LIKE :name';
        // $stmt = $db->prepare($sql);
        // $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        // $stmt->execute();
        // $l = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($l as $row => $item) {
        //     $items = explode(',', $item['row']);
        //     $comp_list = $comp_list . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ';
        // }
        // $compiled_list = $compiled_list . '</ul>';
        echo "thaumcraft - "; //. $comp_list;
    }

    function tinkers($obj) {
        // $name = $obj['name'];
        // $l = '';
        // $comp_list = '';
        // $db = connect();
        // $sql = 'SELECT (part, stat, material, level) FROM tinkers WHERE part LIKE :part AND material LIKE :material';
        // $stmt = $db->prepare($sql);
        // $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        // $stmt->execute();
        // $l = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($l as $row => $item) {
        //     $items = explode(',', $item['row']);
        //     $comp_list = $comp_list . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ' . substr($items[3], 0, -1) . ' ';
        // }
        // $compiled_list = $compiled_list . '</ul>';
        echo "tinkers - ";// . $comp_list;
    }
?>

