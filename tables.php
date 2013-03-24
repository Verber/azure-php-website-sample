<html>
<head>
<Title>Todo Items</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Add todo item</h1>
<p>Add job and press <strong>Submit</strong> to save.</p>
<form method="post" action="tables.php" enctype="multipart/form-data" >
      Job  <input type="text" name="job" id="job"/></br>
      Due date <input type="text" name="due" id="due"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    require_once './tables_init.php';

    use WindowsAzure\Table\Models\Entity;
    use WindowsAzure\Table\Models\EdmType;


    // Insert registration info
    if(!empty($_POST)) {
        $job = $_POST['job'];
        $dueDate = date("Y-m-d", strtotime($_POST['due']));

        $entity = new Entity();
        $entity->setPartitionKey("todoAzure");
        $entity->setRowKey(uniqid('job'));
        $entity->addProperty("Job", EdmType::STRING, $job);
        $entity->addProperty("Due", EdmType::DATETIME, $dueDate);

        try {
            $tableRestProxy->insertEntity("todos", $entity);
        }
        catch(Exception $e) {
            die(var_dump($e));
        }
        echo "<h3>Job added!</h3>";
    }
    // Retrieve data
    /*$sql_select = "SELECT * FROM registration_tbl";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>People who are registered:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Date</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['date']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>No one is currently registered.</h3>";
    }*/
?>
</body>
</html>