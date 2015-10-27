<?php 
$name1 = array(
  'name'  => 'name1',
  'id'  => 'name1',
  'value' => set_value('name1'),
);

$name2 = array(
  'name'  => 'name2',
  'id'  => 'name2',
  'value' => set_value('name2'),
);

$address1 = array(
  'name'  => 'address1',
  'id'  => 'address1',
  'value' => set_value('address1'),
);

$address2 = array(
  'name'  => 'address2',
  'id'  => 'address2',
  'value' => set_value('address2'),
);

$relationship1 = array(
  'name'  => 'relationship1',
  'id'  => 'relationship1',
  'value' => set_value('relationship1'),
);

$relationship2 = array(
  'name'  => 'relationship2',
  'id'  => 'relationship2',
  'value' => set_value('relationship2'),
);

$var4 = array(
  'name'  => 'var4',
  'id'  => 'var4',
  'value' => set_value('var4'),
);

$var5 = array(
  'name'  => 'var5',
  'id'  => 'var5',
  'value' => set_value('var5'),
);

$var6 = array(
  'name'  => 'var6',
  'id'  => 'var6',
  'value' => set_value('var6'),
);

$var7 = array(
  'name'  => 'var7',
  'id'  => 'var7',
  'value' => set_value('var7'),
);

$var8 = array(
  'name'  => 'var8',
  'id'  => 'var8',
  'value' => set_value('var8'),
);

$var9 = array(
  'name'  => 'var9',
  'id'  => 'var9',
  'value' => set_value('var9'),
);

$var10 = array(
  'name'  => 'var10',
  'id'  => 'var10',
  'value' => set_value('var10'),
);

$affiant1 = array(
  'name'  => 'affiant1',
  'id'  => 'affiant1',
  'value' => set_value('affiant1'),
);

$affiant2 = array(
  'name'  => 'affiant2',
  'id'  => 'affiant2',
  'value' => set_value('affiant2'),
);

$witness1 = array(
  'name'  => 'witness1',
  'id'  => 'witness1',
  'value' => set_value('witness1'),
);

$witness2 = array(
  'name'  => 'witness2',
  'id'  => 'witness2',
  'value' => set_value('witness2'),
);

$day = array(
  'name'  => 'day',
  'id'  => 'day',
  'value' => set_value('day'),
);

$month = array(
  'name'  => 'month',
  'id'  => 'month',
  'value' => set_value('month'),
);

$taxnum = array(
  'name'  => 'taxnum',
  'id'  => 'taxnum',
  'value' => set_value('taxnum'),
);

$taxplace = array(
  'name'  => 'taxplace',
  'id'  => 'taxplace',
  'value' => set_value('taxplace'),
);

$taxdate = array(
  'name'  => 'taxdate',
  'id'  => 'taxdate',
  'value' => set_value('taxdate'),
);

$docNum = array(
  'name'  => 'docNum',
  'id'  => 'docNum',
  'value' => set_value('docNum'),
);

$pageNum = array(
  'name'  => 'pageNum',
  'id'  => 'pageNum',
  'value' => set_value('pageNum'),
);

$bookNum = array(
  'name'  => 'bookNum',
  'id'  => 'bookNum',
  'value' => set_value('bookNum'),
);

include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_data.php');
?>


<main >
   <div class="container">
      <div class="row">
        <?php if($status == 0)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_admission.php');
        }
        elseif($status == 1)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/header_footer/side_bar_custody.php');
        }

        ?>

       
        <div class="col s10">
        	<fieldset class="z-depth-2">
            <?php include($_SERVER['DOCUMENT_ROOT'].'/Thesis_programs/Current/THESIS01/application/views/General/Client_info.php');
 ?>
            <?php echo form_open("auth/input_aff_undertaking"); ?>
          	<center><h5 class="bold">JOINT AFFIDAVIT OF UNDERTAKING</h5></center><?php echo form_hidden('client_id', $client_id); ?>
              <h5 class="divider black"></h5>
             	<div class="form-group">
             		<div class="input-field col s6 ">
                  <?php echo form_label('name1', $name1['id']); ?>
                  <?php echo form_input($name1); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('name2', $name2['id']); ?>
                  <?php echo form_input($name2); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('address1', $address1['id']); ?>
                  <?php echo form_input($address1); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('address2', $address2['id']); ?>
                  <?php echo form_input($address2); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('relationship1', $relationship1['id']); ?>
                  <?php echo form_input($relationship1); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('relationship2', $relationship2['id']); ?>
                  <?php echo form_input($relationship2); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('var4', $var4['id']); ?>
                  <?php echo form_input($var4); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('var5', $var5['id']); ?>
                  <?php echo form_input($var5); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('var6', $var6['id']); ?>
                  <?php echo form_input($var6); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('var7', $var7['id']); ?>
                  <?php echo form_input($var7); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('var8', $var8['id']); ?>
                  <?php echo form_input($var8); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('var9', $var9['id']); ?>
                  <?php echo form_input($var9); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('var10', $var10['id']); ?>
                  <?php echo form_input($var10); ?>
                </div>
                
                <div class="input-field col s6 ">
                  <?php echo form_label('affiant1', $affiant1['id']); ?>
                  <?php echo form_input($affiant1); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('affiant2', $affiant2['id']); ?>
                  <?php echo form_input($affiant2); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('witness1', $witness1['id']); ?>
                  <?php echo form_input($witness1); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('witness2', $witness2['id']); ?>
                  <?php echo form_input($witness2); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('day', $day['id']); ?>
                  <?php echo form_input($day); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('month', $month['id']); ?>
                  <?php echo form_input($month); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('taxnum', $taxnum['id']); ?>
                  <?php echo form_input($taxnum); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('taxplace', $taxplace['id']); ?>
                  <?php echo form_input($taxplace); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('taxdate', $taxdate['id']); ?>
                  <?php echo form_input($taxdate); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('docNum', $docNum['id']); ?>
                  <?php echo form_input($docNum); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('pageNum', $pageNum['id']); ?>
                  <?php echo form_input($pageNum); ?>
                </div>
                <div class="input-field col s6 ">
                  <?php echo form_label('bookNum', $bookNum['id']); ?>
                  <?php echo form_input($bookNum); ?>
                </div>
               
                <div>
                  <button class="btn  waves-effect btn-md  green z-depth-2 right" type="submit" name="action">Submit</button>
                </div>
             	</div>
              <?php echo form_close(); ?>
          </fieldset> 
        </div>   		
      </div>
  </div>
</main>