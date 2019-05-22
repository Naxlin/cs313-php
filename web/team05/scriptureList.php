<?php
    $requestString = $_REQUEST['request'];
    $request = json_decode($requestString, true);

    $commandMap = array('details'=>'details', 'scripture'=>'scripture');
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

    function details($obj) {
        $id = $obj['scriptureId'];
        $details = '';
        $compiled_details = '<div class="scripture-details">';
        $db = connect();    
        $sql = 'SELECT (book, chapter, verse, content) FROM scriptures WHERE id = :id';
        $stmt = $db->prepare($sql);            
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $details = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($details as $row => $item) {
            $items = explode(',', $item['row']);
            $bookName = '';
            if ($items[0] === '(d&c') {
                $bookName = 'Doctrine and Covenants';
            } else {
                $bookName = ucfirst(substr($items[0], 1));
            }
            $compiled_details = $compiled_details . '<h4 class="detail-heading">' . 
                             $bookName . ' ' . $items[1] . ':' . $items[2] . '</h4>' .
                             '<p class="detail-body">' . substr($items[3], 0) . '</p>';
        }
        $compiled_details = $compiled_details . '</div>';
        echo json_encode($compiled_details);
    }

    function scripture($obj) {
        $book = $obj['book'];
        $book = strtolower($book);    
        $list = '';
        $compiled_list = '<ul class="scripture-list">';
        $db = connect();    
        if ($book === '') {
            $sql = 'SELECT (book, chapter, verse, id) FROM scriptures';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else if ($book !== '') {
            $sql = 'SELECT (book, chapter, verse, id) FROM scriptures WHERE book LIKE :book';
            $stmt = $db->prepare($sql);            
            $stmt->bindValue(':book', "%$book%", PDO::PARAM_STR);
            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        foreach ($list as $row => $item) {
            $items = explode(',', $item['row']);
            $bookName = '';
            if ($items[0] === '(d&c') {
                $bookName = 'Doctrine and Covenants';
            } else {
                $bookName = ucfirst(substr($items[0], 1));
            }
            $compiled_list = $compiled_list . '<li id="' . substr($items[3], 0, -1) . 
                             '" class="scripture" onclick="showScriptureDetails(this.id)">' . 
                             $bookName . ' ' . $items[1] . ':' . $items[2] . '</li>';
        }
        $compiled_list = $compiled_list . '</ul>';
        echo json_encode($compiled_list);
    }
?>

