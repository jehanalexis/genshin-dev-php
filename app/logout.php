<?php
// ----------------------------------------------------------------
// Call the database:

// session_start();
// include_once '../secured/conn.php';

// ----------------------------------------------------------------

// Check if the user session exists (this is on database):

// if (isset($_SESSION['user'])) {
//     $user = $_SESSION['user'];

//     // Update 'isOnline' status in the database
//     $query = "UPDATE login SET isOnline = 0 WHERE username = ?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("s", $user);
//     $stmt->execute();
// }

// ----------------------------------------------------------------

// Clear session data:

// $_SESSION = array();

// ----------------------------------------------------------------

// Destroy the session:

// session_destroy();

// ----------------------------------------------------------------

// Add Google logout script before redirecting:

// echo "<script>
//     // Remove Google Sign-In session state
//     localStorage.removeItem('g_state');
    
//     // Redirect to the login page
//     window.location.href = '../login.php';
// </script>";
// exit();
// ----------------------------------------------------------------

header("Location: ../login.php");
?>
