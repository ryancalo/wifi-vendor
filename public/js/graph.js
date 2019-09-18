   //start to loop
    $(window).on('load', function get_display(){







  //getting graph data using ajax
  function get_graph_data(duration)


       {



  //graph layout setting

       var layout = {
                       title: 'Coin Earned',
                       height: 300,
                       plot_bgcolor: '#fff',
                       paper_bgcolor: '#fff',
                       margin: { t: 30, l: 30, r: 25, b: 80 },
                       yaxis: {
                             title: '',
                             titlefont: {
                             family: 'Arial, sans-serif',
                             size: 18,
                             color: 'grey'
                             }
                           },
                       xaxis: {
                             title: '',
                             titlefont: {
                                   family: 'Arial, sans-serif',
                                   size: 18,
                                   color: 'grey'
                                        }                                                                                                                        
                              },
                       legend: {"orientation": "v"}

                                                                                                                  
                                                                


                    };






                    var data = "duration=" + duration;

                                  $.ajax({
                                    url: "/admin/get_graph_data",
                                    type: "POST",
                                    data:  data,
                                    success: function(data){
                                      console.log(data);
                                     x = [];
                                     y = [];
       
                                     x1 = [];
                                     y1 = [];
                                      
                                     lines = [];
                                     lines1 = [];
                                     
                                     
                                       jQuery.each( JSON.parse(data), function( i, val ){
                                     
                                         y.push(val[0]);
                                         x.push(val[1]);

                                         y1.push(val[2]);
                                         x1.push(val[1]);
                                         

                                       });

                                        lines.x = x;
                                        lines.y = y;
                                        lines.type = 'bar';
                                        lines.name = 'Paid';

                                        lines1.x = x1;
                                        lines1.y = y1;
                                        lines1.type = 'bar';
                                        lines1.name = 'Free';
                                                                                    

                                          






                                       var data_graph = [lines, lines1];




                                        Plotly.newPlot('canvas', data_graph , layout, {displayModeBar: false});

                                        //console.log(lines1 );



                                         setTimeout(function(){ 


                                                get_display();

                                           }, 1000);
                                        
                                        
                                    }           
                                });
       
         


       }



   

   function get_icon_data ()


              {


                                   $.ajax({
                                    url: "/admin/get_icon_data",
                                    type: "POST",
                                    
                                    success: function(data){

                                      //console.log(data);
                                      var count = 0;

                                      jQuery.each( JSON.parse(data), function( i, val ){

                                          $("#income" + count).html(val);
                                          count++;
                                          

                                      });


                                    }
                                  });


              }












     var graph_duration = $('#graph_buttons > .btn.active').val();
     
      get_graph_data(graph_duration);
      get_icon_data();
      
 

      //get_display();




   });