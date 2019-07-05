<?php
$_SESSION["CurrentPage"]  = "Page2";
function errorMessage($msg){
	if(!empty($msg)){
		echo "<div style='color:red; font-weight:bolder ' >".$msg."</div>";
	}
}
// Var name and the name of the object are the same
$What_Purchase_HomePhone = 0;
$What_Purchase_MobilePhone = 0;
$What_Purchase_SmartTV= 0;
$What_Purchase_Laptop= 0;
$What_Purchase_DesktopComputer= 0;
$What_Purchase_Tablet= 0;
$What_Purchase_HomeTheater= 0;
$HowPurchase = -1;

//declaring error messages variables
$Check_error_message= isset($_SESSION["Check_error_message"])? $_SESSION["Check_error_message"] : "";
$Radio_error_message = isset($_SESSION["Radio_error_message"])? $_SESSION["Radio_error_message"] : "";



if(isset($_SESSION["products"])){

	 $What_Purchase_HomePhone = in_array("Home_Phone",$_SESSION["products"])?1:0;
	 $What_Purchase_MobilePhone = in_array("Mobile_Phone",$_SESSION["products"])?1:0;
	 $What_Purchase_SmartTV = in_array("Smart_TV",$_SESSION["products"])?1:0;
	 $What_Purchase_Laptop = in_array("Laptop",$_SESSION["products"])?1:0;
	 $What_Purchase_DesktopComputer = in_array("Desktop_Computer",$_SESSION["products"])?1:0;
	 $What_Purchase_Tablet = in_array("Tablet",$_SESSION["products"])?1:0;
	 $What_Purchase_HomeTheater = in_array("Home_Theater",$_SESSION["products"])?1:0;
}
if(isset($_SESSION["HowPurchase"])){
	 $HowPurchase = $_SESSION["HowPurchase"];
}


?>

<main>

        <form method="POST">

            <div id="Options">

                <div id="CheckboxDiv">
                    <span class="Labels">Which of the following did you purchase?</span><br><br>
                    <input type="checkbox" name="What_Purchase_HomePhone" <?php echo $What_Purchase_HomePhone ==1? "checked":"" ?>><label>Home Phone</label><br>
                    <input type="checkbox" name="What_Purchase_MobilePhone" <?php echo $What_Purchase_MobilePhone ==1? "checked":"" ?>><label>Mobile Phone</label><br>
                    <input type="checkbox" name="What_Purchase_SmartTV" <?php echo $What_Purchase_SmartTV ==1? "checked":"" ?>><label>Smart TV</label><br>
                    <input type="checkbox" name="What_Purchase_Laptop"<?php echo $What_Purchase_Laptop ==1? "checked":"" ?>><label>Laptop</label><br>
                    <input type="checkbox" name="What_Purchase_DesktopComputer" <?php echo $What_Purchase_DesktopComputer ==1? "checked":"" ?>><label>Desktop Computer</label><br>
                    <input type="checkbox" name="What_Purchase_Tablet" <?php echo $What_Purchase_Tablet ==1? "checked":"" ?>><label>Tablet</label><br>
                    <input type="checkbox" name="What_Purchase_HomeTheater" <?php echo $What_Purchase_HomeTheater ==1? "checked":"" ?>><label>Home Theater</label>
                <?php errorMessage($Check_error_message); ?>
                </div>


                <div id="RadioDiv">
                    <span class="Labels">How did you complete your purchase?</span><br><br>
                    <input type="radio" name="HowPurchase" value="0" <?php echo $HowPurchase == 0? "checked":"" ?>> Online<br>
                    <input type="radio" name="HowPurchase" value="1" <?php echo $HowPurchase == 1? "checked":"" ?>> By phone<br>
                    <input type="radio" name="HowPurchase" value="2" <?php echo $HowPurchase == 2? "checked":"" ?>> Mobile App<br>
                    <input type="radio" name="HowPurchase" value="3" <?php echo $HowPurchase == 3? "checked":"" ?>> In store<br>
                <?php errorMessage($Radio_error_message); ?>
                </div>


            </div>


            <div id="BoxControl">
                <input type="submit" value="Next" class="buttons" name="toPage3" />
                <input type="submit" value="Back" class="buttons" name="toPage1" />
            </div>

        </form>
    </main>

