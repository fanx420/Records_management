<?php
include 'connect.php';

// Initialize row variable
$row = null;

// Fetch record to edit
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM classroom_inspection WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if(!$row) {
        echo "<script>
                alert('Record not found');
                window.location.href = 'middleRoom.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('No record ID provided');
            window.location.href = 'middleRoom.php';
          </script>";
    exit();
}

// Handle form submission
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $area = $_POST['area'];
    $lights = $_POST['lights'];
    $power_outlets = $_POST['power_outlets'];
    $ceiling_boards = $_POST['ceiling_boards'];
    $others = $_POST['others'];

    // Validate all required fields
    if(!empty($date) && !empty($lights) && !empty($power_outlets) && 
       !empty($ceiling_boards) && !empty($others)) {
        
        // Prepare update statement
        $stmt = $conn->prepare("UPDATE classroom_inspection 
                              SET date=?, area=?, lights=?, power_outlets=?, 
                                  ceiling_boards=?, others=? 
                              WHERE id=?");
        
        if ($stmt === false) {
            die('prepare() failed: ' . htmlspecialchars($conn->error));
        }
        
        // Bind parameters
        $stmt->bind_param("ssssssi", 
            $date, 
            $area, 
            $lights, 
            $power_outlets, 
            $ceiling_boards, 
            $others, 
            $id
        );
        
        // Execute update
        if($stmt->execute()) {
            echo "<script>
                    alert('Report updated successfully!');
                    window.location.href = 'middleRoom.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error updating record: " . $stmt->error . "');
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all fields.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Report</h2>
        <?php if($row): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" name="date" 
                       value="<?php echo htmlspecialchars($row['date']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Area</label>
                <input type="text" class="form-control" name="area" 
                       value="<?php echo htmlspecialchars($row['area']); ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Lights</label>
                <input type="text" class="form-control" name="lights" 
                       value="<?php echo htmlspecialchars($row['lights']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Power Outlets</label>
                <input type="text" class="form-control" name="power_outlets" 
                       value="<?php echo htmlspecialchars($row['power_outlets']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ceiling Boards</label>
                <input type="text" class="form-control" name="ceiling_boards" 
                       value="<?php echo htmlspecialchars($row['ceiling_boards']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Others</label>
                <input type="text" class="form-control" name="others" 
                       value="<?php echo htmlspecialchars($row['others']); ?>" required>
            </div>

            <div class="mb-3">
                <button type="submit" name="update" class="btn btn-primary">Update Report</button>
                <a href="middleRoom.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>