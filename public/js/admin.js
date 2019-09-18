







 var loadFile = function(event) {
    var output = document.getElementById('profile');
    var img = URL.createObjectURL(event.target.files[0])
    profile.src = img

    

  };








$( document ).ready(function() {


    






//datepicker

$( "#date-from" ).datepicker();
$( "#date-to" ).datepicker();











   $("#uploadfile").on('submit',(function(e) {

        

        //if ( $("#fileToUpload").val() != "" )
            // {


               e.preventDefault();

                $.ajax({
                    url: "/admin/save_voucher",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        $("#btn-save").html('<i class="fa fa-spinner fa-spin"></i>');


                    },
                    success: function(data){
                          setTimeout(function(){ 


                                 $("#btn-save").html('<i class="fa fa-save"></i> Save'); 
                                 alert(data);
                                                                      

                           }, 500);
                        
                        
                    }           
                });


        //}
        //else
           //{

            //alert("Please select an image.");

           //}
    
         
             
    




     }));









$("#savecontoller").on('submit',(function(e) {

        
    
     e.preventDefault();

                $.ajax({
                    url: "/admin/save_controller",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        $("#btn-save-controller").html('<i class="fa fa-spinner fa-spin"></i>');


                    },
                    success: function(data){
                          setTimeout(function(){ 


                                 $("#btn-save-controller").html('Save'); 
                                 alert(data);
                                 location.reload();                                    

                           }, 500);
                        
                        
                    }           
                });




     }));







$('#btn-test-connection').on('click',function(){


             var controller_ip = $('#controller_ip').val();   
             var controller_port = $('#controller_port').val();
             var controller_username = $('#controller_username').val();
             var controller_password = $('#controller_password').val();
             var controller_version = $('#controller_version').val();
             var controller_site = $('#controller_site').val();

              if ( controller_ip.length != 0 && controller_port.length != 0 && controller_username.length != 0 && controller_password.length != 0 )

                 {
                        var data = "controller_username=" + controller_username + "&controller_password=" + controller_password + "&controller_ip=" + controller_ip + "&controller_port=" + controller_port + "&controller_version=" + controller_version+ "&controller_site=" + controller_site;
                         

                             $.ajax({
                                    url: "/admin/check_controller",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-test-connection").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-test-connection").html("<i class='fa fa-cogs'</i> Test Connection"); 
                                                 alert(data);
                                                 console.log(data);                                     

                                           }, 500);
                                        
                                        
                                    }           
                                });




                 }
              else
              {

                 alert("All field are required");
              }







      });












$('#btn-test-print').on('click',function(){


             var notes = $('#notes').val();   
             var steps = $('#steps').val();
             var hourcoin = $('#hourcoin').val();


              if ( notes.length != 0 && steps.length != 0 && hourcoin.length != 0 )

                 {
                        var data = "notes=" + notes + "&steps=" + steps + "&hourcoin=" + hourcoin;
                         

                             $.ajax({
                                    url: "/admin/test_print",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-test-print").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-test-print").html('<i class="fa fa-print"></i> Print Test'); 
                                                 
                                                 //console.log(data);  

                                                 alert(data);                                   

                                           }, 500);
                                        
                                        
                                    }           
                                });




                 }
              else
              {

                 alert("All field are required");
              }







      });














$('#btn-print-free-voucher').on('click',function(){


             var v_number = $('#voucher_num').val();   
             var data = "voucher_num=" + v_number;
            
             if ( v_number.length != 0 )
                 {
                 

                  $.ajax({
                                    url: "/admin/print_free",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-print-free-voucher").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 

  
                                                 $("#btn-print-free-voucher").html('Print'); 
                                                 
                                                 console.log(data);                                     

                                           }, 500);
                                        
                                        
                                    }           
                                });
   


                 }



      });














       //toggle buttons graph
                          
        $("#graph_buttons > button.btn").on("click", function(){                                               
                                              
               $('#graph_buttons > .btn').removeClass('active');
               $(this).addClass('active');
                                                  
         });














              $('#btn-print-report-earn').on('click',function(){

                         var date_from = $("#date-from").val();
                         var date_to = $("#date-to").val();
                         var voucher_type = $("#voucher_type").val();

                         var data = "report=earning&date_from=" + date_from + "&date_to=" + date_to + "&voucher_type=" + voucher_type;

                             $.ajax({
                                    url: "/admin/print_report",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-print-report-earn").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-print-report-earn").html("Print"); 
                                                 
                                                 console.log(data);                                 

                                           }, 500);
                                        
                                        
                                    }           
                                });
                         




                          });














              $('#btn-print-report-config').on('click',function(){

                         var data = "report=config";
                         

                             $.ajax({
                                    url: "/admin/print_report",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-print-report-config").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-print-report-config").html("<i class='fa fa-5x fa-book'></i> Config Report"); 
                                                 
                                                 console.log(data);                                 

                                           }, 500);
                                        
                                        
                                    }           
                                });










           });












$('#accounts').on('click', '.btn-details',function(){
                     
                        var user_id = $(this).data('id');
                        var data = "user_id=" + user_id;
                   
                       $.ajax({
                                    url: "/admin/user_details",
                                    type: "POST",
                                    data:  data,
                                    success: function(data){
                                       
                                     jQuery.each( JSON.parse(data), function( i, val ){
                                       
                                        $('#name').val(val.name) ;
                                        $('#user_id').html(val.user_id) ;
                                        $('#username').val(val.user_name) ;
                                        //$('#password').val(val.user_pass) ;
                                           
                                     });

                                      $('#editmodal').modal('toggle'); 
                                        
                                    }           
                                });


                        

                       


           });

















              $('#btn-save-user').on('click',function(){
                        
                         var user_id = $("#user_id").html();
                         var user_name = $("#username").val();
                         var user_pass = $("#password").val();
                         var user_status = $("#user_status").val();
                         var name = $("#name").val();

                          if ( user_id.length != 0 && user_name.length != 0 && name.length != 0 && user_pass.length != 0 && user_status.length != 0 )
                               {
                                  var data = "user_id=" + user_id + "&user_name=" + user_name + "&name=" + name + "&user_pass=" + user_pass + "&user_status=" + user_status;




                                    $.ajax({
                                         url: "/admin/save_user",
                                         type: "POST",
                                         data:  data,
                                         beforeSend: function() {

                                                 $("#btn-save-user").html('<i class="fa fa-spinner fa-spin"></i>');


                                         },

                                         success: function(data){
                                       
                                            
                                            alert(data);

                                          setTimeout(function(){ 


                                               location.reload();


                                           }, 500);

                                      
                                        
                                           }           
                                       });







                               }
                          else
                               {
 
                                   alert("All Fields are strongly required");
                               }
                         
                          

                             









           });






















});


























   