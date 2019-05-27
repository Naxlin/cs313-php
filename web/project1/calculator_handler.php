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
        $reply = '<select id="singularity-list" class="singularity-list" onChange="activateSingularity(this)">';
        $compList = '';
        $db = connect();
        $sql = 'SELECT (singularity_id, singularity_name, compound, item_cost, item_id) FROM singularities WHERE singularity_name LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $singularities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($singularities as $row => $item) {
            $items = explode(',', $item['row']);
            $id = substr($items[0], 1);
            $l[$id] = array(
                "name" => substr($items[1], 1, -1), 
                "comp" => $items[2], 
                "cost" => $items[3], 
                "item" => substr($items[4], 0, -1)
            );
            $l[$id]['id'] = str_replace(' ', '', $l[$id]['name']);

            $sql = 'SELECT (item_name, emc) FROM items WHERE item_id = :id';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', (int) $l[$id]['item'], PDO::PARAM_INT);
            $stmt->execute();
            $itemInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            $compList = $compList . 'ITEM VARIABLE:::' . json_encode($itemInfo);
            if (substr($l[$id]['name'], 1, -1) != 'No Singularity') {
                $reply = $reply . '<option class="singularity-opt" value="' . $l[$id]['id'] . '">' . $l[$id]['name'] . '</option>';
            }
            if ($name != 'No Item') {
                $compList = $compList . '<div id="' . $l[$id]['id'] . '" class="singularity inactive"><h5>' . $l[$id]['name'] . '</h5><p class="sing-item">Item - ' . $name . '</p><p class="sing-item">Cost - ' . $l[$id]['cost'] . '</p>';
            } else {
                $compList = $compList . '<div id="' . $l[$id]['id'] . '" class="singularity inactive"><h5>' . $l[$id]['name'] . '</h5>';
            }

            if ($l[$id]['comp'] == 't') {
                $sql = 'SELECT (parent1, parent2, parent3, parent4, parent5, parent6, parent7, parent8, parent9) FROM singularity_parents WHERE singularity = :singularity_id';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':singularity_id', (int) $id, PDO::PARAM_INT);
                $stmt->execute();
                $p = $stmt->fetch(PDO::FETCH_ASSOC);
                $help = explode(',', $p['row']);
                $compList = $compList . '<p class="parent sing-item">' . $l[substr($help[0], 1)]['name'] . '</p>';
                $compList = $compList . '<p class="parent sing-item">' . $l[$help[1]]['name'] . '</p>';
                $compList = $compList . '<p class="parent sing-item">' . $l[$help[2]]['name'] . '</p>';
                $compList = $compList . '<p class="parent sing-item">' . $l[$help[3]]['name'] . '</p>';
                $compList = $compList . '<p class="parent sing-item">' . $l[$help[4]]['name'] . '</p>';
                $compList = $compList . '<p class="parent sing-item">' . $l[$help[5]]['name'] . '</p>';
                $compList = $compList . '<p class="parent sing-item">' . $l[$help[6]]['name'] . '</p>';
                $compList = $compList . '<p class="parent sing-item">' . $l[$help[7]]['name'] . '</p>';
                $compList = $compList . '<p class="parent sing-item">' . $l[substr($help[8], 0, -1)]['name'] . '</p>';
            }
            $compList = $compList . '</div>';
        }
        $reply = $reply . '</select>';
        echo $reply . $compList;
    }

    function thaumcraft($obj) {
        // $name = $obj['name'];
        // $l = '';
        // $compList = '';
        // $db = connect();
        // $sql = 'SELECT (item, aspect, amount) FROM thaumcraft WHERE aspect LIKE :name';
        // $stmt = $db->prepare($sql);
        // $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        // $stmt->execute();
        // $l = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($l as $row => $item) {
        //     $items = explode(',', $item['row']);
        //     $compList = $compList . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ';
        // }
        // $compiled_list = $compiled_list . '</ul>';
        echo "thaumcraft - "; //. $compList;
    }

    function tinkers($obj) {
        // $name = $obj['name'];
        // $l = '';
        // $compList = '';
        // $db = connect();
        // $sql = 'SELECT (part, stat, material, level) FROM tinkers WHERE part LIKE :part AND material LIKE :material';
        // $stmt = $db->prepare($sql);
        // $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        // $stmt->execute();
        // $l = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($l as $row => $item) {
        //     $items = explode(',', $item['row']);
        //     $compList = $compList . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ' . substr($items[3], 0, -1) . ' ';
        // }
        // $compiled_list = $compiled_list . '</ul>';
        echo "tinkers - ";// . $compList;
    }
?>

