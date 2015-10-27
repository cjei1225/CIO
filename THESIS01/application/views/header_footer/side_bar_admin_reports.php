            <div class="col s2">
                <?php 
                echo form_open('auth/Admin_Statistics');
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Population</button>
                <?php echo form_close(); ?>
                
                <?php 
                echo form_open('auth/Admin_Dormitories');
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Dormitories</button>
                <?php echo form_close(); ?>

                <?php 
                echo form_open('auth/Admin_Age_Group');
                ?>
                <button type="submit" value="view" class="list-group-item btn waves-effect btn-md  white-text red lighten-2 z-depth-2" id="userside">Age Group</button>
                <?php echo form_close(); ?>
            </div>