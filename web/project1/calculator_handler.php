<?php
    $requestString = $_REQUEST['request'];
    $request = json_decode($requestString, true);

    $commandMap = array(
        'singularity' => 'singularity',
        'thaumcraft' => 'thaumcraft',
        'tinkers' => 'tinkers', 
        'updateAspectAmount' => 'updateAspectAmount', 
        'updateItemList' => 'updateItemList', 
        'updateAspectList' => 'updateAspectList', 
        'addAspect2List' => 'addAspect2List', 
        'getItemAspects' => 'getItemAspects', 
        'delItemAspect' => 'delItemAspect'
    );
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
        $list = '';
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
                $list = $list . '<div id="' . $l[$id]['id'] . '" class="singularity inactive"><div class="header-sing-cont">';
                $list = $list . '<img class="img-sing" src="./project1/' . $l[$id]['name'] . '.gif" alt="Image of ';
                $list = $list . $l[$id]['name'] . '"><h5 class="header-sing">' . $l[$id]['name'] . '</h5></div>';
                $list = $list . '<div class="ancestors">';
                if ($l[$id]['item'] != 'No Item') {
                    $list = $list . '<p class="sing-item">Item - ' . $l[$id]['item'] . ' (';
                    $list = $list . number_format($l[$id]['emc'], 0, '.', ',') . ' emc)</p><p class="sing-item">Cost - ';
                    $list = $list . number_format($l[$id]['cost'], 0, '.', ',') . '</p><p class="sing-item">EMC Cost - ';
                    $list = $list . number_format($l[$id]['total'], 0, '.', ',') . '</p>';
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
                            $list = $list . '<div class="header-sing-con">';
                            $list = $list . '<img class="img-sing-parent" src="./project1/' . $l[$value]['name'];
                            $list = $list . '.gif" alt="Image of ' . $l[$value]['name'] . '"><p class="parent sing-item">';
                            $list = $list . $l[$value]['name'] . ' (' . number_format($l[$value]['total'], 0, '.', ',');
                            $list = $list . ' emc)' . '</p></div>';
                            $l[$id]['total'] += $l[$value]['total'];
                            $tot += $l[$value]['total'];
                        }
                    }
                    $list = $list . '<p class="sing-item">EMC Total - ' . number_format($tot, 0, '.', ',') . '</p>';
                    $list = $list . '</div>';
                }
                $list = $list . '</div></div>';
            }
        }
        $reply = $reply . '</select>';
        echo $reply . $list;
    }

    function thaumcraft($obj) {
        $name = $obj['name'];
        $items = '<div id="itemSelWarn" class="itemWarn inactive">Please select an Item</div>';
        $aspects = '';
        $db = connect();
        $sql = 'SELECT item_name FROM items WHERE LOWER(item_name) LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $inc = 1;
        foreach ($rows as $row => $item) {
            if ($item['item_name'] != "No Item") {
                $items = $items . '<div id="itemCont' . $inc . '" class="thaum-item">'; 
                $items = $items . '<input id="item' . $inc . '" type="radio" name="items[]" class="';
                $items = $items . 'radio-check" value="' . $inc . '" onclick="toggleItem(this.id)">';
                $items = $items . '<label id="iLabel' . $inc . '" for="item' . $inc . '" class="thaum-label">';
                $items = $items . $item['item_name'] . '</label></div>';
                $inc++;
            }
        }
        $sql = 'SELECT aspect_name FROM aspects WHERE LOWER(aspect_name) LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $inc = 1;
        foreach ($rows as $row => $item) {
            $aspects = $aspects . '<div id="aspCont' . $inc . '" class="thaum-item">';
            $aspects = $aspects . '<img id="img' . $inc . '" src="./project1/' . $item['aspect_name'] . '.png" class="img-aspect">';
            $aspects = $aspects . '<input id="aspect' . $inc . '" type="checkbox" class="radio-check"';
            $aspects = $aspects . 'name="aspects[]" value="' . $inc . '" onclick="toggleAspect(this.id)">';
            $aspects = $aspects . '<label id="aLabel' . $inc . '" for="aspect' . $inc . '" class="thaum-label-aspect">';
            $aspects = $aspects . $item['aspect_name'] . '</label><input id="amount' . $inc . '" type="number" class=';
            $aspects = $aspects . '"thaum-input thaum-inline inactive" name="amounts[]" placeholder="Amount" min="1"';
            $aspects = $aspects . 'max="64" onkeyup="updateAspectAmount(this.id)" onclick="updateAspectAmount(this.id)"';
            $aspects = $aspects . 'value="1"></div>';
            $inc++;
        }
        $rtnobj = array('items'=> $items, 'aspects'=>$aspects);
        echo json_encode($rtnobj);
    }

    function tinkers($obj) {
        // Planning on implementing this after this semester, there just wasn't time to do so for this project.
    }

    function addAspect2List($obj) {
        $itemName = $obj['itemName'];
        $aspectName = $obj['aspectName'];
        $amount = $obj['amount'];

        $db = connect();
        $sql = 'SELECT item_id FROM items WHERE item_name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $itemName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $itemId = $row['item_id'];

        $sql = 'SELECT aspect_id FROM aspects WHERE aspect_name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $aspectName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $aspectId = $row['aspect_id'];

        $sql = 'INSERT INTO thaumcraft (item, aspect, amount) VALUES (:itemId, :aspectId, :amount)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':itemId', $itemId, PDO::PARAM_STR);
        $stmt->bindValue(':aspectId', $aspectId, PDO::PARAM_STR);
        $stmt->bindValue(':amount', $amount, PDO::PARAM_STR);
        $stmt->execute();
        echo "Inserted row for $itemName with $amount $aspectName";

    }

    function updateAspectAmount($obj) {
        $itemName = $obj['itemName'];
        $aspectName = $obj['aspectName'];
        $amount = $obj['amount'];

        $db = connect();
        $sql = 'SELECT item_id FROM items WHERE item_name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $itemName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $itemId = $row['item_id'];

        $sql = 'SELECT aspect_id FROM aspects WHERE aspect_name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $aspectName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $aspectId = $row['aspect_id'];

        $sql = 'UPDATE thaumcraft SET amount = :amount WHERE item = :itemId AND aspect = :aspectId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':amount', $amount, PDO::PARAM_STR);
        $stmt->bindValue(':itemId', $itemId, PDO::PARAM_STR);
        $stmt->bindValue(':aspectId', $aspectId, PDO::PARAM_STR);
        $stmt->execute();
        echo "Updated $itemName to $amount $aspectName";
    }

    function updateItemList($obj) {
        $name = strtolower($obj['itemSearch']);

        $items = '<div id="itemSelWarn" class="itemWarn inactive">Please select an Item</div>';
        $db = connect();
        $sql = 'SELECT item_name FROM items WHERE LOWER(item_name) LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $inc = 1;
        foreach ($rows as $row => $item) {
            if ($item['item_name'] != "No Item") {
                $items = $items . '<div id="itemCont' . $inc . '" class="thaum-item">'; 
                $items = $items . '<input id="item' . $inc . '" type="radio" name="items[]" class="';
                $items = $items . 'radio-check" value="' . $inc . '" onclick="toggleItem(this.id)">';
                $items = $items . '<label id="iLabel' . $inc . '" for="item' . $inc . '" class="thaum-label">';
                $items = $items . $item['item_name'] . '</label></div>';
                $inc++;
            }
        }
        echo $items;
    }

    function updateAspectList($obj) {
        $name = strtolower($obj['aspectSearch']);

        $aspects = '';
        $db = connect();
        $sql = 'SELECT aspect_name FROM aspects WHERE LOWER(aspect_name) LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $inc = 1;
        foreach ($rows as $row => $item) {
            $aspects = $aspects . '<div id="aspCont' . $inc . '" class="thaum-item">'; 
            $aspects = $aspects . '<img id="img' . $inc . '" src="./project1/' . $item['aspect_name'] . '.png" class="img-aspect">';
            $aspects = $aspects . '<input id="aspect' . $inc . '" type="checkbox" class="radio-check"';
            $aspects = $aspects . 'name="aspects[]" value="' . $inc . '" onclick="toggleAspect(this.id)">';
            $aspects = $aspects . '<label id="aLabel' . $inc . '" for="aspect' . $inc . '" class="thaum-label-aspect">';
            $aspects = $aspects . $item['aspect_name'] . '</label><input id="amount' . $inc . '" type="number" class=';
            $aspects = $aspects . '"thaum-input thaum-inline inactive" name="amounts[]" placeholder="Amount" min="1"';
            $aspects = $aspects . 'max="64" onkeyup="updateAspectAmount(this.id)" value="1"></div>';
            $inc++;
        }
        echo $aspects;
    }

    function getItemAspects($obj) {
        $itemName = $obj['itemName'];
        $aspectName = $obj['aspectSearch'];

        $db = connect();
        $sql = 'SELECT item_id FROM items WHERE item_name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $itemName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $itemId = $row['item_id'];

        $sql = 'SELECT aspect, amount FROM thaumcraft WHERE item = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $itemId, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        
        $itemsAspects = '';
        $aspectIds = array();
        $inc = 1;
        foreach ($rows as $row => $item) {
            $aspectId = $item['aspect'];
            array_push($aspectIds, $aspectId);
            $amount = $item['amount'];
            $sql = 'SELECT aspect_name FROM aspects WHERE aspect_id = :id';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $aspectId, PDO::PARAM_STR);
            $stmt->execute();
            $aRows = $stmt->fetch();
            $itemsAspects = $itemsAspects . '<div id="aspCont' . $inc . '" class="thaum-item">'; 
            $itemsAspects = $itemsAspects . '<img id="img' . $inc . '" src="./project1/' . $aRows['aspect_name'] . '.png" class="img-aspect">';
            $itemsAspects = $itemsAspects . '<input id="aspect' . $inc . '" type="checkbox" class="radio-check" checked ';
            $itemsAspects = $itemsAspects . 'name="aspects[]" value="' . $inc . '" onclick="toggleAspect(this.id)">';
            $itemsAspects = $itemsAspects . '<label id="aLabel' . $inc . '" for="aspect' . $inc . '" class="thaum-label-aspect">';
            $itemsAspects = $itemsAspects . $aRows['aspect_name'] . '</label><input id="amount' . $inc . '" type="number" class=';
            $itemsAspects = $itemsAspects . '"thaum-input thaum-inline" name="amounts[]" placeholder="Amount" min="1"';
            $itemsAspects = $itemsAspects . 'max="64" onkeyup="updateAspectAmount(this.id)"';
            $itemsAspects = $itemsAspects . 'onclick="updateAspectAmount(this.id)" value="' . $amount . '"></div>';
            $inc++;
        }

        $aspects = '';
        $sql = 'SELECT aspect_name, aspect_id FROM aspects WHERE LOWER(aspect_name) LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', "%$aspectName%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        foreach ($rows as $row => $item) {
            if (!in_array($item['aspect_id'], $aspectIds)) {
                $aspects = $aspects . '<div id="aspCont' . $inc . '" class="thaum-item">'; 
                $aspects = $aspects . '<img id="img' . $inc . '" src="./project1/' . $item['aspect_name'] . '.png" class="img-aspect">';
                $aspects = $aspects . '<input id="aspect' . $inc . '" type="checkbox" class="radio-check"';
                $aspects = $aspects . 'name="aspects[]" value="' . $inc . '" onclick="toggleAspect(this.id)">';
                $aspects = $aspects . '<label id="aLabel' . $inc . '" for="aspect' . $inc . '" class="thaum-label-aspect">';
                $aspects = $aspects . $item['aspect_name'] . '</label><input id="amount' . $inc . '" type="number" class=';
                $aspects = $aspects . '"thaum-input thaum-inline inactive" name="amounts[]" placeholder="Amount" min="1"';
                $aspects = $aspects . 'max="64" onkeyup="updateAspectAmount(this.id)"onclick="updateAspectAmount(this.id)" value="1"></div>';
                $inc++;
            }
        }

        $itemsAspects = $itemsAspects . $aspects;
        echo $itemsAspects;
    }

    function delItemAspect($obj) {
        $itemName = $obj['itemName'];
        $aspectName = $obj['aspectName'];

        $db = connect();
        $sql = 'SELECT item_id FROM items WHERE item_name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $itemName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $itemId = $row['item_id'];

        $sql = 'SELECT aspect_id FROM aspects WHERE aspect_name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $aspectName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        $aspectId = $row['aspect_id'];

        $sql = 'DELETE FROM thaumcraft WHERE item = :itemId AND aspect = :aspectId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':itemId', $itemId, PDO::PARAM_STR);
        $stmt->bindValue(':aspectId', $aspectId, PDO::PARAM_STR);
        $stmt->execute();

        getItemAspects(array('itemName'=>$itemName, 'aspectName'=>$aspectName));
        echo "Removed $aspectName from $itemName";
    }
?>

