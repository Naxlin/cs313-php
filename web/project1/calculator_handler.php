<?php
    $requestString = $_REQUEST['request'];
    $request = json_decode($requestString, true);

    $commandMap = array('singularity'=>'singularity', 'thaumcraft'=>'thaumcraft', 'tinkers'=>'tinkers', 'updateAspectAmount'=>'updateAspectAmount', 'updateItemList'=>'updateItemList', 'updateAspectList'=>'updateAspectList',);
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
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword, $options);

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
        $sql = "SELECT * FROM singularities NATURAL JOIN items WHERE singularity_name LIKE :name";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $singularities = $stmt->fetchAll();
        foreach ($singularities as $row) {
            // Storing the variables for cross reference:
            $id = $row['singularity_id'];
            $l[$id] = array(
                "name" => $row['singularity_name'],
                "comp" => $row['compound'],
                "cost" => $row['item_cost'],
                "item" => $row['item_name'],
                "emc" => $row['emc']
            );
            $l[$id]['id'] = str_replace(' ', '', $l[$id]['name']);
            $l[$id]['total'] = (int) $l[$id]['cost'] * (int) $l[$id]['emc'];

            if ($l[$id]['name'] != 'No Singularity') {
                $reply = $reply . '<option class="singularity-opt" value="' . $l[$id]['id'] . '">' . $l[$id]['name'] . '</option>';
                $compList = $compList . '<div id="' . $l[$id]['id'] . '" class="singularity inactive"><div class="header-sing-cont"><img class="img-sing" src="./project1/' . $l[$id]['name'] . '.gif" alt="Image of ' . $l[$id]['name'] . '"><h5 class="header-sing">' . $l[$id]['name'] . '</h5></div>';
                $compList = $compList . '<div class="ancestors">';
                if ($l[$id]['item'] != 'No Item') {
                    $compList = $compList . '<p class="sing-item">Item - ' . $l[$id]['item'] . ' (' . number_format($l[$id]['emc'], 0, '.', ',') . ' emc)</p><p class="sing-item">Cost - ' . number_format($l[$id]['cost'], 0, '.', ',') . '</p><p class="sing-item">EMC Cost - ' . number_format($l[$id]['total'], 0, '.', ',') . '</p>';
                }
                if ($l[$id]['comp'] == true) {
                    $sql = 'SELECT parent1, parent2, parent3, parent4, parent5, parent6, parent7, parent8, parent9 FROM singularity_parents WHERE singularity = :singularity_id';
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(':singularity_id', (int) $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $p = $stmt->fetch();
                    $tot = 0;
                    foreach ($p as $key => $value) {
                        if ($value != 90) {
                            $compList = $compList . '<div class="header-sing-con">';
                            $compList = $compList . '<img class="img-sing-parent" src="./project1/' . $l[$value]['name'] . '.gif" alt="Image of ' . $l[$value]['name'] . '">' ;
                            $compList = $compList . '<p class="parent sing-item">' . $l[$value]['name'] . ' (' . number_format($l[$value]['total'], 0, '.', ',') . ' emc)' . '</p>';
                            $compList = $compList . '</div>';
                            $l[$id]['total'] += $l[$value]['total'];
                            if ($l[$value]['comp']) {
                                $sql = 'SELECT parent1, parent2, parent3, parent4, parent5, parent6, parent7, parent8, parent9 FROM singularity_parents WHERE singularity = :singularity_id';
                                $stmt = $db->prepare($sql);
                                $stmt->bindValue(':singularity_id', (int) $value, PDO::PARAM_INT);
                                $stmt->execute();
                                $gp = $stmt->fetch();
                                foreach ($gp as $k => $v) {
                                    $tot += $l[$v]['total'];
                                }
                            }
                            $tot += $l[$value]['total'];
                        }
                    }
                    $compList = $compList . '<p class="sing-item">EMC Total - ' . number_format($tot, 0, '.', ',') . '</p>';
                    $compList = $compList . '</div>';
                }
                $compList = $compList . '</div></div>';
            }
        }
        $reply = $reply . '</select>';
        echo $reply . $compList;
    }

    function thaumcraft($obj) {
        $name = $obj['name'];
        $itemList = '<div id="itemSelWarn" class="itemWarn inactive">Please select an Item</div>';
        $aspectList = '';
        $db = connect();
        $sql = 'SELECT item_name FROM items WHERE item_name LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $inc = 1;
        foreach ($rows as $row => $item) {
            $itemList = $itemList . '<div id="itemCont' . $inc . '" class="thaum-item">'; 
            $itemList = $itemList . '<input id="item' . $inc . '" type="radio" name="items[]" class="';
            $itemList = $itemList . 'radio-check" value="' . $inc . '" onclick="toggleItem(this.id)">';
            $itemList = $itemList . '<label id="iLabel' . $inc . '" for="item' . $inc . '">';
            $itemList = $itemList . $item['item_name'] . '</label></div>';
            $inc++;
        }
        $sql = 'SELECT aspect_name FROM aspects WHERE aspect_name LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $inc = 1;
        foreach ($rows as $row => $item) {
            $aspectList = $aspectList . '<div id="aspCont' . $inc . '" class="thaum-item">'; 
            $aspectList = $aspectList . '<input id="aspect' . $inc . '" type="checkbox" class="radio-check"';
            $aspectList = $aspectList . 'name="aspects[]" value="' . $inc . '" onclick="toggleAspect(this.id)">';
            $aspectList = $aspectList . '<label id="aLabel' . $inc . '" for="aspect' . $inc . '">';
            $aspectList = $aspectList . $item['aspect_name'] . '</label><input id="amount' . $inc . '" type="number" class=';
            $aspectList = $aspectList . '"thaum-input inactive" name="amounts[]" placeholder="Amount" min="1"';
            $aspectList = $aspectList . 'max="64" onkeyup="updateAspectAmount(this.id)"></div>';
            $inc++;
        }
        $obj = array('items'=> $itemList, 'aspects'=>$aspectList);
        echo json_encode($obj);
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
        // $l = $stmt->fetchAll();
        // foreach ($l as $row => $item) {
        //     $items = explode(',', $item['row']);
        //     $compList = $compList . substr($items[0], 1) . ' ' . $items[1] . ' ' . $items[2] . ' ' . substr($items[3], 0, -1) . ' ';
        // }
        // $compiled_list = $compiled_list . '</ul>';
        echo "tinkers - ";// . $compList;
    }
?>

