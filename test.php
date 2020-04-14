<?php


	 include("DB.php");

      $id= 58;
      $q1="SELECT Course_ID  FROM semester_course_professor where Semester_ID =?;";      
      $rows_course=$db->getRows($q1,array($id));
      	//course from semester_course_professor
    	
    	echo "Course_ID from {semester_course_professor} table";
        echo "<br>"; 

	if(count($rows_course)>0){
			
			
            foreach ($rows_course as $row) 
                 {
                 	//course from semester_course_professor
                    echo "$row[0]";
                    echo "<br>"; 
                    //course from course table insert in this array
                   $q3="SELECT Course_name FROM course where Course_ID = ?";
                   $course_names=$db->getRow($q3,array($row[0]));
                 }
            }

    echo "<br>"; 
    echo "-----------------------------------------------------------------------------------------------------------------"; 
    echo "<br>";   

     if(count($course_names)>0){
     		
     		echo count($course_names);
     		 echo "<br>"; 

     		 foreach ($course_names as $row) 
                 {
                 	
                    echo "$row";
                    echo "<br>"; 
                  
                }

     }


    echo "<br>"; 
    echo "-----------------------------------------------------------------------------------------------------------------"; 
    echo "<br>"; 
    echo "Professor_ID";
    echo "<br>"; 
     $id= 58;	

      $q2 = "SELECT Professor_ID  FROM semester_course_professor where Semester_ID =?;";     
      $rows_prof=$db->getRows($q2,array($id));
      

       if(count($rows_prof)>0){

             foreach ($rows_prof as $row) 
                 {
                 	echo "$row[0]";
                    echo "<br>"; 
                    //$q2="SELECT Professor_name FROM professor WHERE Professor_ID = ?";
                    //$prof_names=$db->getRows($q2,array($row));
                 }
            }
            
?>
