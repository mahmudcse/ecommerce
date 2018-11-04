<?php 

if($complete == 1){ 
		 echo $success."<br>"; 
		
		 echo $loginLink;

	}elseif($complete == 0){
		echo $mailsent."<br>";

		echo $clickhere;

		}elseif($complete == 'recover_incomplete'){

		echo $mailsent."<br>";
		echo $clickhere;
	}