 var loadFile = function(event) {
    var output = document.getElementById('profile');
    var img = URL.createObjectURL(event.target.files[0])
    profile.src = img

    

  };








$( document ).ready(function() {


    
   $("#uploadfile").on('submit',(function(e) {

        


               e.preventDefault();

                $.ajax({
                    url: "/technician/upload",
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


                                 $("#btn-save").html('Save'); 
                                 alert(data);
                                 console.log(data);                                     

                           }, 500);
                        
                        
                    }           
                });


        

             
    



     }));









$("#savecontoller").on('submit',(function(e) {

        
    
     e.preventDefault();

                $.ajax({
                    url: "/technician/save_controller",
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
                                 console.log(data);                                     

                           }, 500);
                        
                        
                    }           
                });




     }));










   

   $('#btn-test-connection').on('click',function(){


             var controller_ip = $('#controller_ip').val();   
             var controller_port = $('#controller_port').val();
             var controller_username = $('#controller_username').val();
             var controller_password = $('#controller_password').val();

              if ( controller_ip.length != 0 && controller_port.length != 0 && controller_username.length != 0 && controller_password.length != 0 )

                 {
                        var data = "username=" + controller_username + "&password=" + controller_password + "&ipaddress=https://" + controller_ip + ":" + controller_port;
                         

                             $.ajax({
                                    url: "/technician/check_controller",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-test-connection").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-test-connection").html('Test Connection'); 
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
                                    url: "/technician/test_print",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-test-print").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-test-print").html('Print Test'); 
                                                 
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

























$('#btn-print-collect').on('click',function(){

        var r =confirm("Proceed to collect earning?");

                  if (r == true) {

                          data = "action=collect_earning";

                           $.ajax({
                                    url: "/technician/tech_report",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-print-collect").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-print-collect").html("<i class='fa fa-5x fa-book'></i> Collect Earning"); 
                                                 
                                                 console.log(data);                                     

                                           }, 500);
                                        
                                        
                                    }           
                                });                


                  }
                  else
                  {




                  }

     


      });
















$('#btn-print-replace').on('click',function(){

        var r =confirm("Proceed to replace printer paper?");

                  if (r == true) {

                          data = "action=paper_replace";

                           $.ajax({
                                    url: "/technician/tech_report",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-print-replace").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-print-replace").html("<i class='fa fa-5x fa-file'></i> Replace Printer Paper"); 
                                                 
                                                 console.log(data);                                     

                                           }, 500);
                                        
                                        
                                    }           
                                });                


                  }
                  else
                  {




                  }

     


      });


















$('#btn-print-config').on('click',function(){


                          data = "action=config_report";

                           $.ajax({
                                    url: "/technician/tech_report",
                                    type: "POST",
                                    data:  data,
                                    beforeSend: function() {

                                        $("#btn-print-config").html('<i class="fa fa-spinner fa-spin"></i>');


                                    },
                                    success: function(data){
                                          setTimeout(function(){ 


                                                 $("#btn-print-config").html("<i class='fa fa-5x fa-book'></i> Config Report"); 
                                                 
                                                 console.log(data);                                     

                                           }, 500);
                                        
                                        
                                    }           
                                });                



     


      });





























  });