<?php foreach($health as $row_info) 
      {
          $created        = date('F-d-Y', strtotime($row_info->created));
          $client_id      = $row_info->client_id;
          $fname          = $row_info->client_fname;
          $mname          = $row_info->client_mname;
          $lname          = $row_info->client_lname;
          $case           = $row_info->client_sector;
          $gender         = $row_info->gender;
          $age            = $row_info->age;
          $Birthday       = $row_info->birthday;
          $nickname       = $row_info->nickname;
          $height         = $row_info->height;
          $weight         = $row_info->weight;
          $head_circum    = $row_info->head_circum;
          $chest_circum   = $row_info->chest_circum;
          $abdo_circum    = $row_info->abdomen_circum;
          $hair_color     = $row_info->hair_color;
          $eye_color      = $row_info->eye_color;
          $skin_color     = $row_info->skin_color;
          $present_loc    = $row_info->present_loc;
          $admission_app  = $row_info->admission_app;
          $marks_physical = $row_info->marks_physical;

          $abno_head      = $row_info->abno_head;
          $abno_eyes      = $row_info->abno_eyes;
          $abno_nose      = $row_info->abno_nose;
          $abno_ears      = $row_info->abno_ears;
          $abno_mouth     = $row_info->abno_mouth;
          $abno_neck      = $row_info->abno_neck;
          $abno_chest     = $row_info->abno_chest;
          $abno_adbo      = $row_info->abno_adbo;
          $abno_gen       = $row_info->abno_gen;
          $abno_spinal    = $row_info->abno_spinal;
          $abno_extre     = $row_info->abno_extre;
          $abno_pulse     = $row_info->abno_pulse;
          $abno_blood     = $row_info->abno_blood;
          $abno_ner       = $row_info->abno_ner;
          $abno_res       = $row_info->abno_res;
          $abno_skin      = $row_info->abno_skin;
          $obser_head     = $row_info->obser_head;
          $obser_eyes     = $row_info->obser_eyes;
          $obser_nose     = $row_info->obser_nose;
          $obser_ears     = $row_info->obser_ears;
          $physi_mmr      = $row_info->physi_mmr;
          $obser_mouth    = $row_info->obser_mouth;
          $obser_neck     = $row_info->obser_neck;
          $obser_chest    = $row_info->obser_chest;
          $obser_abdo     = $row_info->obser_abdo;
          $obser_gen      = $row_info->obser_gen;
          $obser_spinal   = $row_info->obser_spinal;
          $obser_extre    = $row_info->obser_extre;
          $obser_pulse    = $row_info->obser_pulse;
          $obser_blood    = $row_info->obser_blood;
          $obser_ner      = $row_info->obser_ner;
          $obser_res      = $row_info->obser_res;
          $obser_skin     = $row_info->obser_skin;

          $gestation_age  = $row_info->gestation_age;
          $full_term      = $row_info->full_term;
          $pre_mature     = $row_info->pre_mature;
          $normal_deli    = $row_info->normal_deli;
          $caesarian_deli = $row_info->caesarian_deli;
          $forcep         = $row_info->forcep;
          $born_at        = $row_info->born_at;
          $delivery_by    = $row_info->delivery_by;
          $deliver_name   = $row_info->deliver_name;
          $complication   = $row_info->complication;
          $weight_birth   = $row_info->weight_birth;
          $length_birth   = $row_info->length_birth;
          $head_cir_birth = $row_info->head_cir_birth;
          $chest_cir_birth  = $row_info->chest_cir_birth;
          $apgar_score    = $row_info->apgar_score;
          $abnormal_birth = $row_info->abnormal_birth;

          $date_bcg       = $row_info->date_bcg;
          $physi_bcg      = $row_info->physi_bcg;
          $date_dpt_1     = $row_info->date_dpt_1;
          $physi_dpt_1    = $row_info->physi_dpt_1;
          $date_dpt_2     = $row_info->date_dpt_2;
          $physi_dpt_2    = $row_info->physi_dpt_2;
          $date_dpt_3     = $row_info->date_dpt_3;
          $physi_dpt_3    = $row_info->physi_dpt_3;
          $date_dpt_boos  = $row_info->date_dpt_boos;
          $physi_dpt_boos = $row_info->physi_dpt_boos;
          $date_opv_1     = $row_info->date_opv_1;
          $physi_opv_1    = $row_info->physi_opv_1;
          $date_opv_2     = $row_info->date_opv_2;
          $physi_opv_2    = $row_info->physi_opv_2;
          $date_opv_3     = $row_info->date_opv_3;
          $physi_opv_3    = $row_info->physi_opv_3;
          $date_opv_boos  = $row_info->date_opv_boos;
          $physi_opv_boos = $row_info->physi_opv_boos;
          $date_measles   = $row_info->date_measles;
          $physi_measles  = $row_info->physi_measles;
          $date_mmr       = $row_info->date_mmr;
          $physi_mmr      = $row_info->physi_mmr;
          $date_hib_1     = $row_info->date_hib_1;
          $physi_hib_1    = $row_info->physi_hib_1;
          $date_hib_2     = $row_info->date_hib_2;
          $physi_hib_2    = $row_info->physi_hib_2;
          $date_hib_3     = $row_info->date_hib_3;
          $physi_hib_3    = $row_info->physi_hib_3;
          $date_hib_boos  = $row_info->date_hib_boos;
          $physi_hib_boos = $row_info->physi_hib_boos;
          $date_hepa_1    = $row_info->date_hepa_1;
          $physi_hepa_1   = $row_info->physi_hepa_1;
          $date_hepa_2    = $row_info->date_hepa_2;
          $physi_hepa_2   = $row_info->physi_hepa_2;
          $date_hepa_3    = $row_info->date_hepa_3;
          $physi_hepa_3   = $row_info->physi_hepa_3;
          $date_hepa_boos = $row_info->date_hepa_boos;
          $physi_hepa_boos= $row_info->physi_hepa_boos;
          $date_other     = $row_info->date_other;
          $physi_other    = $row_info->physi_other;

          $ill_active     = $row_info->ill_active;
          $ill_compli     = $row_info->ill_compli;
          $ill_accident   = $row_info->ill_accident;

          $med_child      = $row_info->med_child;
          $med_take       = $row_info->med_take;
          $med_physician  = $row_info->med_physician;
          $med_reason     = $row_info->med_reason;
          $med_seizure    = $row_info->med_seizure;
          $med_chronic    = $row_info->med_chronic;
          $med_allergic   = $row_info->med_allergic;
          $med_allergic_med = $row_info->med_allergic_med;
          $dental_health  = $row_info->dental_health;
          $dental_progress = $row_info->dental_progress;

          $notes_reco     = $row_info->notes_reco;
          
          $doctor         = $row_info->doctor;
          $license_no     = $row_info->license_no;
          $ptr_no         = $row_info->ptr_no;
          $hospital_clinic = $row_info->hospital_clinic;


      }
      if ($gender == 1){$gender = "Male";} elseif($gender == 2){$gender = "Female";}
      if ($case == 1){$case = "Child and Youth";} elseif($case == 2){$case = "Older Person";}elseif($case == 3){$case = "Special Needs";}elseif($case == 4){$case = "Crisis Situation";}
       $date = date('F-d-Y');
    

$html='  
<main >
  <div class="container">
  <div style="text-align:center;">
   <img src="' .base_url().'materialize/title logo.png" width="100" height="100">
  </div>
    <p style="text-align:right;">Date : '.$date.'</p>
    <h6 style="text-align:center;"><b>HEALTH AND MEDICAL PROFILE</b><br>
    (Should be typewritten or please write legibly in print)</h6>
    <div class ="row">
      <div class="col s6">
      <h5 class="divider black"></h5>
      <div class="form-group">
        <label><b>I. CLIENT\'S IDENTIFYING INFORMATION</b></label><br>
        <h5 class="divider black"></h5>
        <style type="text/css">
        #wrap {width:600px;margin:0 auto;}
        #left_col {float:left;width:300px;}
        #right_col {float:right;width:300px;
        //http://stackoverflow.com/questions/6385293/simple-two-column-html-layout-without-using-tables
        </style>
        <div id="wrap">
          <div id="left_col">
            <label >Name of Child: <u>'.$fname." ".$mname." ".$lname.'</u> </label><br>
            <label >Date of Birth: <u>'.$Birthday.'</u> </label><br>
            <label >Age: <u>'.$age.'</u> </label><br>
            <label >Gender: <u>'.$gender.'</u> </label><br>
            <label >Height: <u>'.$height.'</u> </label><br>
            <label >Weight: <u>'.$weight.'</u> </label><br>
            <label >Head Circumference: <u>'.$head_circum.'</u> </label><br>
            <label >Chest Circumference: <u>'.$chest_circum.'</u> </label><br>
          </div>
          <div id="right_col">  
            <label >Abdomen Circumference: <u>'.$abdo_circum.'</u> </label><br>
            <label >Hair Color: <u>'.$hair_color.'</u> </label><br>
            <label >Eyes: <u>'.$eye_color.'</u> </label><br>
            <label >Skin: <u>'.$skin_color.'</u> </label><br>
            <label >Date of Admission: <u>'. $created .'</u> </label><br>
            <label >Case Category: '.$case.'</u> </label><br>
            <label >Present Location: <u>'.$present_loc.'</u></label><br>
          </div>   
        </div>
      </div>
      <h5 class="divider black"></h5>
        <div class="form-group">
          <label ><b>II. PHYSICAL DESCRIPTION AND CONDITION</b></label>
          <h5 class="divider black"></h5>
          <label>Describe present appearance: <u>'.$present_app.'</u></label><br><br>
          <label>Describe appearance of the child at time of admission into care: <u>'.$admission_app.'</u></label><br><br>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label ><b>III. GROWTH RECORDS </b></label>
          <h5 class="divider black"></h5>
          <table style="border-style:solid;border-width:1px">
            <thead>
            <tr style="border-style:solid;border-width:1px">
              <th>Year / Month</th>
              <th>Age in Months</th>
              <th>Weight (kilos)</th>
              <th>Length/Height (cm/feet)</th>
              <th>HC (cm)</th>
              <th>CC (cm)</th>
              <th>Teeth</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            </tbody>
          </table>
          <label>Distinguishing marks or physical handicaps: <u>'.$marks_physical.'</u></label><br><br>
          <label><b>Is there any evidence of disease, impairment or abnormality of:</b></label>
            <table style="border-style:solid;border-width:1px">
              <thead >
                <tr style="border-style:solid;border-width:1px">
                  <th></th>
                  <th>Yes</th>
                  <th>No</th>
                  <th>Observation/s</th>
                </tr>
              </thead>
              <tbody>
              <tr >
                <td>Head</td>
                <td></td>
                <td></td>
                <td>'.$obser_head.'</td>
              </tr>
              <tr>
                <td>Eyes</td>
                <td></td>
                <td></td>
                <td>'.$obser_eyes.'</td>
              </tr>
              <tr>
                <td>Nose</td>
                <td></td>
                <td></td>
                <td>'.$obser_nose.'</td>
              </tr>
              <tr>
                <td>Ears</td>
                <td></td>
                <td></td>
                <td>'.$obser_ears.'</td>
              </tr>
              <tr>
                <td>Mouth and Throat</td>
                <td></td>
                <td></td>
                <td>'.$obser_mouth.'</td>
              </tr>
              <tr>
                <td>Neck</td>
                <td></td>
                <td></td>
                <td>'.$obser_neck.'</td>
              </tr>
              <tr>
                <td>Chest</td>
                <td></td>
                <td></td>
                <td>'.$obser_chest.'</td>
              </tr>
              <tr>
                <td>Abdomen</td>
                <td></td>
                <td></td>
                <td>'.$obser_abdo.'</td>
              </tr>
              <tr>
                <td>Genitalia</td>
                <td></td>
                <td></td>
                <td>'.$obser_gen.'</td>
              </tr>
              <tr>
                <td>Spinal Column</td>
                <td></td>
                <td></td>
                <td>'.$obser_spinal.'</td>
              </tr>
              <tr>
                <td>Extremities</td>
                <td></td>
                <td></td>
                <td>'.$obser_extre.'</td>
              </tr>
              <tr>
                <td>Pulse</td>
                <td></td>
                <td></td>
                <td>'.$obser_pulse.'</td>
              </tr>
              <tr>
                <td>Blood</td>
                <td></td>
                <td></td>
                <td>'.$obser_blood.'</td>
              </tr>
              <tr>
                <td>Nervous System</td>
                <td></td>
                <td></td>
                <td>'.$obser_ner.'</td>
              </tr>
              <tr>
                <td>Respiration</td>
                <td></td>
                <td></td>
                <td>'.$obser_res.'</td>
              </tr>
              <tr>
                <td>Skin</td>
                <td></td>
                <td></td>
                <td>'.$obser_skin.'</td>
              </tr>
              </tbody>
            </table>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>IV. BIRTH HISTORY </b></label>
          <h5 class="divider black"></h5>
          <div id="wrap">
          <div id="left_col">
            <label >Age of Gestation: <u>'.$gestation_age.'</u> </label><br>
            <label >Full term: <u>'.$full_term.'</u> </label><br>
            <label >Pre-mature: <u>'.$pre_mature.'</u> </label><br>
            <label >Normal Delivery: <u>'.$normal_deli.'</u> </label><br>
            <label >Caesarian: <u>'.$caesarian_deli.'</u> </label><br>
            <label >Forceps: <u>'.$forcep.'</u> </label><br>
            <label >Born at:  <u>'.$born_at.'</u> </label><br>
            <label >Delivered by: <u>'.$delivery_by.' </u>with the help of <u>'.$deliver_name.'</u> </label><br>
          </div>
          <div id="right_col">  
            <label >Complications: <u>'.$complication.'</u> </label><br>
            <label >Birth weight: <u>'.$weight_birth.'</u> </label><br>
            <label >Length: <u>'.$length_birth.'</u> </label><br>
            <label >Head circumference: <u>'.$head_cir_birth.'</u></label><br>
            <label >Chest circumference : <u>'. $chest_cir_birth .'</u></label><br>
            <label >Apgar Score: <u>'.$apgar_score.'</u></label><br>
            <label >Abnormalities at birth (please describe): <u>'.$abnormal_birth.'</u></label><br>
          </div>   
        </div> 
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>V. IMMUNIZATIONS</b></label>
          <h5 class="divider black"></h5>
          <table style="border-style:solid;border-width:1px">
          <thead>
            <tr style="border-style:solid;border-width:1px">
              <th>Immunization</th>
              <th>Date</th>
              <th>Physician</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>BCG</td>
              <td>'.$date_bcg.'</td>
              <td>'.$physi_bcg.'</td>
            </tr>
            <tr>
              <td>DPT1</td>
              <td>'.$date_dpt_1.'</td>
              <td>'.$physi_dpt_1.'</td>
            </tr>
            <tr>
              <td>DPT2</td>
              <td>'.$date_dpt_2.'</td>
              <td>'.$physi_dpt_2.'</td>
            </tr>
            <tr>
              <td>DPT3</td>
              <td>'.$date_dpt_3.'</td>
              <td>'.$physi_dpt_3.'</td>
            </tr>
            <tr>
              <td>DPT Booster</td>
              <td>'.$date_dpt_boos.'</td>
              <td>'.$physi_dpt_boos.'</td>
            </tr>
            <tr>
              <td>OPV 1</td>
              <td>'.$date_opv_1.'</td>
              <td>'.$physi_opv_1.'</td>
            </tr>
            <tr>
              <td>OPV 2</td>
              <td>'.$date_opv_2.'</td>
              <td>'.$physi_opv_2.'</td>
            </tr>
            <tr>
              <td>OPV 3</td>
              <td>'.$date_opv_3.'</td>
              <td>'.$physi_opv_3.'</td>
            </tr>
            <tr>
              <td>OPV Booster</td>
              <td>'.$date_opv_boos.'</td>
              <td>'.$physi_opv_boos.'</td>
            </tr>
            <tr>
              <td>Measles</td>
              <td>'.$date_measles.'</td>
              <td>'.$physi_measles.'</td>
            </tr>
            <tr>
              <td>MMR</td>
              <td>'.$date_mmr.'</td>
              <td>'.$physi_mmr.'</td>
            </tr>
            <tr>
              <td>HIB 1</td>
              <td>'.$date_hib_1.'</td>
              <td>'.$physi_hib_1.'</td>
            </tr>
            <tr>
              <td>HIB 2</td>
              <td>'.$date_hib_2.'</td>
              <td>'.$physi_hib_2.'</td>
            </tr>
            <tr>
              <td>HIB 3</td>
              <td>'.$date_hib_3.'</td>
              <td>'.$physi_hib_3.'</td>
            </tr>
            <tr>
              <td>HIB Booster</td>
              <td>'.$date_hib_boos.'</td>
              <td>'.$physi_hib_boos.'</td>
            </tr>
            <tr>
              <td>HEPA B1</td>
              <td>'.$date_hepa_1.'</td>
              <td>'.$physi_hepa_1.'</td>
            </tr>
            <tr>
              <td>HEPA B2</td>
              <td>'.$date_hepa_2.'</td>
              <td>'.$physi_hepa_2.'</td>
            </tr>
            <tr>
              <td>HEPA B3</td>
              <td>'.$date_hepa_3.'</td>
              <td>'.$physi_hepa_3.'</td>
            </tr>
            <tr>
              <td>HEPA B Booster</td>
              <td>'.$date_hepa_boos.'</td>
              <td>'.$physi_hepa_boos.'</td>
            </tr>
            <tr>
              <td>Others</td>
              <td>'.$date_other.'</td>
              <td>'.$physi_other.'</td>
            </tr>
          </tbody>
        </table>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>VI. LABORATORY TEST</b></label>
          <h5 class="divider black"></h5>
          <table style="border-style:solid;border-width:1px">
            <thead>
              <tr style="border-style:solid;border-width:1px">
                <th>Date</th>
                <th>Laboratory Test</th>
                <th>Results</th>
                <th>Action Done</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>'.$client_id.'</td>
                <td>'.$client_id.'</td>
                <td>'.$client_id.'</td>
                <td>'.$client_id.'</td>
              </tr>
            </tbody>
          </table>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>VII. ILLNESSESS</b></label>
          <h5 class="divider black"></h5>
          <table style="border-style:solid;border-width:1px">
            <thead>
              <tr style="border-style:solid;border-width:1px">
                <th>Date</th>
                <th>Age</th>
                <th>Illness/s</th>
                <th>Medication</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>'.$client_id.'</td>
                <td>'.$client_id.'</td>
                <td>'.$client_id.'</td>
                <td>'.$client_id.'</td>
              </tr>
            </tbody>
          </table>
          <label>Describe in detail if active now: <u>'.$ill_active.'</u></label><br>
          <label>If complications are present, please describe:  <u> '.$ill_compli.'</u></label><br>
          <label>Accidents, injuries or surgeries (date, description, effects) : <u>'.$ill_accident.'</u></label><br>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
          <label><b>VIII. MEDICAL PROBLEMS </b></label>
          <h5 class="divider black"></h5>
          <label>Is the child on medication?  <u>'.$med_child.'</u></label><br>
          <label>If yes, what medication, dosage, times per day <u>'.$med_take.'</u></label><br>
          <label>By whom was it prescribed? <u>'.$med_physician.'</u></label><br>
          <label>Why? <u>'.$med_reason.'</u></label><br>
          <label>Is the child known to have seizures? <u>'.$med_seizure.'</u></label><br>
          <label>Any chronic illnesses or contagious diseases known? <u>'.$med_chronic.'</u></label><br>
          <label>Is the child allergic to any particular type of medication?  <u>'.$med_allergic.'</u></label><br>
          <label>If yes, please indicate:  <u>'.$med_allergic_med.'</u></label><br><br>
          <label>Dental Health: <u>'.$dental_health.'</u></label><br>
          <label>Is dental care in progress? <u>'.$dental_progress.'</u></label><br>
        </div>
        <h5 class="divider black"></h5>
        <div class="form-group">
        <label><b>IX. NOTES / RECOMMENDATIONS</b></label>
        <h5 class="divider black"></h5>
          <p><u>'.$notes_reco.'</u></p>
        </div>
        <br>
        <div id="wrap">
          <div id="left_col">
          <label></label><br>
          <label></label><br>
          <label></label><br>
          <label></label><br>
          <label></label><br>
          <label></label><br>
          <label></label><br>
          <label></label><br>
          <label></label><br>
          </div>
          <div id="right_col" style="text-align:center;">
          <label><u>'.$doctor.'</u></label><br>
          <label><b>Doctor’s Signature over Printed Name</b></label><br>
          <label><i>Pediatrician / Family Physician</i></label><br><br>
          <label><u>'.$license_no.'</u></label><br>
          <label>License No </label><br><br>
          <label> <u>'.$ptr_no.'</u></label><br>
          <label>PTR No</label><br><br>
          <label><u>'.$hospital_clinic.'</u></label><br>
          <label>Hospital / Clinic</label>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

';


include(APPPATH.'/third_party/mpdf/mpdf.php');
$mpdf=new mPDF('c'); 
$mpdf->SetDisplayMode('fullpage');
// LOAD a stylesheet
$stylesheet = file_get_contents(APPPATH.'../materialize/css/materialize.css');
$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is 

$mpdf->WriteHTML($html);
$mpdf->Output();
//http://stackoverflow.com/questions/5670785/chrome-has-failed-to-load-pdf-document-error-message-on-inline-pdfs


exit;
?>