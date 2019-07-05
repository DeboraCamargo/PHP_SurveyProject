<?php
$_SESSION["CurrentPage"]  = "Page3";



function errorMessage($msg){

	if(isset($_SESSION[$msg]) and !empty($_SESSION[$msg])){
		
		echo "<div style='color:red; font-weight:bolder ' >".$_SESSION[$msg]."</div>";
	}
}

// if theres any value( checkbox filled) in the session, it will bring everything inside the variable product
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


<?php
for($x = 0; $x < count($product); $x++){
?>
            <div id="Options">
		<p><?php echo $product[$x] ?></p>

                <div id="DropdownDiv">
                    <span class="Labels">Would you recommend the purchase of this device to a friend?</span><br><br>
                    <select  class="SelType" name="Recommend_<?php echo $product[$x] ?>">
                        <option value="0" <?php echo $Recommed[$product[$x]] == 0? "selected":"" ?>></option>
                        <option value="1" <?php echo $Recommed[$product[$x]] == 1? "selected":"" ?>>Yes</option>
                        <option value="2" <?php echo $Recommed[$product[$x]] == 2? "selected":"" ?>>Maybe</option>
                        <option value="3" <?php echo $Recommed[$product[$x]] == 3? "selected":"" ?>>No</option>
                    </select>
                <?php errorMessage($product[$x]."_Recommend_error_message"); ?>
                </div>


                <div id="RadioDiv">
                    <span class="Labels">How happy are you with this device on a scale from 1 (not satisfied) to 5
                        (Very
                        satisfied)?</span><br><br>
                    <input type="radio" name="Happy_<?php echo $product[$x] ?>" value="1" <?php echo $Happy[$product[$x]] == 1? "checked":"" ?>>1
                    <input type="radio" name="Happy_<?php echo $product[$x] ?>" value="2" <?php echo $Happy[$product[$x]] == 2? "checked":"" ?>>2
                    <input type="radio" name="Happy_<?php echo $product[$x] ?>" value="3" <?php echo $Happy[$product[$x]] == 3? "checked":"" ?>>3
                    <input type="radio" name="Happy_<?php echo $product[$x] ?>" value="4" <?php echo $Happy[$product[$x]] == 4? "checked":"" ?>>4
                    <input type="radio" name="Happy_<?php echo $product[$x] ?>" value="5" <?php echo $Happy[$product[$x]] == 5? "checked":"" ?>>5
                <?php errorMessage($product[$x]."_Satisfied_error_message"); ?>
                </div>

            </div>
<?php
}
?>
            <div id="BoxControl">
                <input type="submit" value="Next" class="buttons" name="toSummary" />
                <input type="submit" value="Previous Page" class="buttons" name="toPage2" />
            </div>

        </form>
    </main>






