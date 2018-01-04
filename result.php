<?Php
session_start();
?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Survey online script plus2net demo scripts using JQuery</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<?Php
require "config.php";
for($i=1;$i<=10;$i++){ // loop for 10 questions
$query="select opt, count(ans_id) as no, opt1,opt2,opt3,opt4,qst  from poll_answer left join poll_qst on poll_qst.qst_id=poll_answer.qst_id where poll_answer.qst_id=$i group by opt";
foreach ($dbo->query($query) as $row) {
switch ($row['opt']){
case 'option1':
$opt1=$row['opt1'];
$no1=$row['no'];
break;

case 'option2':
$opt2=$row['opt2'];
$no2=$row['no'];
break;

case 'option3':
$opt3=$row['opt3'];
$no3=$row['no'];
break;

case 'option4':
$opt4=$row['opt4'];
$no4=$row['no'];
break;

}
//echo "<br>$row[ans],$row[no] <br>";
}
$total=($no1+$no2+$no3+$no4);
$no1_p=number_format($no1*100/$total);
$no2_p=number_format($no2*100/$total);
$no3_p=number_format($no3*100/$total);
$no4_p=number_format($no4*100/$total);


//////////////
echo "<b>$row[qst]</b> <br><br>";
echo "$opt1 ($no1) $no1_p%";
echo "<br><br>$opt2 ($no2) $no2_p% ";
echo "<br><br>$opt3 ($no3) $no3_p%";
echo "<br><br>$opt4 ($no4) $no4_p%";

echo "<br><br>Total answers : $total <hr>";

} //end of for loop for ten questions
?>
</body>
</html>
