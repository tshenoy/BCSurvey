<?Php
session_start();
error_reporting(0);// With this no error reporting will be there
require "config.php";
$qst_id=$_POST['qst_id'];
$opt=$_POST['opt']; // User choice
//$qst_id=10;
//$opt='option3';

if(!is_numeric($qst_id)){
echo "Data Error";
exit; }


$sql=$dbo->prepare("insert into poll_answer(email,qst_id,opt) values('$_SESSION[email]',$qst_id,:opt)");
$sql->bindParam(':opt',$opt,PDO::PARAM_STR, 50);
$sql->execute();
/*


*/

/*
//// Qestions are collected from CSV file /////////
$next='F'; // Flag is set to display thank you message
$csv = array_map('str_getcsv', file('poll_qst.csv'));
if(count($csv) > $qst_id){
$next='T';
//print_r($csv[$qst_id]); // working fine
$row=$csv[$qst_id];
//print_r($row); // working fine 
$qst_id=$qst_id+1;
$main= array("data"=>array("q1"=>"$row[1]","opt1"=>"$row[2]","opt2"=>"$row[3]","opt3"=>"$row[4]","opt4"=>"$row[5]","qst_id"=>"$qst_id"),"next"=>"$next");
}else{
$main= array("next"=>"$next");
}

///// end of qustions from CSV file ///////
*/

//////// Collected from databse ///////
$qst_id=$qst_id+1;
$no_questions = $dbo->query("select count(qst_id) from poll_qst")->fetchColumn();
if($qst_id > $no_questions){
$next='F'; // Flag is set to display thank you message
}else{
$next='T'; // Flag is set to display next question

$count=$dbo->prepare("select * from poll_qst where qst_id=$qst_id");
if($count->execute()){
$row = $count->fetch(PDO::FETCH_OBJ);
}
}
$main= array("data"=>array("q1"=>"$row->qst","opt1"=>"$row->opt1","opt2"=>"$row->opt2","opt3"=>"$row->opt3","opt4"=>"$row->opt4","qst_id"=>"$qst_id"),"next"=>"$next");
// end of collection from database //////


echo json_encode($main);

////////////
?>