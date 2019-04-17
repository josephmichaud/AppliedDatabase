<?php
    require_once './php/db_connect.php';
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
        <div class="container">
            <h2>Artists of Top 3 Songs</h2>           
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $selectStmt = 
                            "SELECT DISTINCT A.name
                            FROM Artists A, Albums Al, Songs S
                            WHERE A.a_id = Al.a_id 
                            AND S.s_id = Al.s_id
                            ORDER BY S.hits DESC
                            LIMIT 3;";
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
        <br>
        <div class="container">
            <h2>Songs with Fewer Hits than the Average</h2>           
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Hits</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $selectStmt = 
                            "SELECT S1.name, S1.hits 
                            FROM Songs S1
                            WHERE S1.hits < (SELECT AVG(S2.hits)
                                            FROM Songs S2);";
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
        <br>
        <div class="container">
            <h2>Record Labels That Made Songs With a Million Hits</h2>           
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $selectStmt = 
                            "SELECT DISTINCT R.name
                            FROM Record_Label R, Contracts C, Artists A, Albums Al, Songs S
                            WHERE R.r_id = C.r_id 
                            AND C.a_id = A.a_id 
                            AND A.a_id = Al.a_id 
                            AND Al.s_id = S.s_id 
                            AND S.hits > 1000000;";
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
        <br>
        <div class="container">
            <h2>Number of RnB Songs</h2>           
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $selectStmt = 
                            'SELECT COUNT(*)
                            FROM Songs S
                            WHERE S.genre = "RnB";';
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
        <br>
        <div class="container">
            <h2>Artists with Albums Published Before 2000</h2>           
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $selectStmt = 
                            "SELECT DISTINCT A.name
                            FROM Artists A, Albums Al
                            WHERE A.a_id = Al.a_id
                            AND Al.year < 2000;";
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
        <br>
        <div class="container">
            <h2>Album Names of Artists That Start with “M”</h2>           
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Album Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $selectStmt = 
                            'SELECT DISTINCT Al.name
                            FROM Artists A, Albums Al
                            WHERE A.a_id = Al.a_id
                            AND A.name LIKE "M%";';
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




