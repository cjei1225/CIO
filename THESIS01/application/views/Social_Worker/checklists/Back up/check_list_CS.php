<?php

$Fname = array(
	'name'	=> 'Fname',
	'id'	=> 'Fname',
	'placeholder'	=> 'First Name',
	'value' => set_value('Fname'),
	'maxlength'	=> 50,
	'size'	=> 15,
	'class' => 'form-control',
);

$Lname = array(
	'name'	=> 'Lname',
	'id'	=> 'Lname',
	'placeholder'	=> 'Last Name',
	'value'	=> set_value('Lname'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$Mname = array(
	'name'	=> 'Mname',
	'id'	=> 'Mname',
	'placeholder'	=> 'Middle Name',
	'value' => set_value('Mname'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$Sector = array(
	'name'	=> 'Sector',
	'id'	=> 'Sector',
	'value' => set_value('Sector'),
	'class' => 'form-control',
);

$Sector_number = array(
         '1'  => 'Child and Youth',
         '2'  => 'Older Persons',
         '3'  => 'Persons with Special Needs',  
		 '4'  => 'Persons in Crisis Situation',  
);

$Dorm = array(
	'name'	=> 'Dorm',
	'id'	=> 'Dorm',
	'placeholder'	=> 'Dorm',
	'value' => set_value('Dorm'),
	'maxlength'	=> 1,
	'size'	=> 15,
	'class' => 'form-control',
);


$SocialW = array(
	'name'	=> 'SocialW',
	'id'	=> 'SocialW',
	'value' => set_value('SocialW'),
	'maxlength'	=> 1,
	'size'	=> 15,
	'class' => 'form-control',
);

$Gender = array(
	'name'	=> 'Gender',
	'id'	=> 'Gender',
	'value' => set_value('Gender'),
	'class' => 'form-control',
);

$GenderOptions = array(
	'1'  => 'Male',
	'2'  => 'Female',
);

$Birthday = array(
	'name'	=> 'Birthday',
	'id'	=> 'Birthday',
	'placeholder'	=> 'Date of Birth',
	'value' => set_value('Birthday'),
	'class' => 'form-control',
);

$Birthplace = array(
	'name'	=> 'Birthplace',
	'id'	=> 'Birthplace',
	'placeholder'	=> 'Place of Birth',
	'value' => set_value('Birthplace'),
	'maxlength'	=> 30,
	'size'	=> 15,
	'class' => 'form-control',
);

$Age = array(
	'name'	=> 'Age',
	'id'	=> 'Age',
	'placeholder'	=> 'Age',
	'value' => set_value('Age'),
	'maxlength'	=> 2,
	'size'	=> 15,
	'class' => 'form-control',
);
?>


<main >
    <div class="container">
      	<fieldset class="z-depth-2">    
            <center><img src="title logo.png" width="100" height="100"></center>
            <center>
                <h5>HOSPICIO DE SAN JOSE</h5>
                <h7>Ayala Bridge, Manila</h7>
                <h6 >Social Service Department</h6>
                <h6 >Children and Youth Welfare Development Program</h5>
                <h6 >Adoption Services</h6>
        	</center>
            <center>
            	<h6 ><b>CHECKLIST</b></h6>
        	</center>
       
         	<h5 class="divider black"></h5>
            <div class="form-group">
            	<label ><b>BASIC INFORMATION</b></label>
            	<br>
            
            	<label >Name:</label>
             	<br>
            	<label>Nickname:</label>
            	<br>
            	<label>Age:</label>
            	<br>
            	<label >Gender:</label>
            	<br>
            	<label >Date of Birth [Given]:</label>
            	<br>
                <label >Place Found:</label>
               	<br>
               	<label >Birth Status:</label>
               	<br>
               	<label>Religion:</label>
               	<br>
                <label>Nationality:</label>
               	<br>
               	<label >Grade Level:</label>
               	<br>
               	<label>School Attended:</label>
               	<br>
                <label>Date Admitted:</label>
               	<br>
                <label>Source of Referral:</label>
               	<br>
               	<label >Case Category:</label>
               	<br> 
               	<label ><b>DOCUMENT ON FILE</b></label>
               	<br>
               	<br>
           	</div>
           		<div class="row">
             		<div class="table-responsive col s12 m6">
          				<table>
		                    <tbody>
		                    	<tr>
		                        	<td><input id="check1" type="checkbox" ><label for="check1"></label></td>
		                        	<td>Intake Sheet</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check2" type="checkbox" ><label for="check2"></label></td>
		                        	<td>Admission Slip</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check3" type="checkbox" ><label for="check3"></label></td>
		                        	<td>Child Study Report</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                        	<td><input id="check4" type="checkbox" ><label for="check4"></label></td>
		                        	<td>Birth Certificate [Local/Secpa]</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                        	<td><input id="check5" type="checkbox" ><label for="check5"></label></td>
		                        	<td>Foundling Certificate [Local/Secpa]</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check6" type="checkbox" ><label for="check6"></label></td>
		                        	<td>Baptismal Certificate</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check7" type="checkbox" ><label for="check7"></label></td>
		                        	<td>Confirmation Certificate</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check8" type="checkbox" ><label for="check8"></label></td>
		                        	<td>Marriage Certificate of Parent</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check9" type="checkbox" ><label for="check9"></label></td>
		                        	<td>Death Certificate of Parent/s</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check10" type="checkbox" ><label for="check10"></label></td>
		                        	<td>Recordings</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                      	
		                      	<tr>
		                        	<td><input id="check11" type="checkbox" ><label for="check11"></label></td>
		                        	<td>Progress Report</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                        	<td><input id="check12" type="checkbox" ><label for="check12"></label></td>
		                        	<td>Health and Medical Abstarct/Records</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                        
		                        <tr>
		                        	<td><input id="check13" type="checkbox" ><label for="check13"></label></td>
		                        	<td>Psychological Evaluation Report</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                         	<td><input id="check14" type="checkbox" ><label for="check14"></label></td>
		                        	<td>Psychiatric Evaluation Report</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                        	<td><input id="check15" type="checkbox" ><label for="check15"></label></td>
		                        	<td>OT/PT/ST/ Developmental Assessment</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                        	<td><input id="check16" type="checkbox" ><label for="check16"></label></td>
		                        	<td>Child's School Report/Card</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                        	<td><input id="check17" type="checkbox" ><label for="check17"></label></td>
		                        	<td>Referral Letter</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                        	<td><input id="check18" type="checkbox" ><label for="check18"></label></td>
		                        	<td>Picture [upon admission/recent]</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       	
		                       	<tr>
		                        	<td><input id="check19" type="checkbox" ><label for="check19"></label></td>
		                        	<td>Footprints/ Handprints upon admission</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                       
		                      	<tr>
		                        	<td><input id="check20" type="checkbox" ><label for="check20"></label></td>
		                        	<td>Incidental Reports</td>
		                        	<td>03-04-2015</td>
		                      	</tr>
		                    </tbody>
        				</table>
           			</div>
           			<div class="table-responsive col s12 m6">
	                	<table >
	                    	<tbody>
	                      	<tr>
	                        	<td><input id="check21" type="checkbox" ><label for="check21"></label></td>
	                        	<td>Deed of Volunatry Commitment [DVC]</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check22" type="checkbox" ><label for="check22"></label></td>
	                        	<td>Letter of Mother</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check23" type="checkbox" ><label for="check23"></label></td>
	                        	<td>Barangay/ Police Blotter/ Report</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check24" type="checkbox" ><label for="check24"></label></td>
	                        	<td>Barangay Certification of Non-residency</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                        
	                        <tr>
	                        	<td></td>
	                        	<td style="height:25px;">Media Certification</td>
	                        	<td></td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check25" type="checkbox" ><label for="check25"></label></td>
	                        	<td>Radio Station/s Certification</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check26" type="checkbox" ><label for="check26"></label></td>
	                        	<td>Newspaper Publication</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check27" type="checkbox" ><label for="check27"></label></td>
	                        	<td>Returned Registered Mail/Letter</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check28" type="checkbox" ><label for="check28"></label></td>
	                        	<td>Pettion for Declareded Abandoned</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       
	                       	<tr>
	                        	<td><input id="check29" type="checkbox" ><label for="check29"></label></td>
	                        	<td>CDCLAA Copy</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check30" type="checkbox" ><label for="check30"></label></td>
	                        	<td>Affidavit of the FInder</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                       	
	                       	<tr>
	                        	<td><input id="check31" type="checkbox" ><label for="check31"></label></td>
	                        	<td>Notice of Posting</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                      	
	                      	<tr>
	                        	<td><input id="check32" type="checkbox" ><label for="check32"></label></td>
	                        	<td>Child's Profile <input id="check32.1" type="checkbox" ><label for="check32.1">Local</label> <input id="check32.2" type="checkbox" ><label for="check32.2">ICAB</label></td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                      	
	                      	<tr>
	                        	<td><input id="check33" type="checkbox" ><label for="check33"></label></td>
	                        	<td>Health and Medical Profile (ICAB Form)</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                      	
	                      	<tr>
	                        	<td><input id="check34" type="checkbox" ><label for="check34"></label></td>
	                        	<td>Pedia-clearance</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                      	
	                      	<tr>
	                        	<td><input id="check35" type="checkbox" ><label for="check35"></label></td>
	                        	<td>Court's Decision</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                      	
	                      	<tr>
	                        	<td><input id="check36" type="checkbox" ><label for="check36"></label></td>
	                        	<td>Certificate of Finality</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                      	
	                      	<tr>
	                        	<td><input id="check37" type="checkbox" ><label for="check37"></label></td>
	                        	<td>Supplemental Report</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                      	
	                      	<tr>
	                        	<td><input id="check38" type="checkbox" ><label for="check38"></label></td>
	                        	<td>Discharge Slip</td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                      	
	                      	<tr>
	                        	<td><input id="check40" type="checkbox" ><label for="check40"></label></td>
	                        	<td>Others[specify] <input type="text" style="width:200px; margin-top:-50px; margin-bottom:-9px;"/></td>
	                        	<td>03-04-2015</td>
	                      	</tr>
	                    </tbody>
	                </table>
	            </div> 
	        </div>
	    	
	    	<div>
	            <label ><b>POST-ADMISSION</b></label>
	            <br>
	            <table>
                    <tbody>
                      	<tr>
                        	<td><input id="check41" type="checkbox" ><label for="check41"></label></td>
                        	<td>1st Post-Admission Report Recieved</td>
                        	<td>03-04-2015</td>
                      	</tr>
                      	
                      	<tr>
                        	<td><input id="check42" type="checkbox" ><label for="check42"></label></td>
                        	<td>1st Post-Admission Report Recieved</td>
                        	<td>03-04-2015</td>
                      	</tr>
                      	
                      	<tr>
                        	<td><input id="check43" type="checkbox" ><label for="check43"></label></td>
                        	<td>1st Post-Admission Report Recieved</td>
                        	<td>03-04-2015</td>
                      	</tr>
                       	
                       	<tr>
                        	<td><input id="check44" type="checkbox" ><label for="check44"></label></td>
                        	<td>Adoption Degree Received</td>
                        	<td>03-04-2015</td>
                    	</tr>
                    </tbody>
                </table>  
            </div>
        </fieldset>
    </div>
</main>

         	<script type="text/javascript">
    $(function() {
       $( "#datepicker" ).datepicker();
    });
    </script>