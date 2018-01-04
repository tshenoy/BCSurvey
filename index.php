<?Php
session_start();
?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Survey online</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<script>
   $(document).ready(function() {

$("input:radio[name=options]").click(function() {
$('#maindiv').hide('slide', {direction: 'left'}, 100);
$.post( "surveyck.php", {"opt":$(this).val(),"qst_id":$("#qst_id").val()},function(return_data,status){

if(return_data.next=='T'){
$('#q1').html(return_data.data.q1);
$('label[for=opt1]').html(return_data.data.opt1);
$('label[for=opt2]').html(return_data.data.opt2);
$('label[for=opt3]').html(return_data.data.opt3);
$('label[for=opt4]').html(return_data.data.opt4);
$("#qst_id").val(return_data.data.qst_id);
}
else{$('#maindiv').html("Thanks for your views");}

},"json"); 
$("#f1")[0].reset();
 $('#maindiv').show('slide', {direction: 'right'}, 1000);

     });


   });
</script>
<br><br><br><br><br>
<?Php
require "config.php";
$count=$dbo->prepare("select * from poll_qst where qst_id=1");
if($count->execute()){
$row = $count->fetch(PDO::FETCH_OBJ);
}
echo "
<div id='maindiv' class='maindiv'>
<form id='f1'>
<table>
<tr><td>
<h3 id='q1'>$row->qst</h3></td></tr>
<tr><td>
<input type=hidden id=qst_id value=$row->qst_id>
<tr><td>
      <input type='radio' name='options' id='opt1' value='option1' > <label for='opt1' class='lb'>$row->opt1</label>
</td></tr>
<tr><td>
      <input type='radio' name='options' id='opt2' value='option2' >  <label for='opt2' class='lb'>$row->opt1</label>
</td></tr>

<tr><td>
      <input type='radio' name='options' id='opt3' value='option3' >  <label for='opt3' class='lb'>$row->opt1</label>
</td></tr>
<tr><td>
      <input type='radio' name='options' id='opt4' value='option4' >  <label for='opt4' class='lb'>$row->opt1</label>
</td></tr>

</table>
</form>
</div>


";
?>
</body>
</html>
