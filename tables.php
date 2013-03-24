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
        $dueDate = new DateTime($_POST['due']);

        $entity = new Entity();
        $entity->setPartitionKey("todoAzure");
        $entity->setRowKey(uniqid('job'));
        $entity->addProperty("Job", EdmType::STRING, $job);
        $entity->addProperty("Due", EdmType::DATETIME, $dueDate);

        try {
            $tableRestProxy->insertEntity("todos", $entity);
        }
        catch(Exception $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
        }
        echo "<h3>Job added!</h3>";
    }

    // Retrieve data
    try {
        $result = $tableRestProxy->queryEntities("todos");
    } catch(Exception $e){
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br />";
    }

    $entities = $result->getEntities();

    if(count($entities) > 0) {

        echo "<h2>Upccoming TODOs:</h2>";
        echo "<table>";
        echo "<tr><th>Job</th>";
        echo "<th>Due</th></tr>";
        foreach($entities as $entity) {
            echo "<tr><td>".$entity->getProperty('Job')->getValue()."</td>";
            echo "<td>".$entity->getProperty('Due')->getValue()."</td></tr>";
        }
        echo "</table>";

    } else {
        echo '<h2>No upcoming TODOs</h2>';
    }
?>
</body>
</html>