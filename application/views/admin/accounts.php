 
   <h3> ACCOUNT SETTINGS</h3>
  <hr>

<div class = "container-fluid table-responsive">

 <table id = 'accounts' class="table table-sm table-hover">
    <thead>
      <tr>
        <th> <i class='fa fa-user'></i> Name</th>
        <th> <i class='fa fa-user'></i> Username</th>
        <th> <i class='fa fa-flag'></i> Status</th>
        <th> <i class='fa fa-user'></i> Account Type</th>
        <th> <i class='fa fa-gavel'></i> Action</th>
      </tr>
    </thead>
    <tbody>

       <?php


         if ($users)
          {

              foreach( $users as $key => $value)
                {
        
                 echo "<tr><td>" . $value->name . "</td><td>" . $value->user_name . "</td><td>" . $value->user_status . "</td><td>" . $value->user_type . "</td><td><button type='button'  data-id = '" .$value->user_id. "' class='btn btn-sm btn-details btn-secondary'> <i class='fa fa-edit'></i> Edit</button></td></tr>";

                }

          }

        ?>
    </tbody>
  </table>




</div>






<!-- The Modal -->
<div class="modal fade" id="editmodal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit User</h4> <i id = 'user_id' hidden></i>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
          <div class="form-group">
               <label for="usr">Name:</label>
               <input type="text" class="form-control" id="name">
          </div>


          <div class="form-group">
               <label for="usr">User name:</label>
               <input type="text" class="form-control" id="username">
          </div>

          <div class="form-group">
               <label for="usr">Password:</label>
               <input type="password" class="form-control" id="password">
          </div>

          <div class="form-group">
               <label for="usr">User Status:</label>
                 <select class="form-control" id="user_status">
                      <option>Active</option>
                      <option>Inactive</option>
                 </select>

          </div>




      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" id = "btn-save-user" class="btn btn-success"><i class='fa fa-save'></i> Save</button>
        
      </div>

    </div>
  </div>
</div>