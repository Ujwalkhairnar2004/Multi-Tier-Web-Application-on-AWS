<?php
// submit_admission.php

define('DB_HOST', 'RDS_ENDPOINT'); // db endpoint
define('DB_NAME', 'student_admission'); // db name
define('DB_USER', 'admission_user');  //db user name
define('DB_PASS', 'your_password_here'); // db pw
define('DB_CHARSET', 'utf8mb4');

$options = [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
$pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch(PDOException $e){
die("Database connection failed: ".$e->getMessage());
}

if($_SERVER['REQUEST_METHOD']==='POST'){

$fullname = trim($_POST['fullname'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$gender   = $_POST['gender'] ?? '';
$course   = $_POST['course'] ?? '';
$year     = $_POST['year'] ?? '';   // ⭐ added
$dob      = $_POST['dob'] ?? '';
$address  = trim($_POST['address'] ?? '');

$errors=[];

// Validation
if($fullname==='') $errors[]="Full name required";
if($email==='' || !filter_var($email,FILTER_VALIDATE_EMAIL)) $errors[]="Valid email required";
if(!preg_match('/^[0-9]{10}$/',$phone)) $errors[]="Phone must be 10 digits";
if($gender==='') $errors[]="Gender required";
if($course==='') $errors[]="Course required";
if($year==='') $errors[]="Course year required";   // ⭐ added
if($dob==='') $errors[]="DOB required";
if($address==='') $errors[]="Address required";

if(empty($errors)){

try{

// ⭐ check duplicate email first
$check=$pdo->prepare("SELECT id FROM students WHERE email=?");
$check->execute([$email]);
if($check->fetch()){
echo "<h3 style='color:red;text-align:center;margin-top:20px;'>Email already registered</h3>";
exit;
}

$sql="INSERT INTO students(fullname,email,phone,gender,course,year,dob,address)
VALUES(:fullname,:email,:phone,:gender,:course,:year,:dob,:address)";

$stmt=$pdo->prepare($sql);
$stmt->execute([
':fullname'=>$fullname,
':email'=>$email,
':phone'=>$phone,
':gender'=>$gender,
':course'=>$course,
':year'=>$year,
':dob'=>$dob,
':address'=>$address
]);

echo "
<div style='text-align:center;margin-top:40px;font-family:Arial'>
<h2 style='color:green'>Admission Submitted Successfully ✅</h2>
<a href='index.html' style='padding:10px 20px;background:#6C63FF;color:#fff;border-radius:6px;text-decoration:none;'>Back to Form</a>
</div>
";

}catch(PDOException $e){
echo "<h3 style='color:red;text-align:center;margin-top:20px;'>Database error</h3>";
}

}else{
echo "<div style='color:red;margin:20px'><ul>";
foreach($errors as $err){
echo "<li>".htmlspecialchars($err)."</li>";
}
echo "</ul></div>";
}

}else{
echo "<h3 style='text-align:center;margin-top:20px;'>Invalid request</h3>";
}
?>
