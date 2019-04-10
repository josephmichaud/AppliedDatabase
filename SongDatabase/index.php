<?php
    require_once './php/db_connect.php';
?>
<?php 
if(isset($_POST['gender']) && !empty($_POST['name'])) {
    $gender = $_POST['gender'];
	$name = strtoupper(trim($_POST['name']));	
    $selectStmt = "SELECT COUNT(*) AS matches FROM `BABYNAMEVOTES` WHERE Name='" . $name . "' AND Gender='" . $gender . "';";
    $result = $db->query($selectStmt);
    $matches = ($result->fetch_assoc())["matches"];
    if($matches == 1) {
        $updateStmt = "UPDATE `BABYNAMEVOTES` SET Votes = Votes + 1 WHERE Name='" . $name . "' AND Gender='" . $gender . "';";
        $db->query($updateStmt);
    } elseif($matches == 0) {
        $insertStmt = "INSERT INTO `BABYNAMEVOTES` VALUES ('" . $name . "','" . $gender . "',1);";
        $db->query($insertStmt);
    }
}
if(isset($_POST['table'])) {
    $table = $_POST['table'];
} else {
    $table = "Songs";
}
?>
<html>
    <head>
        <title>Music Database</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="css/font-awesome.css" rel="stylesheet">
	    <link href="//fonts.googleapis.com/css?family=Merriweather+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
	    <link href="//fonts.googleapis.com/css?family=Mallanna" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="top-bar_sub_w3layouts_agile">
            <h6>Music Database</h6>
            <div class="clearfix"> </div>
        </div>
        <!--
        <div class="header" id="home">
        <div class="top_spl_courses">
            <div class="container">
                <h3 class="headerw3">Submit a query:</h3>
                    <div class="text-info">
                        <form action="" method="post">
                            <div class="form-group">
                                <textarea class=".form-control" rows="4" cols="50" placeholder="Enter query here."></textarea>
                                <input type="text" class="form-control" name="query" id="query">
                                <span id="tempglyph" class=""></span>
                            </div>
                            &nbsp;&nbsp;<button type="submit" name="submit" id="submit" class="btn btn-default">Vote</button>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
-->
        
        <div class="container">
            <h2>SELECT * FROM  <form action="" method="post"> <select name="table" id="table" onchange="this.form.submit()"><option value="" selected disabled hidden>Choose here</option><option value="Songs">Songs</option><option value="Artists">Artists</option><option value="Albums">Albums</option><option value="Contracts">Contracts</option></select></form></h2>           
            <h2><?php echo $table ?></h2>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <?php
                            $selectStmt = "SHOW COLUMNS FROM " . $table .";";
                            $result = $db->query($selectStmt);
                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<th>" . $row['Field'] . "</th>";
                                }
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $selectStmt = "SELECT * FROM " . $table . ";";
                        $result = $db->query($selectStmt);
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                foreach ($row as $value) {
                                    echo "<td>" . $value . "</td>";
                                }
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
              </table>
        </div>
    </body> 
    <div class="insert-post-ads1" style="margin-top:20px;"></div>
</html>




