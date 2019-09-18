

     var total_aircon = 0;
     var total_lights = 0;
     var total_outlet = 0;
     var yesterday_kwh = 0;
     var yesterday_peso = 0;
     var today_kwh = 0;
     var today_peso = 0;
     var main_power = 0;




/* Pie Chart */

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    '0',
                    '0',
                    '0'
                ],
                backgroundColor: [
                    "#009966",
                    "#3399cc",
                    "#ff9900"
                    ],
                label: 'Dataset 1'
            }],
            labels: [
                "Outlet",
                "Aircon",
                "Lights"
                  ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
	  legend: {
		position: 'right',
	  }

        }
    };






        var ctx = document.getElementById("piechart").getContext("2d");
        window.myPie = new Chart(ctx, config);
 



/* Pie Chart */










/* Bar Chart */

		





var color = Chart.helpers.color;
		var HorBarChartData = {
			labels: ['12AM', '01AM', '02AM', '03AM', '04AM', '05AM', '06AM', '07AM', '08AM', '09AM', '10AM', '11AM', '12PM', '01PM','02PM', '03PM', '04PM', '05PM', '06PM', '07PM', '08PM', '09PM', '10PM', '11PM' ],
			datasets: [{
				label: 'Yesterday',
				backgroundColor: "#3399cc",
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0
                                                  

     				       ]

			             },
{
				label: 'Today',
				backgroundColor: "#ff9900",
				borderColor: window.chartColors.yellow,
				borderWidth: 1,
				data: [
                                                  0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0,
                                                  0,
					0,
					0
     				       ]

			             },

                                      



                                         ],


		};





/* Bar Chart */




















		window.onload = function() {
			




			var ctx1 = document.getElementById('canvas1').getContext('2d');
			window.myBar = new Chart(ctx1, {
				type: 'bar',
				data: HorBarChartData ,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					maintainAspectRatio: false,
                                              scales: {
                                                xAxes: [{
                                                   ticks: {
                                                      beginAtZero: true
                                                          }
                                                        }],

                                                yAxes: [{
                                                   display: true,
                                                   scaleLabel: {
                                                                 display: true,
                                                                 labelString: 'Kwh',                     
                                                               }
                                                       }]




                                                     }

					
				}
			});











		};




















   
					$(window).on('load', function get_data(){
                                                                         
                                                                      var data = "device_mac=984FEE01B75F";
                                                                      var data1 = "device_mac=984FEE01B445";

																	  var down = " <i style = 'font-size : 40%; font-weight: normal' class='fa float-right fa-arrow-down'></i>";
																	  var up = " <i style = 'font-size : 40%; font-weight: normal' class='fa float-right fa-arrow-up'></i>";
																	  var equal = " <i style = 'font-size : 40%; font-weight: normal' class='fa float-right fa-arrow-left'></i>";
																	  var max = $("#guage").attr("data-valmax");
																	       






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







									                              /* Check Marker (arrow)*/
									                                 function checkMarker(num1, num2){

									                                 	  if ( parseInt(num1) > parseInt(num2) )
									                                 	  	 {

									                                 	  	 	return up;
									                                 	  	 }
									                                 	  else if (parseInt(num1) == parseInt(num2))
									                                 	  	 {

									                                 	  	 	return equal;
									                                 	  	 }
									                                 	  else 
									                                 	  	 {

									                                 	  	 	return down;
									                                 	  	 }



									                                 }





										                                 /* Get Adc VAlue in Watts*/

										                                   function getWatts (adcvalue, devider) {

										                                        
										                                         return ((((parseInt(adcvalue)/devider) * 230)/1000)/3600)

										                                   }





										                                 /* Get Adc VAlue in Peso*/

										                                   function getPeso (adcvalue, devider) {

										                                      
										                                         return ((((parseInt(adcvalue)/devider) * 230)/1000)/3600) *12

										                                   }










					                                                                                  $.ajax({

												                                                                method: "post",
												                                                                url: "/today/get_today_compare/",
                                                                                                                data: data,					                                      
												                                                                success: function(data){


					                                       

					                                                                          jQuery.each( JSON.parse(data), function( i, val ){

													            												  adc0 = (val.adc0).split("-");
													            												  adc1 = (val.adc1).split("-");
													            												  adc2 = (val.adc2).split("-");
													            												  adc3 = (val.adc3).split("-");
													            												  adc4 = (val.adc4).split("-");
													            												  adc5 = (val.adc5).split("-");




																			 									  marker = checkMarker(adc0[0], adc0[1]);
																			 									  marker1 = checkMarker(adc1[0], adc1[1]);
																			 									  marker2 = checkMarker(adc2[0], adc2[1]);
																			 									  marker3 = checkMarker(adc3[0], adc3[1]);																			 										                   
																			 									  marker4 = checkMarker(adc4[0], adc4[1]);
																			 									  marker5 = checkMarker(adc5[0], adc5[1]);



                                                                                                                             total_aircon = ( (getWatts(adc1[0], 120.8)) + (getWatts(adc2[0], 120.8)) + (getWatts(adc3[0], 120.8)) + (getWatts(adc4[0], 120.8)) + (getWatts(adc5[0], 120.8)) ).toFixed(2);            
													                                                                         main_power = Number(Math.round( (getWatts(adc0[0], 23.65)) /(getWatts(max, 23.65)) *100 ) );
															
                                                                                       						                 $("#main-power").html( ( getWatts(adc0[0], 23.65) ).toFixed(2) .toLocaleString() + "Kwh" + marker);
														                                                                     $("#main-current").html(  ( getWatts(adc0[1], 23.65) ) .toFixed(2).toLocaleString() + "Kwh YDAY" );

               										                                                                         $("#total-cost").html( "&#8369;" + (  getPeso(adc0[0], 23.65) ).toFixed(2) + marker ).toLocaleString();
               										                                                                         $("#total-cost-peso").html( "&#8369;" + (  getPeso(adc0[1], 23.65) ).toFixed(2) + " YDAY").toLocaleString();

                                                                                       						                 $("#admin-acu").html( ( getWatts(adc1[0], 120.8) ).toFixed(2) .toLocaleString() + "Kwh" + marker1 );
													                                                                         $("#admin-acu-peso").html(  ( getWatts(adc1[1], 120.8) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

                                                                                                                                            
                                                                                       						                 $("#training-acu").html( ( getWatts(adc2[0], 120.8) ).toFixed(2) .toLocaleString() + "Kwh" + marker2 );
													                                                                         $("#training-acu-peso").html( ( getWatts(adc2[1], 120.8) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

                                                                                       						                 $("#sales-acu").html( ( getWatts(adc3[0], 120.8) ).toFixed(2) .toLocaleString() + "Kwh" + marker3 );
														                                                                     $("#sales-acu-peso").html( ( getWatts(adc3[1], 120.8) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

                                                                                       						                 $("#acct-acu").html( ( getWatts(adc4[0], 120.8) ).toFixed(2) .toLocaleString() + "Kwh" + marker4 );
														                                                                     $("#acct-acu-peso").html( ( getWatts(adc4[1], 120.8) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

                                                                                       						                 $("#tech-acu").html( ( getWatts(adc5[0], 120.8) ).toFixed(2) .toLocaleString() + "Kwh" + marker5 );
														                                                                     $("#tech-acu-peso").html(  ( getWatts(adc5[1], 120.8) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

                                                                                                                                                    

					                                                                                         });



					                                                                                      }


					                                                                                    });
















					                                                                                  $.ajax({

												                                                              method: "post",
												                                                              url: "/today/get_today_compare/",
                                                                                                              data: data1,
																	                                      
												                                                              success: function(data1){


					                                        
					                                                                                                    jQuery.each( JSON.parse(data1), function( i, val1 ){



         														            														                                                                                                                                                              
                                                                                                                                         adc0_2 = (val1.adc0).split("-");
              												                                                                             adc1_2 = (val1.adc1).split("-");
                                                                                                                                         adc2_2 = (val1.adc2).split("-");
              												                                                                             adc3_2 = (val1.adc3).split("-");
                                                                                                                                         adc4_2 = (val1.adc4).split("-");
              												                                                                             adc5_2 = (val1.adc5).split("-");



																			 													         marker_2 = checkMarker(adc0_2[0], adc0_2[1]);
																			 													         marker1_2 = checkMarker(adc1_2[0], adc1_2[1]);
																			 													         marker2_2 = checkMarker(adc2_2[0], adc2_2[1]);
																			 													         marker3_2 = checkMarker(adc3_2[0], adc3_2[1]);
																			 													         marker4_2 = checkMarker(adc4_2[0], adc4_2[1]);
																			 													         marker5_2 = checkMarker(adc5_2[0], adc5_2[1]);




                                                                                                                                          
															 													                         total_outlet =  ( ( getWatts(adc0_2[0], 266) ) + ( getWatts(adc1_2[0], 266) ) + ( getWatts(adc4_2[0], 266) ) + ( getWatts(adc5_2[0], 266)) ).toFixed(2);
															  													                         total_lights =   ( ( getWatts(adc2_2[0], 266) ) + ( getWatts(adc3_2[0], 266) ) ).toFixed(2); 
																			       

																			                                                             $("#tech-outlet").html( ( getWatts(adc0_2[0], 266) ).toFixed(2) .toLocaleString() + "Kwh" + marker_2 );
																																		 $("#tech-outlet-peso").html(  ( getWatts(adc0_2[1], 266) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

																			                                                             $("#server-outlet").html( ( getWatts(adc1_2[0], 266) ).toFixed(2) .toLocaleString() + "Kwh"+ marker1_2 );
																																		 $("#server-outlet-peso").html(  ( getWatts(adc1_2[1], 266) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

																			                                                             $("#sales-lights").html( ( getWatts(adc2_2[0], 266) ).toFixed(2) .toLocaleString() + "Kwh"+ marker2_2 );
																																		 $("#sales-lights-peso").html(  ( getWatts(adc2_2[1], 266) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

																			                                                             $("#tech-lights").html( ( getWatts(adc3_2[0], 266) ).toFixed(2) .toLocaleString() + "Kwh"+ marker3_2 );
																																		 $("#tech-lights-peso").html(  ( getWatts(adc3_2[1], 266) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

																			                                                             $("#acct-outlet").html( ( getWatts(adc4_2[0], 266) ).toFixed(2) .toLocaleString() + "Kwh"+ marker4_2 );
																																		 $("#acct-outlet-peso").html(  ( getWatts(adc4_2[1], 266) ).toFixed(2).toLocaleString() + "Kwh YDAY" );

																			                                                             $("#logistic-outlet").html( ( getWatts(adc5_2[0], 266) ).toFixed(2) .toLocaleString() + "Kwh"+ marker5_2 );
																																		 $("#logistic-outlet-peso").html(  ( getWatts(adc5_2[1], 266) ).toFixed(2).toLocaleString() + "Kwh YDAY" );




					                                                                                         });
                                                                     


					                                                                                      }


					                                                                                    });






                                                                     
                                                                     myPie.data.datasets[0].data[0] = total_outlet;
                                                                     myPie.data.labels[0] = total_outlet + "Kwh Outlet";
                                                                     myPie.data.datasets[0].data[1] = total_aircon;
                                                                     myPie.data.labels[1] = total_aircon + "Kwh Aircon";
                                                                     myPie.data.datasets[0].data[2] = total_lights;
                                                                     myPie.data.labels[2] = total_lights + "Kwh Lights";
                                                                     myPie.update();
                                                                     knobfunction(main_power);



                                                    
                                                                             if ( main_power > 50 && main_power < 85)
                                                                                {
                                                                                  $('.knob').trigger('configure', { "fgColor": "#ff9900","skin":"tron"});
                                                                                  $('.knob').css({ 'color': '#ff9900' });
                                                                                  $('.knob').val(main_power + "%");

                                                                                }
                                                                             else if ( main_power >= 85 )

                                                                                  {

                                                                                  $('.knob').trigger('configure', { "fgColor": "#cc3333","skin":"tron" });
                                                                                  $('.knob').css({ 'color': '#cc3333' });
                                                                                  $('.knob').val(main_power + "%");


                                                                                  }

                                                                             else if ( main_power > 30 && main_power <=50 )

                                                                                  {

                                                                                  $('.knob').trigger('configure', { "fgColor": "#009966","skin":"tron" });
                                                                                  $('.knob').css({ 'color': '#009966' });
                                                                                  $('.knob').val(main_power + "%");


                                                                                  }
 
                                                                             else
                                                                                {

                                                                                  $('.knob').trigger('configure', { "fgColor": "#3399cc","skin":"tron" });
                                                                                  $('.knob').css({ 'color': '#3399cc' });
                                                                                  $('.knob').val(main_power + "%");

                                                                                }
                                                                     
                                                                             
							       
                                                                             


                                                                   

                                                                     

								












					                                                             $.ajax({

												method: "post",
												url: "/today/get_perhour/",
												data:data,					                                      
												success: function(data2){

                                                                                                                                     
                                                                                                                 
					                                                                                      jQuery.each( JSON.parse(data2), function( i, val2 ){

                                                                                                                                     



                                                                                                                                           var t0 = val2.time0.split("-");
                                                                                                                                           var t1 = val2.time1.split("-");
                                                                                                                                           var t2 = val2.time2.split("-");
                                                                                                                                           var t3 = val2.time3.split("-");
                                                                                                                                           var t4 = val2.time4.split("-");
                                                                                                                                           var t5 = val2.time5.split("-");
                                                                                                                                           var t6 = val2.time6.split("-");
                                                                                                                                           var t7 = val2.time7.split("-");
                                                                                                                                           var t8 = val2.time8.split("-");
                                                                                                                                           var t9 = val2.time9.split("-");
                                                                                                                                           var t10 = val2.time10.split("-");
                                                                                                                                           var t11 = val2.time11.split("-");
                                                                                                                                           var t12 = val2.time12.split("-");
                                                                                                                                           var t13 = val2.time13.split("-");
                                                                                                                                           var t14 = val2.time14.split("-");
                                                                                                                                           var t15 = val2.time15.split("-");
                                                                                                                                           var t16 = val2.time16.split("-");
                                                                                                                                           var t17 = val2.time17.split("-");
                                                                                                                                           var t18 = val2.time18.split("-");
                                                                                                                                           var t19 = val2.time19.split("-");
                                                                                                                                           var t20 = val2.time20.split("-");
                                                                                                                                           var t21 = val2.time21.split("-");
                                                                                                                                           var t22 = val2.time22.split("-");
                                                                                                                                           var t23 = val2.time23.split("-");


                                                                                                                                           time0 = ( getWatts(t0[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time0_1 = ( getWatts(t0[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time1 = ( getWatts(t1[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time1_1 = ( getWatts(t1[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time2 = ( getWatts(t2[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time2_1 = ( getWatts(t2[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time3 = ( getWatts(t3[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time3_1 = ( getWatts(t3[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time4 = ( getWatts(t4[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time4_1 = ( getWatts(t4[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time5 = ( getWatts(t5[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time5_1 = ( getWatts(t5[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time6 = ( getWatts(t6[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time6_1 = ( getWatts(t6[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time7 = ( getWatts(t7[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time7_1 = ( getWatts(t7[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time8 = ( getWatts(t8[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time8_1 = ( getWatts(t8[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time9 = ( getWatts(t9[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time9_1 = ( getWatts(t9[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time10 = ( getWatts(t10[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time10_1 = ( getWatts(t10[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time11 = ( getWatts(t11[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time11_1 = ( getWatts(t11[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time12 = ( getWatts(t12[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time12_1 = ( getWatts(t12[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time13 = ( getWatts(t13[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time13_1 = ( getWatts(t13[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time14 = ( getWatts(t14[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time14_1 = ( getWatts(t14[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time15 = ( getWatts(t15[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time15_1 = ( getWatts(t15[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time16 = ( getWatts(t16[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time16_1 = ( getWatts(t16[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time17 = ( getWatts(t17[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time17_1 = ( getWatts(t17[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time18 = ( getWatts(t18[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time18_1 = ( getWatts(t18[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time19 = ( getWatts(t19[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time19_1 = ( getWatts(t19[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time20 = ( getWatts(t20[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time20_1 = ( getWatts(t20[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time21 = ( getWatts(t21[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time21_1 = ( getWatts(t21[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time22 = ( getWatts(t22[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time22_1 = ( getWatts(t22[1], 23.65) ).toFixed(2) .toLocaleString();

                                                                                                                                           time23 = ( getWatts(t23[0], 23.65) ).toFixed(2) .toLocaleString();
                                                                                                                                           time23_1 = ( getWatts(t23[1], 23.65) ).toFixed(2) .toLocaleString();




                                                                                                                                          myBar.data.datasets[0].data[0] = time0_1;
                                                                                                                                          myBar.data.datasets[1].data[0] = time0;

                                                                                                                                          myBar.data.datasets[0].data[1] = time1_1;
                                                                                                                                          myBar.data.datasets[1].data[1] = time1;

                                                                                                                                          myBar.data.datasets[0].data[2] = time2_1;
                                                                                                                                          myBar.data.datasets[1].data[2] = time2;

                                                                                                                                          myBar.data.datasets[0].data[3] = time3_1;
                                                                                                                                          myBar.data.datasets[1].data[3] = time3;

                                                                                                                                          myBar.data.datasets[0].data[4] = time4_1;
                                                                                                                                          myBar.data.datasets[1].data[4] = time4;

                                                                                                                                          myBar.data.datasets[0].data[5] = time5_1;
                                                                                                                                          myBar.data.datasets[1].data[5] = time5;

                                                                                                                                          myBar.data.datasets[0].data[6] = time6_1;
                                                                                                                                          myBar.data.datasets[1].data[6] = time6;

                                                                                                                                          myBar.data.datasets[0].data[7] = time7_1;
                                                                                                                                          myBar.data.datasets[1].data[7] = time7;

                                                                                                                                          myBar.data.datasets[0].data[8] = time8_1;
                                                                                                                                          myBar.data.datasets[1].data[8] = time8;

                                                                                                                                          myBar.data.datasets[0].data[9] = time9_1;
                                                                                                                                          myBar.data.datasets[1].data[9] = time9;

                                                                                                                                          myBar.data.datasets[0].data[10] = time10_1;
                                                                                                                                          myBar.data.datasets[1].data[10] = time10;

                                                                                                                                          myBar.data.datasets[0].data[11] = time11_1;
                                                                                                                                          myBar.data.datasets[1].data[11] = time11;

                                                                                                                                          myBar.data.datasets[0].data[12] = time12_1;
                                                                                                                                          myBar.data.datasets[1].data[12] = time12;

                                                                                                                                          myBar.data.datasets[0].data[13] = time13_1;
                                                                                                                                          myBar.data.datasets[1].data[13] = time13;

                                                                                                                                          myBar.data.datasets[0].data[14] = time14_1;
                                                                                                                                          myBar.data.datasets[1].data[14] = time14;

                                                                                                                                          myBar.data.datasets[0].data[15] = time15_1;
                                                                                                                                          myBar.data.datasets[1].data[15] = time15;

                                                                                                                                          myBar.data.datasets[0].data[16] = time16_1;
                                                                                                                                          myBar.data.datasets[1].data[16] = time16;

                                                                                                                                          myBar.data.datasets[0].data[17] = time17_1;
                                                                                                                                          myBar.data.datasets[1].data[17] = time17;

                                                                                                                                          myBar.data.datasets[0].data[18] = time18_1;
                                                                                                                                          myBar.data.datasets[1].data[18] = time18;

                                                                                                                                          myBar.data.datasets[0].data[19] = time19_1;
                                                                                                                                          myBar.data.datasets[1].data[19] = time19;

                                                                                                                                          myBar.data.datasets[0].data[20] = time20_1;
                                                                                                                                          myBar.data.datasets[1].data[20] = time20;

                                                                                                                                          myBar.data.datasets[0].data[21] = time21_1;
                                                                                                                                          myBar.data.datasets[1].data[21] = time21;

                                                                                                                                          myBar.data.datasets[0].data[22] = time22_1;
                                                                                                                                          myBar.data.datasets[1].data[22] = time22;

                                                                                                                                          myBar.data.datasets[0].data[23] = time23_1;
                                                                                                                                          myBar.data.datasets[1].data[23] = time23;


                                                                                                                                          myBar.update();








	                                                                                                                               });




                                                                     

                                                                     setTimeout(function(){ get_data(); }, 1000);



					                                                                                      }


					                                                                                    });





                                                                    









					});



















