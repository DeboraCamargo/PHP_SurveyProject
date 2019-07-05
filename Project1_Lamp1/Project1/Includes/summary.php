<?php

$_SESSION["CurrentPage"] = "summary";

function errorMessage($msg){
	if(!empty($msg)){
		echo "<div style='color:red; font-weight:bolder ' >".$msg."</div>";
	}
}


$product = array();
if(isset($_SESSION["products"])){
	$product = $_SESSION["products"];

}
$Happy = array();
if(isset($_SESSION["happy"])){
	$Happy = $_SESSION["happy"];
}
$Recommed = array();
if(isset($_SESSION["recommend"])){
	$Recommed = $_SESSION["recommend"];

}




?>
    <main>

        <form method="POST">
            <div id="tableInfo">
                <table>
                    <tr>
                        <th>Full Name</th>
				<td><?php echo $_SESSION["fname"]?></td>
                    </tr>
                    <tr>
                        <th>Age</th>
				<td><?php echo $_SESSION["age"]?></td>
                    </tr>
                    <tr>
                        <th>Student?</th>
				<td><?php 
				      switch ($_SESSION["studentopt"]){
					case 0: echo "not selected";
						break;
					case 1: echo "Yes, Full Time";
						break;
					case 2: echo "Yes, Part Time";
						break;
					case 3: echo "No";
						break;
					default:

					} ?></td></tr>
                    <tr>
                        <th>How Purchased</th>
		<td><?php 
				      switch ($_SESSION["HowPurchase"]){
					case 0: echo "Online";
						break;
					case 1: echo "By phone";
						break;
					case 2: echo "Mobile App";
						break;
					case 3: echo "In store";
						break;
					default: echo "not selected";

					} ?></td></tr>

 			</table>

		 <table>
                   
                    <tr>
                        <th>What Purchased</th>                    
                        <th>Satisfation</th>
                        <th>Recommend</th>
                    </tr>
				<?php
				for($x = 0; $x < count($product); $x++){
				 ?>
				<tr><td><?php echo $product[$x] ?></td>
				<td>
					<?php 
				      switch ($Recommed[$product[$x]]){
					case 0: echo "No selected";
						break;
					case 1: echo "Yes";
						break;
					case 2: echo "Maybe";
						break;
					case 3: echo "No";
						break;
					default: 

					} ?></td>

				<td><?php echo $Happy[$product[$x]] ?></td>
				
				</tr>

				<?php
				
				} ?>


                </table>
            </div>

            <div id="BoxControl">
                <input type="submit" value="Save" class="buttons" name="SaveFormularie" />
                <input type="submit" value="Previous Page" class="buttons" name="toPage3" />
            </div>

        </form>
    </main>

