<!--Our project's UI code hugely refers to the tutorial7's code, we are actually modifying tutorial's code-->
<html>
    <head>
        <title>CPSC304 Group55 Genshin Wiki(Fake)</title>
    </head>

    <body>

        <h2>Insert Values into Material table</h2>
        <form method="POST" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            Name: <input type="text" name="insName"> <br /><br />
            Description: <input type="text" name="insDes"> <br /><br />

            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <hr />

        <h2>Update Name in Boss table</h2>
        <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>
        <p>Do not enter anything if you don't want to modify the corresponding attribute(s).</p>
        <p>Please specify the key of the entry you want to modify.</p>

        <form method="POST" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            Key: <input type="text" name="key"> <br /><br />
            New Description: <input type="text" name="newDescription"> <br /><br />
            New HP: <input type="text" name="newHP"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>

        <form method="GET" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="BossRequest" name="BossRequest">
            <input type="submit" value="Get all Boss" name="Boss"></p>
        </form>

        <hr />

        <h2>Delete a Material in Material table</h2>
        <p>The values are case sensitive and if you enter in the wrong case, the delete statement will not do anything.</p>

        <form method="POST" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="DeleteMaterialRequest" name="DeleteMaterialRequest">
            Material Name: <input type="text" name="MaterialName"> <br /><br />

            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>

        <form method="GET" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="MaterialRequest" name="MaterialRequest">
            <input type="submit" value="Get all Material" name="Material"></p>
        </form>

        <?php

        function handleDeleteMRequest() {
            global $db_conn;
            $mName = $_POST['MaterialName'];

            executePlainSQL("DELETE FROM Material WHERE MaterialName='" . $mName . "'");

            OCICommit($db_conn);

        }

        function handleGMRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT * FROM Material");
            printAllMaterial($result);
        }

        function printAllMaterial($result) {
            echo "<table>";
            echo "<tr><th>All Material</th><th>Desription</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["MATERIALNAME"] . "</td> <td>" . $row["DESCRIPTION"] . "</td></tr>"; 
            }

            echo "</table>";
        } 

        ?>

        <hr />

        <h2>Find an entry in database</h2>

        <form method="GET" action="Project_file.php"> <!--refresh page when submitted-->
            SELECT: <select name = "select1">
                        <option value="Null"> </option>
                        <option value="Name">Name</option>
                        <option value="Description">Description</option>
                    </select>
                    <select name = "select2">
                        <option value="Null"> </option>
                        <option value="Name">Name</option>
                        <option value="Description">Description</option>
                    </select>
            FROM: <select name = "from">
                        <option value="Character">Character</option>
                        <option value="Weapon">Weapon</option>
                  </select>
            WHERE: AscendRank = <select name = "where">
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                    </select>
            <input type="hidden" id="FindCharacterRequest" name="FindCharacterRequest">
            <input type="submit" value="Find" name="FindCharacter"></p>
        </form>

        <hr />

        <h2>Find the character who are recommended all artifacts</h2>
        <form method="GET" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="SuperCharacterRequest" name="SuperCharacterRequest">
            <input type="submit" value="Find" name="SuperCharacter"></p>
        </form>

        <hr />

        <h2>Find the Minimal Boss HP for each type of Boss</h2>
        <form method="GET" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="MinimalHPRequest" name="MinimalHPRequest">
            <input type="submit" value="Find" name="MinimalHP"></p>
        </form>

        <hr />

        <h2>Find the Maximal baseATK for each weapon rarity having at least 2 weapons</h2>
        <form method="GET" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="MaximalATKRequest" name="MaximalATKRequest">
            <input type="submit" value="Find" name="MaximalATK"></p>
        </form>   

        
        <hr />
        
        <h2>View details of material dropped by boss</h2>
        <form method="GET" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="BossMatRequest" name="BossMatRequest">
            Boss Name: <input type="text" name="BossName"> <br /><br />
            <input type="submit" value="Find" name="BossMat"></p>
        </form>

        <hr />

        <h2>Select the countries with the lowest average boss HP.</h2>
        <form method="GET" action="Project_file.php"> <!--refresh page when submitted-->
            <input type="hidden" id="WeakCountryRequest" name="WeakCountryRequest">
            <input type="submit" value="Find" name="WeakCountry"></p>
        </form>   

        <?php
		//this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr); 
            //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

			return $statement;
		}

        function executeBoundSQL($cmdstr, $list) {
            /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection. 
		See the sample code below for how this function is used */

			global $db_conn, $success;
			$statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<br>".$bind."<br>";
                    OCIBindByName($statement, $bind, $val);
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
				}

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }


        function connectToDB() {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example, 
			// ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_yluxue", "a72813637", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleMaxATKRequest() {
            global $db_conn;
            $result = executePlainSQL("SELECT rarity, max(baseatk) atk from weaponrefinement wr, weaponstatus ws where wr.refinementrank = ws.refinementrank group by rarity having count(*)>1");

            printMATKResult($result);
        }

        function printMATKResult($result) {
            echo "<br>Maximal ATK for each weapon rarity:<br>";
            echo "<table>";
            echo "<tr><th>Rarity</th><th>Maximal ATK</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["RARITY"] . "</td> <td>" . $row["ATK"] . "</td></tr>"; 
                //or just use "echo $row[0]"   
            }

            echo "</table>";
        }

        function handleMinimalHpRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT BossType, MIN(HP) hp FROM BossLocation GROUP BY BossType");

            printMHPResult($result);
        }

        function printMHPResult($result) {
            echo "<br>Minimal HP for each type of Boss:<br>";
            echo "<table>";
            echo "<tr><th>BossType</th><th>MinimalHP</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["BOSSTYPE"] . "</td> <td>" . $row["HP"] . "</td></tr>"; 
            }

            echo "</table>";
        }

        function handleSCRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT c.Name FROM Character c WHERE NOT EXISTS((SELECT a.Name FROM Artifact a) MINUS (SELECT r.ArtifactName FROM ArtifactRecommendation r WHERE r.CharacterName = c.Name))");

            printSCResult($result);
        }

        function printSCResult($result) {
            echo "<br>The character who are recommended all artifact is:<br>";
            echo "<table>";
            echo "<tr><th>CharacterName</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["NAME"] . "</td></tr>"; 
            }

            echo "</table>";
        }

        function handleFCRequest() {
            global $db_conn;
            $selected1 = $_GET['select1'];
            $selected2 = $_GET['select2'];
            if ($selected1 == "Null") {
                $selected1 = "";
            } else if ($selected2 == "Null"){
                $selected1 = $selected1 . " ";
            } else {
                $selected1 = $selected1 . ", ";
            }
            if ($selected2 == "Null") {
                $selected2 = "";
            } else {
                $selected2 = $selected2 . " ";
            }
            $selected3 = $_GET['from'];
            $selected4 = $_GET['where'];

            echo "SELECT " . $selected1 . $selected2 . "FROM " . $selected3 . " WHERE AscendRank = " . $selected4;

            $result = executePlainSQL("SELECT " . $selected1 . $selected2 . "FROM " . $selected3 . " WHERE AscendRank = " . $selected4);

            $selected1 = $_GET['select1'];
            $selected2 = $_GET['select2'];
            if ($selected1 == "Name" && $selected2 == "Description") {
                echo "<br>The result of query is:<br>";
                echo "<table>";
                echo "<tr><th>Name</th><th>Description</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["NAME"] . "</td> <td>" . $row["DESCRIPTION"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($selected1 == "Name" && $selected2 == "Null") {
                echo "<br>The result of query is:<br>";
                echo "<table>";
                echo "<tr><th>Name</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["NAME"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($selected1 == "Null" && $selected2 == "Description") {
                echo "<br>The result of query is:<br>";
                echo "<table>";
                echo "<tr><th>Description</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["DESCRIPTION"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($selected1 == "Null" && $selected2 == "Name") {
                echo "<br>The result of query is:<br>";
                echo "<table>";
                echo "<tr><th>Name</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["NAME"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($selected1 == "Description" && $selected2 == "Null") {
                echo "<br>The result of query is:<br>";
                echo "<table>";
                echo "<tr><th>Description</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["DESCRIPTION"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($selected1 == "Description" && $selected2 == "Name") {
                echo "<br>The result of query is:<br>";
                echo "<table>";
                echo "<tr><th>Description</th><th>Name</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["DESCRIPTION"] . "</td> <td>" . $row["NAME"] . "</td></tr>"; 
                }
                echo "</table>";
            }
        }

        function printResult($result) { //prints results from a select statement
            echo "<br>Retrieved data from table demoTable:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; //or just use "echo $row[0]" 
            }

            echo "</table>";
        }

        function handleUpdateRequest() {
            global $db_conn;

            $key = $_POST['key'];
            $new_description = $_POST['newDescription'];
            $new_hp = $_POST['newHP'];

            $old_name = $_POST['oldName'];
            $new_name = $_POST['newName'];

            if ($new_description == "" ) {
                executePlainSQL("UPDATE BossLocation SET HP='" . $new_hp . "' WHERE BossName='" . $key . "'");
                OCICommit($db_conn);
            } else if ($new_hp == "") {
                executePlainSQL("UPDATE BossLocation SET Description='" . $new_description . "' WHERE BossName='" . $key . "'");
                OCICommit($db_conn);
            } else {
                executePlainSQL("UPDATE BossLocation SET HP='" . $new_hp . "' WHERE BossName='" . $key . "'");
                executePlainSQL("UPDATE BossLocation SET Description='" . $new_description . "' WHERE BossName='" . $key . "'");
                OCICommit($db_conn);
            }
        }

        function handleGBRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT BossName, Description, HP FROM BossLocation");
            printAllBoss($result);
        }

        function printAllBoss($result) {
            echo "<br>All entries in Boss table:<br>";
            echo "<table>";
            echo "<tr><th>BossNamen</th><th>Description</th><th>HP</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["BOSSNAME"] . "</td> <td>" . $row["DESCRIPTION"] . "</td> <td>" . $row["HP"] . "</td></tr>"; 
            }
            echo "</table>";
        }

        function handleInsertRequest() {
            global $db_conn;
            $mName = $_POST['insName'];
            $mDescription = $_POST['insDes'];
    
            executePlainSQL("INSERT INTO Material VALUES('" . $mName . "', '" . $mDescription . "' )");
    
             OCICommit($db_conn);
			
        }

        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('DeleteMaterialRequest', $_POST)) {
                    handleDeleteMRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                }

                disconnectFromDB();
            }
        }


        function handleBMRequest() {
			global $db_conn;

		   $bossName = $_GET['BossName'];

		   $result = executePlainSQL("SELECT b.BossName, m.MaterialName, m.Description FROM BossReward b, Material m WHERE b.materialname = m.materialname and b.BossName = '" . $bossName . "'");
		   
           printMaterial($result);
           
	   }

       function printMaterial($result) {
        echo "<br>All entries in Boss table:<br>";
        echo "<table>";
        
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>Boss Name</td><td></td> <td>" . $row["BOSSNAME"] . "<td><td></tr><td> Material Name</td><td></td> <td>" . $row["MATERIALNAME"] . "</tr><td>Material Description</td><td></td> <td>" . $row["DESCRIPTION"] . "</td></tr>"; 
        }
        echo "</table>";
        
       
    } 
    
	   

        
	   function handleWQRequest() {
		global $db_conn;


	   $result = executePlainSQL("SELECT CountryName, avg(hp) FROM BossLocation B GROUP BY CountryName
	   HAVING avg(hp) <= all(SELECT AVG(B.hp) FROM BossLocation B GROUP BY CountryName) ");
	   
       printWQ($result);
    }

       function printWQ($result) {
        echo "<br>All entries in Boss table:<br>";
        echo "<table>";
        echo "<tr><th>Country</th><th></th><th>Average Boss HP</th></tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["COUNTRYNAME"] . "</th> <th>". "</th> <th>" . $row["AVG(HP)"] ; 
        }
        echo "</table>";

        
    }
       

        // HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('MinimalHP', $_GET)) {
                    handleMinimalHpRequest();
                } else if (array_key_exists('SuperCharacter', $_GET)) {
                    handleSCRequest();
                } else if (array_key_exists('MaximalATK', $_GET)) {
                    handleMaxATKRequest();
                } else if (array_key_exists('FindCharacter', $_GET)) {
                    handleFCRequest();
                } else if (array_key_exists('Material', $_GET)) {
                    handleGMRequest();
                } else if (array_key_exists('Boss', $_GET)) {
                    handleGBRequest();
                }else if (array_key_exists('WeakCountry', $_GET)) {
                    handleWQRequest();
                }else if (array_key_exists('BossMat', $_GET)) {
                    handleBMRequest();
                }

                disconnectFromDB();
            }
        }

		if (isset($_POST['deleteSubmit']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['MinimalHPRequest']) || isset($_GET['MaximalATKRequest']) || isset($_GET['FindCharacterRequest']) || isset($_GET['SuperCharacterRequest']) || isset($_GET['MaterialRequest']) || isset($_GET['WeakCountryRequest']) ||  isset($_GET['BossMatRequest']) | isset($_GET['BossRequest']) ) {
            handleGETRequest();
        }
		?>
	</body>
</html>