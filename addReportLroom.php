<?php
include 'connect.php';

if(isset($_POST['submit'])) {
    $dates = $_POST['date'];
    $areas = $_POST['area'];
    $lights = $_POST['lights'];
    $power_outlets = $_POST['power_outlets'];
    $ceiling_boards = $_POST['ceiling_boards'];
    $others = $_POST['others'];

    $recordsInserted = 0;
    
    // Prepare the statement once outside the loop
    $stmt = $conn->prepare("INSERT INTO classroom_inspection (date, area, lights, power_outlets, ceiling_boards, others) 
                          VALUES (?, ?, ?, ?, ?, ?)");
    
    // Loop through each row of data
    for ($i = 0; $i < count($areas); $i++) {
        // Only insert if all fields in this row are filled
        if(!empty($dates[$i]) && !empty($areas[$i]) && !empty($lights[$i]) && 
           !empty($power_outlets[$i]) && !empty($ceiling_boards[$i]) && !empty($others[$i])) {
            
            // Bind parameters for each row
            $stmt->bind_param("ssssss", 
                $dates[$i],
                $areas[$i],
                $lights[$i],
                $power_outlets[$i],
                $ceiling_boards[$i],
                $others[$i]
            );
            
            // Execute and count successful insertions
            if($stmt->execute()) {
                $recordsInserted++;
            }
        }
    }
    
    // Close the prepared statement
    $stmt->close();

    if ($recordsInserted > 0) {
        echo "<script>
                alert('Successfully added " . $recordsInserted . " reports');
                window.location.href = 'lowerRoom.php';
              </script>";
    } else {
        echo "<script>
                alert('No complete records to add. Please fill all fields for at least one row.');
                window.location.href = 'addLowerRoom.php';
              </script>";
    }
    exit();
}
?>