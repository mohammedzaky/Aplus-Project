<?php


	 include("DB.php");

      $id= 58;
      $q1="SELECT Course_ID, Professor_ID FROM semester_course_professor where Semester_ID =?;";      
      $rows_course_prof=$db->getRows($q1,array($id));
      	//course from semester_course_professor
    	
       	//echo "Course_ID from {semester_course_professor} table";
        echo "<br>"; 
        $course_prof_names = array();
	if(count($rows_course_prof)>0){
			
           foreach ($rows_course_prof as $row) 
                 {
                 
                   echo $row[0];
                   echo "<br>"; 
                   $q3="SELECT Course_name FROM course where Course_ID = ?";
                   $q4="SELECT Professor_name FROM professor WHERE Professor_ID = ?";

                   $row[0]=$db->getRow($q3,array($row[0]));
                   //$row[1]=$db->getRow($q4,array($row[1]));

                   array_push($course_prof_names,$row[0]);
                   //array_push($course_prof_names,$row[1]);
                 }
            }

    echo "<br>"; 
    echo "-----------------------------------------------------------------------------------------------------------------"; 
    echo "<br>";   
  if(count($rows_course_prof)>0){
      
           foreach ($rows_course_prof as $row) 
                 {
                 
                   //echo $row[0];
                   //echo "<br>"; 
                   $q3="SELECT Course_name FROM course where Course_ID = ?";
                   $q4="SELECT Professor_name FROM professor WHERE Professor_ID = ?";

                   //$row[0]=$db->getRow($q3,array($row[0]));
                   $row[1]=$db->getRow($q4,array($row[1]));

                   //array_push($course_prof_names,$row[0]);
                   array_push($course_prof_names,$row[1]);
                 }
            }
     echo "<br>"; 
    echo "-----------------------------------------------------------------------------------------------------------------"; 
    echo "<br>";   
      $arr = [1,2,3,4,5,6];
     if(count($course_prof_names)>0){
        $i=0;
        $str=sizeof($course_prof_names);

     		 foreach ($course_prof_names  as $row  ) 
                 {

                    
                    echo "
                        

                    $row[0]".$arr[$i];
                    echo "<br>"; 
                    $i++;
                 }

     }

    echo $str; 
    echo "<br>"; 
    echo "-----------------------------------------------------------------------------------------------------------------"; 
    echo "<br>"; 
    echo "Professor_ID";
    echo "<br>"; 
     $id= 58;	


/*
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
*/