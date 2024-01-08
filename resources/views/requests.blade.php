<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AI Image Generation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    
    <body>
    <?php
use App\Models\ai_images;
$result = ai_images::latest('updated_at')->first();
?>

<div class="container-fluid" style="width:100%;">
    <div class="navbar navbar-dark bg-dark box-shadow" style="width:100%;margin-bottom:20px;">
    <div class="col-5"></div>
        <div class="container col-3">
          <a href="/" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>AI Images Generator</strong>
          </a>
           </div>
           <div class="col-4"><a href="/"  class="btn btn-primary btn-submit float-right">Generate Images</a></div>
      </div>

    <div class="container-fluid" style="width:100%;">
   
    <? //Form for generating image ?>
    <div class="row" style="width:100%;">
   <div class="col-3"></div>
   <div class="col-6">
    <div class="row justify-content-center">
    <span class="text-center"><h4 class="text-center">Requests</h1></span>
    </div>
     <div class="row">
     <div id="1" style="width:100%;">
     <table class="table table-striped">
  <thead class="">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Input</th>
      <th scope="col">Time</th>
</tr>
<?php

$img=ai_images::orderBy('img_id','asc')->get();
foreach ($img as $imgs) {
?>
<tr>
      <td scope="col"><?=$imgs->img_id; ?></td>
      <td scope="col"><?=$imgs->input; ?></td>
      <td scope="col"><?=$imgs->updated_at; ?></td>
      
</tr>
<?php }  ?>
  </thead>

  <tbody>
    <?php
    /*
    foreach ($users as $user) {


?>
    <tr id="id<?=$user->employee_id ?>">
      <th scope="row"><?=$user->employee_id ?></th>
      <td><?=$user->firstname;  ?></td>
      <td><?=$user->lastname;  ?></td>
      <td><?=$user->date_of_birth;  ?></td>
      <td><?=$user->address;  ?></td>
      <td><?=$user->email;  ?></td>
      <td><?=$user->phone;  ?></td>
      <td>NA</td>
      <td>NA</td>
      <td><button type="button" onclick="$('#id<?=$user->employee_id ?>').remove ();go_delete ('<?=$user->employee_id ?>')" class="btn-close" aria-label="Close"></button></td>
      
    </tr>
    <?php } */ ?>
    
  </tbody>
</table>
     
     </div>
            
        
        </div>
        <div class="col-4"></div>
   
</div>
    </div>
    </div>
    <script>
//ajax call to submit the form values to table (ai_image) and generate image using curl request to openai

            $("#submit").click(function(e){
                if($("form")[0].checkValidity()) {
                    
                e.preventDefault();
                $('#spinner').show ();
                var _token = $("input[name='_token']").val();
                var input = $("#input").val();
                var id = $("#id").val();
                var ids=parseFloat (id)+1;
                
                $.ajax({
                    url: "{{ route('ajax.validation.store') }}",
                    type:'POST',
                    data: {_token:_token, input:input,id:id},
                    success: function(data) {
                        $('#spinner').hide ();
                        $('#id').val (ids);
                        $('#ai_img').html (data);
                        
                        //$('#submit').hide ();

                    console.log(data.error)
                        if($.isEmptyObject(data.error)){
                           
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
         }
         else console.log("invalid form");
            }); 

            function printErrorMsg (msg) {
                $.each( msg, function( key, value ) {
                    console.log(key);
                    $('.'+key+'_err').text(value);
                });
            }
        
    </script>
  </body>
</html>
