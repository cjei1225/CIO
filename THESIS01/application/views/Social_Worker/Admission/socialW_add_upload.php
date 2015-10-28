<?php
$file_path = array(
    'name'  => 'file_path',
    'id'    => 'file_path',
    'value' => set_value('file_path'),
);
$file_name = array(
    'name'  => 'file_name',
    'id'    => 'file_name',
    'value' => set_value('file_name'),
);
include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_data.php');
?>
        

        <main>
            <div class="container">
                <div class="row">
  <?php
    if($status == 0)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_admission.php');
        }
        elseif($status == 1)
        {
          include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/header_footer/side_bar_custody.php');
        }

        ?>
                    <div class="col s10">
                        <fieldset class="z-depth-2">

                                <center>
                                  <?php if($client_status == 0){echo '<h5 class="bold">Upload Initial Documents</h5>';} elseif($client_status == 1){echo '<h5 class="bold">Upload Documents</h5>';} ?> 
                                  
                                </center>
                                <h5 class="divider black"></h5>
                                <?php include($_SERVER['DOCUMENT_ROOT'].'/CIO/THESIS01/application/views/General/Client_info.php'); ?>
                            <div class="row">
                                <input type="hidden" id="client_id" value="<?=$client_id;?>">
                                <input type="hidden" id="user_id" value="<?=$user_id;?>">
                                
                                <div class="col-lg-12"  id="form"> 
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                          <div id="upload-container">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width:200px"><select id="file_ploc" class="form-control">
                                                                    <?php foreach($locations as $location_info):?>
                                                                        <option><?=$location_info->location_name;?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </td>
                                                            <td style="width:200px"><select id="document_type" class="form-control">
                                                                    <?php foreach($document_type as $document_type):?>
                                                                        <option value="<?=$document_type->document_id;?>"><?=$document_type->document_type;?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </td>
                                                            <td style="padding:5px"><a id="pickfiles" class="btn btn-success" href="#">Add files</a> </td>
                                                            <td style="padding:5px"> <a id="uploadfiles" class="btn btn-primary" href="#">Upload files</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                          </div>
                                        </div>
                                    </div>
                                      </div>
                                    <center><h5 class="bold">UPLOADED FILE</h5></center>
                                        <h5 class="divider black"></h5>
                            </div>
                            <div class="form-group">
                                <div class="table-responsive">
                                    <div class="panel-body">
                                        <div class="list-group" id="filelist">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div ALiGN=right>

                            </div> 
                        </fieldset>
                    </div>
                </div>
            </div>
        </main>





      <script>

    var client_id = "";
    var user_id, file_ploc, document_type;
    var uploader = new plupload.Uploader({
        runtimes : 'html5,flash,silverlight,html4',
        browse_button : 'pickfiles', // you can pass in id...
        container: document.getElementById('upload-container'), // ... or DOM Element itself
        url : '<?php echo base_url();?>index.php/auth/plupload_client',
        flash_swf_url : '<?php echo base_url();?>materialize/js/Moxie.swf',
        silverlight_xap_url : '<?php echo base_url();?>materialize/js/Moxie.xap',
        
        filters : {
            max_file_size : '1000mb',
            mime_types: [
                {title : "Accepted files", extensions : "jpg,gif,png,doc,docx,pdf,rtf,txt"}
            ]
        },
         preinit : {
              Init: function(up, info) {
                  console.log('[Init]', 'Info:', info, 'Features:', up.features);
              },
   
              UploadFile: function(up, file) {
                  console.log('[UploadFile]', file);
                  up.setOption('multipart_params', {client_id : client_id,sw_id:sw_id,user_id:user_id,file_ploc:file_ploc,document_type:document_type});
              }
          },
 
        init: {
            PostInit: function() {
                $('#filelist').html("");
                $('#uploadfiles').click(function(){
                  client_id = $('#client_id').val();
                  sw_id = $('#user_id').val();
                  user_id = $('#user_id').val();
                  file_ploc = $('#file_ploc').val();
                  document_type = $('#document_type').val();
                  uploader.start();
                    return false;
                });
            },

            FilesAdded: function(up, files) {
                plupload.each(files, function(file) {
                  //  document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                  $('#filelist').append(' <a href="#" class="list-group-item" id="' + file.id + '"> <h4 class="list-group-item-heading"><span class="file_name">' + file.name + '</span> (<b class="file_size">' + plupload.formatSize(file.size) + '</b>)</h4> <p class="list-group-item-text"> <div class="progress"> <div class="progress-bar" role="progressbar" style="width: 0%;"> <span class="sr-only"><span class="progress-val"></span>% Complete</span> </div> </div> </p> </a>');
                });
            },

            UploadProgress: function(up, file) {
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                $('#' + file.id).find('.progress-bar').css("width",file.percent + "%");
                $('#' + file.id).find('.progress-val').text(file.percent);
            },
            UploadComplete: function(up, files) {
          // Called when all files are either uploaded or failed
                  alert("Upload Complete!");
        },
            Error: function(up, err) {
                // document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + ;
                $('#filelist').prepend('<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <strong>ERROR '+ err.code +'!</strong> ' + err.message + ' </div>');
            }

        }
    });

    uploader.init();

    </script>