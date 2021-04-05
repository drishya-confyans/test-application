
<?php
require "config.php";
$con2 = getdb();
$query = "delete from webhook_tbl where 1=1;";
$result = mysqli_query($con2, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

<style>

    .loader {
        border: 4px solid #cecece;
        /* Light grey */
        border-top: 4px solid #c4161c;
        /* Blue */
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 2s linear infinite;
    }
    
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    
    .loading {
        position: fixed;
        z-index: 9999;
        height: 2em;
        width: 2em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }
    /* Transparent Overlay */
    
    .loading:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
    }
    /* :not(:required) hides these rules from IE9 and below */
    
    .loading:not(:required) {
        /* hide "loading..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }
    
    .loading:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        -webkit-animation: spinner 150ms infinite linear;
        -moz-animation: spinner 150ms infinite linear;
        -ms-animation: spinner 150ms infinite linear;
        -o-animation: spinner 150ms infinite linear;
        animation: spinner 150ms infinite linear;
        border-radius: 0.5em;
        -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    }
    /* Animation */
    
    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    
    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    
    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    
    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    
</style>
</head>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" id='myForm' action="webhookFunction.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>T8N Asynchronous Sales Order Processing Application</legend>
                        <!-- File Button -->
                        <div class="row">
                        <div class="col-md-12">
                                <h5 style="margin-bottom: 35px">This application showcases T8N's asynchronous sales order processing. Please enter the number of test sales order you wish to process below.  Additionally, please enter the number of test shipments in each sales orders.  Both of these numbers must be within 1 and 5.  Once you input these two numbers, we will show you the generated sales order data.</h5>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                <label class="col-md-4 control-label" for="filebutton">Number of SO in single API Call</label>
                                <div class="col-md-4">
                                    <input type="text" name="file" id="file" class="input-large">
                                </div>
                            </div> -->
                            <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-md-4 control-label" for="filebutton">Number of sales order to process </label>
                                <div class="col-md-4">
                                    <input onkeyup="this.value = fnc(this.value, 0, 5)" type="text" class="accept_digit_only"  name="file" id="numOfCall" class="input-large">
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="col-md-12">
                                <label class="col-md-4 control-label" for="filebutton">Number of shipments in each sales order</label>
                                <div class="col-md-4">
                                    <input onkeyup="this.value = fnc(this.value, 0, 5)" type="text" class="accept_digit_only" name="file" id="numOfDo" class="input-large">
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                        <!-- Button -->
                        <div class="form-group">
                        <div class="col-md-4"></div>
                            <div class="col-md-4">
                            <button type="button" id="viewPayload" class="btn btn-primary btn-sm" >
   View Payload
</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <br>
            <br>
            <div class="table-responsive">
    <table class="table table-bordered " id='table1'>
        <thead class="thead-dark">
            <tr>
                <th>Transction ID</th>
                <th>sales order number</th>
                <th>Response payload Status</th>
                <th>View Request/Response</th>
                <th>Request timestamp</th>
                <th>Response timestamp</th>
            </tr>
        </thead>
        <tbody>   
        </tbody>
    </table>
</div>
            

            

<!-- Modal -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Density Request Payload
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form">
                  <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                      <textarea rows="20" class="form-control"
                      id="exampleInputEmail1" placeholder="Request Payload"></textarea>
                  </div>
                  
                </form>
                
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="button" id='apiCall' class="btn btn-primary">
                    Send
                </button>
            </div>
        </div>
    </div>
</div>
            

</div>
   
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
    loadingHide();
    $('#myForm').submit(function() {
        loadingShow();
      return true;
    });

    $("#viewPayload").on("click",function(){
    var numOfDo = $('#numOfDo').val();
    var numOfCall = $('#numOfCall').val();
    $('#exampleInputEmail1').text('')
    if (numOfDo) {
        $.ajax({
        type: 'post',
        dataType: "JSON",
        data: {numOfCall:numOfCall,numOfDo: numOfDo,},
        url: "webhookFunction.php",
        success: function (data) {
            var jsonData = JSON.stringify(data.payload, undefined, 4);
                // user is logged in successfully in the back-end
                // let's redirect
                if (data.success == "1")
                {
                   $('#exampleInputEmail1').text(jsonData);
                   $('#myModalNorm').modal('show');

                }
                else
                {
                    alert('Invalid Credentials!');
                }
            // if (data.status == '1') {
            //     $('#myModalNorm').modal('show');
            // }else{
            // }
        },
        async:false
        });
    }
});

$("#apiCall").on("click",function(){
    var payload = $('#exampleInputEmail1').val();
    loadingShow();
    $('#myModalNorm').modal('hide');
    if (payload) {
        $.ajax({
        type: 'post',
        dataType: "JSON",
        data: {payload:payload,},
        url: "webhookFunction.php",
        success: function (data) {
            $('#table1 tbody').html('')
            loadingHide();
            var jsonData = JSON.stringify(data.payload);
                // user is logged in successfully in the back-end
                // let's redirect
                if (data.success == "1")
                {
                    
                    var table = jsonData;

                    var obj = data.payload;
                    $.each(obj, function(key,value) {

                    var row = '<tr id="id' + key + '">' +
                                
                                '<td style="text-align: left;">' + value.transaction_id+ '</td>' +
                                '<td class="realized_rebate" >' +value.sales_order_number+ '</td>' +
                                '<td class="realized_rebate" >'+value.response+'</td>' +
                                '<td class="realized_rebate" ><a target="_blank" href="requestResponse.php?transaction_id='+value.transaction_id+'">View</a></td>' +
                                '<td class="realized_rebate">' + value.request_time + '</td>' +
                                '<td class="realized_rebate">' + value.response_time + '</td>' +
                                '</tr>';
                                $('#table1 tbody').append(row);


                    });

                }
                else
                {
                    alert('Invalid Credentials!');
                }
        },
        });
    }
});
});

// $("#viewPayloadresponse").on("click",function(){
//     var payload = "data";
//     loadingShow();
//     $('#myModalNorm').modal('hide');
//     if (payload) {
//         $.ajax({
//         type: 'post',
//         dataType: "JSON",
//         data: {req_payload:payload,},
//         url: "webhookFunction.php",
//         success: function (data) {
//             loadingHide();
//             var jsonData = JSON.stringify(data.payload);

//             $('#table1 tbody').html('');
//                 // user is logged in successfully in the back-end
//                 // let's redirect
//                 if (data.success == "1")
//                 {
                    
//                     var table = jsonData;

//                     var obj = data.payload;
//                     console.log(obj);
//                     $.each(obj, function(key,value) {
//                         console.log(key);
//                     var row = '<tr id="id' + key + '">' +
                                
//                                 '<td style="text-align: left;">' + key+ '</td>' +
//                                 '<td class="realized_rebate" >' +JSON.stringify(value.request.sales_order_number, undefined, 4)+ '</td>' +
//                                 '<td class="realized_rebate" >' +JSON.stringify(value.response, undefined, 4)+ '</td>' +
//                                 '</tr>';
                                
//                                 $('#table1 tbody').append(row);


//                     });

//                 }
//                 else
//                 {
//                     alert('Invalid Credentials!');
//                 }
//         },
//         });
//     }
// });
// setInterval(test, 30000);
setInterval(tableUpdate, 2000);
// function test(){
//     $.ajax({
//         type: 'post',
//         dataType: "JSON",
//         url: "webhookResponseAPI.php",
//         success: function (data) {
            
//         },
//         });
// }

function tableUpdate(){
    $.ajax({
        type: 'post',
        dataType: "JSON",
        data: {req_payload:'',},
        url: "webhookFunction.php",
        success: function (data) {
            $('#table1 tbody').html('')
            loadingHide();
            var jsonData = JSON.stringify(data.payload);
                // user is logged in successfully in the back-end
                // let's redirect
                if (data.success == "1")
                {
                    
                    var table = jsonData;

                    var obj = data.payload;
                    $.each(obj, function(key,value) {
                    var row = '<tr id="id' + key + '">' +
                                
                                '<td style="text-align: left;">' + key+ '</td>' +
                                '<td class="realized_rebate" >' +value.sales_order_number+ '</td>' +
                                '<td class="realized_rebate" >' +((value.response=="waiting")?value.response:"processed")+ '</td>' +
                                '<td class="realized_rebate" ><a target="_blank" href="requestResponse.php?transaction_id='+key+'">View</a></td>' +
                                '<td class="realized_rebate">' + value.request_time + '</td>' +
                                '<td class="realized_rebate">' + value.response_time + '</td>' +
                                '</tr>';
                                $('#table1 tbody').append(row);


                    });

                }
                else
                {
                    alert('Invalid Credentials!');
                }
        },
        });
}
$(".accept_digit_only").keypress(function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        });
function loadingShow() {
    var loaderHtml = '<div class="loading">Loading&#8230;</div>';
    loadingHide();
    $(loaderHtml).appendTo('body');
    $('.loader').css('height', $('html').height());
}
function loadingHide() {
    $('.loading').remove();
}
function fnc(value, min, max) 
{
    if(parseInt(value) <= 0 || isNaN(value)) 
        return 1; 
    else if(parseInt(value) > 5) 
        return "5"; 
    else return value;
}




  </script>