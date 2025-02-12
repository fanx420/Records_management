<?php
include 'connect.php';
session_start();

if(isset($_POST['submit'])) {
    $dates = $_POST['date'];
    $areas = $_POST['area'];
    $transformers = $_POST['transformer'];
    $findings = $_POST['findings'];
    $floors = $_POST['floor'];
    
    $success = true;
    
    // Loop through the arrays and insert each record
    for($i = 0; $i < count($dates); $i++) {
        if(!empty($dates[$i]) && !empty($areas[$i]) && !empty($transformers[$i]) && !empty($findings[$i])) {
            $sql = "INSERT INTO electrical_room_inspection (date, area, transformer, findings, floor) 
                    VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $dates[$i], $areas[$i], $transformers[$i], $findings[$i], $floors[$i]);
            
            if(!$stmt->execute()) {
                $success = false;
                $_SESSION['error'] = "Error: " . $stmt->error;
                break;
            }
        }
    }
    
    if($success) {
        $_SESSION['success'] = "Reports added successfully!";
        header("Location: elc.php");
    } else {
        header("Location: addElc.php");
    }
    exit();
}

$_SESSION['error'] = "Form submission failed";
header("Location: addElc.php");
exit();
