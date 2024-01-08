<?php
use App\Models\ai_images;

$key = env("OPENAI_KEY", false);

class img
{
private $key;

public function __construct($key)
{
$this->key=$key;
}
 
public function call_img ($input)
{   
//$result='{ "created": 1703987837, "data": [ { "url": "https://oaidalleapiprodscus.blob.core.windows.net/private/org-l1NWXq8Ep7ehnoUDqeKeHhcm/user-OQfAI8erimnq4QaPL3AtG3TA/img-K4CyQlRyu57qkjshF6sV3DXr.png?st=2023-12-31T00%3A57%3A17Z&se=2023-12-31T02%3A57%3A17Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-12-30T13%3A30%3A16Z&ske=2023-12-31T13%3A30%3A16Z&sks=b&skv=2021-08-06&sig=qsONrFCxlUx8mFI87rhgnpuT5IerYqgcNm2h4i5x7ZU%3D" } ] }';
  

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/images/generations');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//following two lines only used for localhost, should not be used in production
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"model\": \"dall-e-2\",\n    \"prompt\": \"".urlencode($input)."\",\n    \"n\": 1,\n    \"size\": \"1024x1024\"\n  }");
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer '.$this->key.'';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
echo 'Error:' . curl_error($ch);
}
else {
return json_decode ($result);   
}
curl_close($ch);

return json_decode ($result);   
} 
}

//Invoking of class

$im=new img($key);
$imgs=$im->call_img ($input);
$gen = ai_images::where('img_id',$id)->first();
?>

<?php  //generated imaged  ?>
<div class="row align-items-end">
<div class="col-8 "><i>image generated at <?=$gen->updated_at; ?></i></div>
<div class="col-4 text-right"> 
<a href="javascript:void (0)" onclick="$('#ai_form').trigger('reset');$('#ai_img').html ('');" class="btn btn-outline-primary">Reset</a>
</div>
</div>
<div class="border rounded" id="imgn" style="height:300px;">
<img src="<?php echo $imgs->data[0]->url; ?>" class="img-fluid">
</div>
    
