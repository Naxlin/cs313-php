<?php
    $requestString = $_REQUEST['request'];
    $request = json_decode($requestString, true);

    $commandMap = array("details"=>"details", "scripture"=>"scripture");
    $commandMap[$request['cmd']]($request);

    function connect() {
        try {
            $dbUrl = getenv('DATABASE_URL');

            $dbOpts = parse_url($dbUrl);

            $dbHost = $dbOpts["host"];
            $dbPort = $dbOpts["port"];
            $dbUser = $dbOpts["user"];
            $dbPassword = $dbOpts["pass"];
            $dbName = ltrim($dbOpts["path"],'/');

            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $ex) {
            echo 'Error!: ' . $ex->getMessage();
            die();
        }

    }

    // function details($obj) {
    //     $name = $obj['name'];
    // }

    function scripture($obj) {
        // $book = $obj['book'];
        // $book = strtolower($book);    
        // $list = "";
        // $db = connect();    
        // if ($book === "") {
        //     $sql = 'SELECT * FROM scriptures';
        //     $stmt = $db->prepare($sql);
        //     $stmt->execute();
        //     $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // } else if ($book !== "") {
        //     $sql = 'SELECT (book, chapter, verse) FROM scriptures WHERE book LIKE :book';
        //     $stmt = $db->prepare($sql);            
        //     $stmt->bindParam(':book', '%' . $book . '%', PDO::PARAM_STR);
        //     $stmt->execute();
        //     $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // echo $list === "" ? "No book with that name." : $list;
    }
?>

