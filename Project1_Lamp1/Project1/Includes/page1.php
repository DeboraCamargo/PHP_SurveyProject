<?php

$_SESSION["CurrentPage"]  = "Page1";

$fname="";
$age=0;
$studentopt=0;

//declaring error messsages variables
$fname_error_message = isset($_SESSION["fname_error_message"])? $_SESSION["fname_error_message"] : "";
$age_error_message = isset($_SESSION["age_error_message"])? $_SESSION["age_error_message"] : "";
$studentopt_error_message = isset($_SESSION["studentopt_error_message"])? $_SESSION["studentopt_error_message"] : "";	



function errorMessage($msg){
	if(!empty($msg)){
		echo "<div style='color:red; font-weight:bolder ' >".$msg."</div>";
	}
}

if(isset($_SESSION["fname"])){
	 $fname = $_SESSION["fname"];
}

if(isset($_SESSION["age"])){
	 $age = $_SESSION["age"];
}

if(isset($_SESSION["studentopt"])){
	 $studentopt = $_SESSION["studentopt"];
}

?>

    <main>

        <form method="POST">
            <div id="BoxInformation">
                <span class="Labels">Full Name</span>


                <input type="text" name="fname" class="TextBoxes" id="txtFullName" value="<?php echo $fname; ?>" />
                <?php errorMessage($fname_error_message); ?>

                <span class="Labels">Age</span>
                <input type="text" class="TextBoxes" id="txtAge" name="age" value="<?php echo $age; ?>" />
                <?php errorMessage($age_error_message); ?>

                <span class="Labels">Are you a student?</span>
                <select id="idStudent" class="SelType" name="studentopt">
                    <option value="0" <?php echo $studentopt == 0? "selected":"" ?>></option>
                    <option value="1" <?php echo $studentopt == 1? "selected":"" ?>>Yes, Full Time</option>
                    <option value="2" <?php echo $studentopt == 2? "selected":"" ?>>Yes, Part Time</option>
                    <option value="3" <?php echo $studentopt == 3? "selected":"" ?>>No</option>
                </select>
                <?php errorMessage($studentopt_error_message); ?>

            </div>

            <div id="BoxControl">
                <input type="submit" value="Next" class="buttons" name="toPage2" />
                <input type="submit" value="Previous Page" class="buttons" name="toStart" />
            </div>

        </form>
    </main>

