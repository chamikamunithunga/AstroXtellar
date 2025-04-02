<?php
session_start();
require 'Backend/Database/connect.php';
// Check if user is logged in
if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission via AJAX
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_name'])) {
    $new_name = trim($_POST['name']);
    $email = $_SESSION['email'];
    // Update the username in the database
    $stmt = $conn->prepare("UPDATE astrox SET username = ? WHERE email = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
        exit();
    }
    
    $stmt->bind_param("ss", $new_name, $email);
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update name: ' . $stmt->error]);
        exit();
    }
    
    if ($stmt->affected_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'No changes made or user not found']);
        exit();
    }
    
    $stmt->close();
    if(empty($new_name)) {
        echo json_encode(['status' => 'error', 'message' => 'Name cannot be empty']);
        exit();
    }
    
    // Update user's name in session
    $_SESSION['username'] = $new_name;
    
    // In a real application, you would update the database here
    // Example: $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
    // $stmt->execute([$new_name, $_SESSION['user_id']]);
    
    echo json_encode(['status' => 'success', 'message' => 'Name updated successfully']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
body {
    background-image: url('./imgs/updatebg.jpg');
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    color: white;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: flex-end; 
    min-height: 70vh; 
    margin: 0;
}

.container {
    max-width: 600px;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.3);
    margin-bottom: 50px; 
}



        .card {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 10px;
            
        }

        .card-title {
            color: #eaff00;
        }

        .btn-primary {
            background: linear-gradient(45deg, #00b3ff, #eaff00);
            color:#000000;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg,rgb(68, 0, 255), #00b3ff);
            color:rgb(255, 255, 255);
            transform: scale(1.05);
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.3);
            
        }

        .btn-close {
            background-color: white;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.32);
            border: none;
            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.23);
            color: white;
            box-shadow: none;
        }


        .back-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 8px 15px;
    border-radius: 10px;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
    border: none;
}

.back-btn:hover {
    background: rgba(255, 255, 255, 0.4);
    color: black;
}

    </style>
</head>
<body>
<a href="javascript:history.back()" class="btn btn-secondary back-btn">
    ← Back
</a>

    <div class="container mt-5">
        <h2 class="text-center">Account Settings</h2>
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Personal Information</h5>
                <p>Current Name: <strong><?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></strong></p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateNameModal">
                    Update Name
                </button>
            </div>
        </div>
    </div>

    <!-- Modal for updating name -->
    <div class="modal fade" id="updateNameModal" tabindex="-1" aria-labelledby="updateNameModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateNameModalLabel">Update Your Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateNameForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">New Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateNameForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'update_account.php',
                    type: 'POST',
                    data: {
                        name: $('#name').val(),
                        update_name: true
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
