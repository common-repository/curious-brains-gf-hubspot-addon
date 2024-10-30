 
 

jQuery( document ).ready(function() {
  

                                       var valuhid=document.getElementById('foo').value;
                                       var icre_val=valuhid;
                                       var  timeout = setTimeout(alertFunc,icre_val);// set timeout fun to display access
                                       // token expire time after specific interval
              
                                        function alertFunc() {
                                                              alert("Your token have been expired! Please connect again with HubSpot");
                                                      }
                                    // display view json on button click view json
                                       jQuery('#viewjson').on('click', function() {
                                                              jQuery('#viewentry').toggle();

                                                               var entryid=document.getElementById('entryidy').value;
                                                               var formid=document.getElementById('formidd').value;
                                                               var url2=document.getElementById('foo3').value;
                                                                        jQuery.ajax({
                                                                        type: "post",
                                                                        dataType: "json",
                                                                        url: url2, 
                                                                        data: {
                                                                            action:'get_dataa3', 
                                                                            entryidd: entryid,
                                                                            formidd: formid
                                                                        },
                                                                         success: function(res){
                                                                               // jQuery('#viewentry').show();
                                                                                              jQuery('#viewentry').html(res.data);

                                                                                    },
                                                                          error: function(){
                                                                                              alert('failuregettingentry_viewjson');
                                                                                            }
                                                                             });

                                               });
                                       // show entry table on change form id or select
                                        jQuery('#entry').on('change', function() {
                                                             var value=this.value ;
                                                            var url=document.getElementById('foo1').value;

                                                                            jQuery.ajax({
                                                                            type: "post",
                                                                            dataType: "json",
                                                                            url: url, 
                                                                            data: {
                                                                                action:'get_data2', 
                                                                                id: value
                                                                            },
                                                                             success: function(response){
                                                                        jQuery('#table').hide();
                                                                        var template ='<table class="table1"><tr>';

                                                                                template +='<th><b><center>Entry Id</center></b></th>';
                                                                                template +='<th><b><center>Submitted on</center></b></th>';
                                                                                template +='<th><b><center>User IP</center></b></th>';
                                                                                template +='<th><b><center>Embed Url</center></b></th>';
                                                                                template +='<th><b><center>Status</center></b></th>';
                                                                                template +='<th colspan="50"><b><center> Entry Fields</center></b></th>';


                                                                                template +='</tr>';
                                                                               // template +='</tr>';
                                                                 for (i = 0; i < response.data.length; i++) {
                                                                        template +='<tr>';

                                                                            for (const key in response.data[i]) {
                                                                                    var obj1=response.data[i][key];
                                                                                        for (const key1 in obj1) {
                                                                                                var obj2=obj1[key1];
                                                                                                    for (const key2 in obj2) {
                                                                                             
                                                                                                            if(key2=='id'){

                                                                                                                        template +='<td>';
                                                                                                                        template +=obj2[key2];
                                                                                                                        template +='</td>';


                                                                                                            }
                                                                                                            if(key2=='date'){

                                                                                                                        template +='<td>';
                                                                                                                        template +=obj2[key2];
                                                                                                                        template +='</td>';


                                                                                                            }
                                                                                                            if(key2=='ip'){

                                                                                                                        template +='<td>';
                                                                                                                        template +=obj2[key2];
                                                                                                                        template +='</td>';


                                                                                                            }
                                                                                                            if(key2=='url'){

                                                                                                                        template +='<td>';
                                                                                                                        template +=obj2[key2];
                                                                                                                        template +='</td>';


                                                                                                            }
                                                                                                            if(key2=='status'){

                                                                                                                        template +='<td>';
                                                                                                                        template +=obj2[key2];
                                                                                                                        template +='</td>';


                                                                                                            }
                                                                                                            if(key2!=='status' && key2!=='id' && key2!=='date' && key2!=='url' && key2!=='ip'){
                                                                                                                        template +='<td><center><b>';
                                                                                                                        template +=key2;
                                                                                                                        template+="</center></b><center>";
                                                                                                                        template+=obj2[key2];
                                                                                                                        template +='</center></td>';
                                                                                                            }

                                                                                                        }
                                                                                                  }
                                                                                           }
                                                                                   template +='</tr>';

                                                                                 }
                                                                        template +='<table>';
                                                                 jQuery('#ajaxentry').html(template);
                                                                 } ,
                                                                   error: function(){
                                                                                     alert('failure');
                                                                                    }
                                                            })
                                        });
});
