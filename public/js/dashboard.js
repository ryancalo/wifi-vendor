


/* Pie Chart */

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [],
                backgroundColor: [],
                label: 'Dataset 1'
            }],
            labels: []
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
    legend: {
    position: 'right',
    }

        }
    };






        var ctx = document.getElementById("pie").getContext("2d");
        window.myPie = new Chart(ctx, config);
 



/* Pie Chart */


























 $(document).ready(function() {







        $('#device').multiselect();



   
       //toggle buttons graph
                          
        $("#graph_buttons > button.btn").on("click", function(){                                               
                                              
               $('#graph_buttons > .btn').removeClass('active');
               $(this).addClass('active');
                                                  
         });




       //toggle buttons display
                          
        $("#display_icons > button.btn").on("click", function(){                                               
                                              
               $('#display_icons > .btn').removeClass('active');
               $(this).addClass('active');
                                                  
         });




       //toggle buttons dispaly in
                          
        $("#in_what > button.btn").on("click", function(){                                               
                                              
               $('#in_what > .btn').removeClass('active');
               $(this).addClass('active');
                                                  
         });





       //toggle graph type
                          
        $("#graph_type > button.btn").on("click", function(){                                               
                                              
               $('#graph_type > .btn').removeClass('active');
               $(this).addClass('active');
                                                  
         });









    });// end of document ready


















$(window).on('load', function(){










                         /* draw guage */

                          $("#guage").knob({
                             'change' : function (v) {  }
                           });

                                                                        
                        /* draw guage */


                                                                                
                       /* guage */

                          function knobfunction(value1){

                              $('#guage')
                                .val(value1)
                                .trigger('change');
                               }

                       /* guage */



                       function colorKnob(value)
                              {


                              if ( value > 50 && value < 85)
                                    {
                                      $('.knob').trigger('configure', { "fgColor": "#ff9900","skin":"tron"});
                                        $('.knob').css({ 'color': '#ff9900', 'font-size' : '20px' });
                                        $('.knob').val(value + "%");

                                         }
                               else if ( value >= 85 )

                                         {

                                          $('.knob').trigger('configure', { "fgColor": "#cc3333","skin":"tron" });
                                          $('.knob').css({ 'color': '#cc3333', 'font-size' : '20px' });
                                          $('.knob').val(value + "%");

                                          }

                              else if ( value > 30 && value <=50 )

                                          {

                                           $('.knob').trigger('configure', { "fgColor": "#009966","skin":"tron" });
                                           $('.knob').css({ 'color': '#009966', 'font-size' : '20px' });
                                           $('.knob').val(value + "%");


                                          }
         
                              else
                                          {

                                           $('.knob').trigger('configure', { "fgColor": "#3399cc","skin":"tron" });
                                           $('.knob').css({ 'color': '#3399cc', 'font-size' : '20px' });
                                           $('.knob').val(value + "%");

                                           }
                          }



                                
                              //remove duplicates in devices
                              function removeDuplicates(arr){
                                    let unique_array = []
                                    for(let i = 0;i < arr.length; i++){
                                        if(unique_array.indexOf(arr[i]) == -1){
                                            unique_array.push(arr[i])
                                        }
                                    }
                                    return unique_array
                                }


                              //getpiecolor

                              function getPiecolor(name){
      
                                      
                                         if (name == "Power")
                                           {
                                           
                                              return "#cc3333";

                                           }
                                         else if(name == "Acu"){

                                            return "#3399cc";
                                           
                                         }
                                         else if(name == "Outlet"){

                                            return "#009966";

                                           
                                         }

                                         else if(name == "Light"){

                                          return "#ff9900"
                                           
                                         }

                                         else{
                                           
                                         }
                                            

                                }



                    









            

          /* display functions*/


          function display_realtime(display_selected)

             {
                 //merge all devices
                 var devices = [];
                 var total_aircon = 0;
                 var total_outlet = 0;
                 var total_light = 0;
                 var max = $("#guage").attr("data-valmax");

                 $("#device option").each(function(){


                          devices.push($(this).data('type'));
          

                                                                                    
                  });




                 var clean_devices = removeDuplicates(devices);
                 var pie_colors = [];
                 var pie_values = {};

                 //dump value to pie values from clean_devices
                  for (i = 0; i < clean_devices.length; i++) {
                             key = clean_devices[i];
                             pie_values[key] = 0 ;
                             newcolor = getPiecolor(clean_devices[i]);
                             pie_colors.push(newcolor);

                  }

                  
                 

                 








                
                          $.ajax({

                              method: "post",
                              url: "/electricph/dashboard/get_data/",
                              data: display_selected,                                                                       
                              success: function(data){
                                  var adc = 0;
                                  var main_total = 0;


                                  jQuery.each( JSON.parse(data), function( i, val ){ 




                                       $("#main-value"+adc).html( (parseFloat(val)).toFixed(2).toLocaleString() + "W");
                                       $("#sub-value"+adc).html( (val/230).toFixed(2) + "A - &#8369;" + (val/1000*12).toFixed(2)  );

                                       main_total = main_total + parseFloat(val);

                                        pie_values[devices[adc]] = (parseFloat(pie_values[devices[adc]]) + parseFloat(val)).toFixed(2);
                                       

                                       
                                       adc = adc + 1;

                                    });//end of looping into data


                                     $("#main-power").html( (parseFloat(main_total)).toFixed(2).toLocaleString() + "W");
                                     $("#main-power-sub").html( (parseFloat(main_total)/230).toFixed(2) + "A"  );
                                     $("#main-cost").html("&#8369;" + (parseFloat(main_total)/1000*12).toFixed(2));
                                     $("#main-cost-sub").html("PER HOUR");


                                     
                                     

                                     myPie.data.datasets[0].data = Object.values(pie_values);
                                     myPie.data.datasets[0].backgroundColor = pie_colors;
                                     myPie.data.labels = Object.keys(pie_values);

                                     myPie.update();

                                     knob_value = ((main_total)/parseInt(max)*100);
                                     knobfunction(knob_value);
                                     colorKnob( (knob_value).toFixed(2) );
                                 


                                }//end of success


                          });//end of ajax request  


                  



            }//end of display realtime

           
             








          function display_today(display_selected)

             {
 

                var down = " <i style = 'font-size : 50%; font-weight: normal' class='fa float-right fa-arrow-down'>  ";
                var up = " <i style = 'font-size : 50%; font-weight: normal' class='fa float-right fa-arrow-up'>";
                var equal = " <i style = 'font-size : 50%; font-weight: normal' class='fa float-right fa-arrow-left'>";
                var display = $('#in_what > .btn.active').val();
                var total_aircon = 0;
                var total_outlet = 0;
                var total_light = 0;
                var devices = [];


                  //push device type inside dropdown

                 $("#device option").each(function(){


                          devices.push($(this).data('type'));


                                                                                    
                  });


                 /* Check Marker (arrow)*/
                function checkMarker(num1, num2){

                      if ( parseFloat(num1) > parseFloat(num2) )
                         {

                            return up;
                          }
                      else if (parseFloat(num1) == parseFloat(num2))
                          {

                             return equal;
                          }
                      else 
                          {

                             return down;
                          }


                         }// end of check marker function






                        /* cheack percentage */

                          function checkPercent(num1, num2){

                            ans = (100 - (num1/num2)*100).toFixed(2);
                              return Math.abs(ans);

                           }// end of check percent function            






                      /* pie function */



                 var clean_devices = removeDuplicates(devices);
                 var pie_colors = [];
                 var pie_values = {};

                 //dump value to pie values from clean_devices
                  for (i = 0; i < clean_devices.length; i++) {
                             key = clean_devices[i];
                             pie_values[key] = 0 ;
                             newcolor = getPiecolor(clean_devices[i]);
                             pie_colors.push(newcolor);

                  }

                 






                            $.ajax({

                              method: "post",
                              url: "/electricph/dashboard/get_data/",
                              data: display_selected,                                                                       
                              success: function(data){
                              var adc = 0;
                              var main_total = 0;
                              var main_totaly = 0;

                                 
                                  jQuery.each( JSON.parse(data), function( i, val ){ 

                                     var val1 = (String(val)).split(",");
                                   
                                     marker = checkMarker(val1[0], val1[1]);


                                      main_total = main_total + parseFloat(val1[0]/3600);
                                      main_totaly = main_totaly + parseFloat(val1[1]/3600);
                                          
                                      if ( display == "peso" )
                                        {

                                         percent = checkPercent(parseFloat(val1[0]/3600*12), parseFloat(val1[1]/3600*12));

                                         

                                         $("#main-value"+adc).html( "&#8369;" + (val1[0]/3600*12).toFixed(2) + " " + marker + " " + percent + "%");
                                         $("#sub-value"+adc).html( "&#8369;" + (val1[1]/3600*12).toFixed(2) + " - Yday");

                                         pie_values[devices[adc]] = (parseFloat(pie_values[devices[adc]]) + parseFloat(val1[0]/3600*12)).toFixed(2);
                                         



                                        }//end of display peso

                                      else

                                       {

                                          percent = checkPercent(parseFloat(val1[0]/3600), parseFloat(val1[1]/3600));

                                          $("#main-value"+adc).html( (val1[0]/3600).toFixed(2) + "Kwh" + "" + marker+ " " + percent + "%");
                                          $("#sub-value"+adc).html( (val1[1]/3600).toFixed(2) + "Kwh - Yday");

                                          pie_values[devices[adc]] = (parseFloat(pie_values[devices[adc]]) + parseFloat(val1[0]/3600)).toFixed(2);
                                          


                                       }

                                     marker = checkMarker(main_total, main_totaly);
                                     percent = checkPercent(parseFloat(main_total), parseFloat(main_totaly));

                                     $("#main-power").html( (parseFloat(main_total)).toFixed(2).toLocaleString() + "Kwh"+ "" + marker+ " " + percent + "%");
                                     $("#main-power-sub").html( (parseFloat(main_totaly)).toFixed(2) + "Kwh - Yday"  );
                                     $("#main-cost").html("&#8369;" + (parseFloat(main_total)*12).toFixed(2));
                                     $("#main-cost-sub").html("&#8369;" + (parseFloat(main_totaly)*12).toFixed(2) + "-Yday");



                                     adc = adc + 1;

                                  });//end of looping into data


                                 

                                     knob_value = ((parseFloat(main_total)/parseFloat(main_totaly))*100);
                                     knobfunction(knob_value);
                                     colorKnob( (knob_value).toFixed(2) );

                                      


                                     myPie.data.datasets[0].data = Object.values(pie_values);
                                     myPie.data.datasets[0].backgroundColor = pie_colors;
                                     myPie.data.labels = Object.keys(pie_values);
                                     myPie.update();
                                     
                                     











                                }//end of success


                          });//end of ajax request  



             }//end of display_today

















function display_month(display_selected)

             {
 

                var down = " <i style = 'font-size : 50%; font-weight: normal' class='fa float-right fa-arrow-down'>  ";
                var up = " <i style = 'font-size : 50%; font-weight: normal' class='fa float-right fa-arrow-up'>";
                var equal = " <i style = 'font-size : 50%; font-weight: normal' class='fa float-right fa-arrow-left'>";
                var display = $('#in_what > .btn.active').val();
                var total_aircon = 0;
                var total_outlet = 0;
                var total_light = 0;
                var devices = [];


                  //push device type inside dropdown

                 $("#device option").each(function(){


                          devices.push($(this).data('type'));


                                                                                    
                  });


                 /* Check Marker (arrow)*/
                function checkMarker(num1, num2){

                      if ( parseFloat(num1) > parseFloat(num2) )
                         {

                            return up;
                          }
                      else if (parseFloat(num1) == parseFloat(num2))
                          {

                             return equal;
                          }
                      else 
                          {

                             return down;
                          }


                         }// end of check marker function






                        /* cheack percentage */

                          function checkPercent(num1, num2){

                            ans = (100 - (num1/num2)*100).toFixed(2);
                              return Math.abs(ans);

                           }// end of check percent function            





                      /* pie function */



                 var clean_devices = removeDuplicates(devices);
                 var pie_colors = [];
                 var pie_values = {};

                 //dump value to pie values from clean_devices
                  for (i = 0; i < clean_devices.length; i++) {
                             key = clean_devices[i];
                             pie_values[key] = 0 ;
                             newcolor = getPiecolor(clean_devices[i]);
                             pie_colors.push(newcolor);

                  }

                    /* end of pie function */








                            $.ajax({

                              method: "post",
                              url: "/electricph/dashboard/get_data/",
                              data: display_selected,                                                                       
                              success: function(data){
                              var adc = 0;
                              var main_total = 0;
                              var main_totaly = 0;

                                 
                                  jQuery.each( JSON.parse(data), function( i, val ){ 

                                     var val1 = (String(val)).split(",");
                                   
                                     marker = checkMarker(val1[0], val1[1]);


                                      main_total = main_total + parseFloat(val1[0]/3600);
                                      main_totaly = main_totaly + parseFloat(val1[1]/3600);
                                          
                                      if ( display == "peso" )
                                        {

                                         percent = checkPercent(val1[0]/3600*12, val1[1]/3600*12);
                                         

                                         $("#main-value"+adc).html( "&#8369;" + (val1[0]/3600*12).toFixed(2) + " " + marker + " " + percent + "%");
                                         $("#sub-value"+adc).html( "&#8369;" + (val1[1]/3600*12).toFixed(2) + " - Lmonth");

                                         pie_values[devices[adc]] = (parseFloat(pie_values[devices[adc]]) + parseFloat(val1[0]/3600*12)).toFixed(2);




                                        }//end of display peso

                                      else

                                       {

                                          percent = checkPercent(parseFloat(val1[0]/3600*12), parseFloat(val1[1]/3600));

                                          $("#main-value"+adc).html( (val1[0]/3600).toFixed(2) + "Kwh" + "" + marker+ " " + percent + "%");
                                          $("#sub-value"+adc).html( (val1[1]/3600).toFixed(2) + "Kwh - Lmonth");

                                          pie_values[devices[adc]] = (parseFloat(pie_values[devices[adc]]) + parseFloat(val1[0]/3600)).toFixed(2);
                                          


                                       }

                                     marker = checkMarker(main_total, main_totaly);
                                     percent = checkPercent(parseFloat(main_total), parseFloat(main_totaly));

                                     $("#main-power").html( (parseFloat(main_total)).toFixed(2).toLocaleString() + "Kwh" + "" + marker+ " " + percent + "%");
                                     $("#main-power-sub").html( (parseFloat(main_totaly)).toFixed(2) + "Kwh - Lmonth"  );
                                     $("#main-cost").html("&#8369;" + (parseFloat(main_total)*12).toFixed(2));
                                     $("#main-cost-sub").html("&#8369;" + (parseFloat(main_totaly)*12).toFixed(2) + "- Lmonth");



                                   
                                     adc = adc + 1;

                                  });//end of looping into data





                                     knob_value = ((parseFloat(main_total)/parseFloat(main_totaly))*100);
                                     knobfunction(knob_value);
                                     colorKnob( (knob_value).toFixed(2) );




                                     myPie.data.datasets[0].data = Object.values(pie_values);
                                     myPie.data.datasets[0].backgroundColor = pie_colors;
                                     myPie.data.labels = Object.keys(pie_values);
                                     myPie.update();

                                     myPie.update();
                                     








                                }//end of success


                          });//end of ajax request  



             }//end of display_month

































      /* end of display functions*/






      /*graph function */

           

             function graph_realtime(graph_data)

               {



                         var layout = {
                                 title: 'Power Consumption',
                                 height: 300,
                                 plot_bgcolor: '#cccccc',
                                 paper_bgcolor: '#cccccc',
                                 margin: { t: 25, l: 50, r: 0, b: 35 },
                                 yaxis: {
                                       title: 'Kwh',
                                       titlefont: {
                                       family: 'Arial, sans-serif',
                                       size: 18,
                                       color: 'grey'
                                       }
                                     },
                                 xaxis: {
                                       title: 'Time',
                                       titlefont: {
                                             family: 'Arial, sans-serif',
                                             size: 18,
                                             color: 'grey'
                                                  }                                                                                                                        
                                        }

                                                                                                                            
                                                                          


                              };




                                            $.ajax({

                                                      method: "post",
                                                      url: "/electricph/dashboard/get_graph/",
                                                      data: graph_data,                                                                       
                                                      success: function(data){

                                                      var lines = [];


                                                                                                                                                    
                                                                                                             
                                                          jQuery.each( JSON.parse(data), function( i, val ){

                                                                                                                
                                                                lines.push(val);



                                                          });    

                      


                                                                                                      
                                                                                                            
                                                          Plotly.newPlot('canvas', lines, layout, {displayModeBar: false});

                                                          return setTimeout(function(){ get_display(); }, 1000);

                                                          
                                                                                                      



                                                         }


                                                  });

                         









               }

 









      /*end of graph function*/

























         

       function get_display()//this function will be the one to call function that correspond to display duration //display_realtime, display_today, dispaly_month
          
           {
                   
                 var display_a = false;
                 var display_b = false; 
                 var display_duration = $('#display_icons > .btn.active').val();
                 var display = $('#in_what > .btn.active').val();
                 var display_selected = "display_type=" + display + "&duration=" + display_duration;
                 var devices_selected = $("#device").val();
                 var graph_type =  $('#graph_type > .btn.active').val();
                 var graph_data = "graph_duration=" + display_duration + "&devices=" + devices_selected + "&graph_type=" + graph_type + "&display=" + display;

              if (display_duration == "display_realtime")

                   {
 
                        display_realtime(display_selected);
                        graph_realtime(graph_data);


                        
                          

                   }

            else if (display_duration == "display_today")

                   {

                        graph_realtime(graph_data);
                        display_today(display_selected);
                        

                   }

            else if (display_duration == "display_month")

                   {

                        graph_realtime(graph_data);
                        display_month(display_selected);
                        
                        

                   }



              

           }  


      //call function to start
     get_display();








});
