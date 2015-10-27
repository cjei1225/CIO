<?php 
foreach($client_info as $row_info) 
{
  $client_id      = $row_info->client_id;
  $client_fname   = $fname   = $row_info->client_fname;
  $client_lname   = $lname   = $row_info->client_lname;
  $nickname       = $row_info->nickname;
  $gender         = $row_info->gender;
  $birthplace     = $birth_place     = $row_info->birthplace;
  $birthday       = $row_info->birthday;
  $dorm_id        = $row_info->dorm_id;
  $sw_id          = $row_info->sw_id;
  $d_name         = $row_info->d_name;
  $admission_type = $row_info->admission_type;
  $client_sector  = $sector = $row_info->client_sector;
  $profile_pic    = $row_info->profile_pic;
  $status         = $client_status  = $row_info->client_status;
  $created        = $row_info->created;
  $nationality    = $row_info->nationality;
  $religion       = $row_info->religion;
  $educAttain     = $row_info->educ_attained;
  $dorm_name      = $row_info->d_name;
}

if($birthday != null)
{
  $age = ageCalculator($birthday);
}
else
{
  $age = ageCalculator($created);
}
function ageCalculator($birthday){
  if(!empty($birthday)){
    $birthdate = new DateTime($birthday);
    $today   = new DateTime(date("Y/m/d"));
    $age = $birthdate->diff($today)->y;
    return $age;
  }else{
    return 0;
  }
}
if($birthday != null){
$age = ageCalculator($birthday);
}
else{
$age = ageCalculator($birthday).'(admit date, no birthday)';
}
?>
