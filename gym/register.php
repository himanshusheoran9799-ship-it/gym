<?php
session_start();
require_once 'db.php';

// Redirect if already logged in
if (isset($_SESSION['gym_user_id'])) {
    header("Location: index.php");
    exit();
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (strlen($username) < 3) {
        $error = "Username must be at least 3 characters long.";
    } elseif (strlen($password) < 4) {
        $error = "Password must be at least 4 characters long.";
    } else {
        $name = mysqli_real_escape_string($conn, $name);
        $username = mysqli_real_escape_string($conn, $username);
        
        // Check if username is already taken
        $check_sql = "SELECT id FROM gym_users WHERE username = '$username'";
        $check_result = mysqli_query($conn, $check_sql);
        
        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $error = "Username is already taken. Please choose another.";
        } else {
            // Hash password
            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO gym_users (name, username, password) VALUES ('$name', '$username', '$hashed_pass')";
            if (mysqli_query($conn, $sql)) {
                $user_id = mysqli_insert_id($conn);
                
                // Set Session
                $_SESSION['gym_user_id'] = $user_id;
                $_SESSION['gym_user_name'] = $name;
                $_SESSION['gym_username'] = $username;
                
                header("Location: index.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARC Gym | Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-wrapper {
            min-height: calc(100vh - 70px);
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-bg);
            padding: 40px 24px;
            position: relative;
        }
        .auth-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(135deg, transparent 60%, var(--white) 60.1%),
                linear-gradient(225deg, transparent 80%, var(--white) 80.1%);
            background-size: 100% 100%;
            opacity: 0.8;
            z-index: 1;
            pointer-events: none;
        }
        .auth-card {
            background-color: var(--white);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.05);
            border: 1px solid var(--grey-200);
            position: relative;
            z-index: 2;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-logo {
            display: inline-flex;
            height: 40px;
            color: var(--dark);
            margin-bottom: 15px;
        }
        .auth-logo svg {
            height: 100%;
            width: auto;
        }
        .auth-title {
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 5px;
        }
        .auth-error {
            background-color: #ffebee;
            color: #c62828;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            border-left: 4px solid #c62828;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--grey-600);
            display: block;
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid var(--grey-300);
            font-family: var(--font-body);
            font-size: 0.95rem;
            font-weight: 600;
            background-color: var(--white);
            transition: border-color 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        .auth-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--grey-600);
        }
        .auth-footer a {
            color: var(--primary);
            font-weight: 700;
        }
        .auth-footer a:hover {
            color: var(--primary-hover);
        }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <a href="index.php" class="brand-logo">
               <svg class="brand-logo-svg" viewBox="0 0 300 131" style="height: 38px; fill: currentColor;">
                    <path fill="currentColor" fill-rule="evenodd" d="M 82 -0.5 L 107 -0.5 L 108 0.5 L 109 0.5 L 110.5 2 L 110.5 3 L 112.5 5 L 112.5 7 L 113.5 8 L 113.5 11 L 114.5 12 L 114.5 14 L 115.5 15 L 115.5 17 L 116.5 18 L 116.5 20 L 117.5 21 L 117.5 23 L 118.5 24 L 118.5 26 L 119.5 27 L 119.5 29 L 120.5 30 L 120.5 32 L 121.5 33 L 121.5 35 L 122.5 36 L 122.5 38 L 123.5 39 L 123.5 41 L 124.5 42 L 124.5 44 L 125.5 45 L 125.5 47 L 126.5 48 L 126.5 51 L 127.5 52 L 127.5 54 L 128.5 55 L 128.5 57 L 129.5 58 L 129.5 60 L 130.5 61 L 130.5 63 L 131.5 64 L 131.5 66 L 132.5 67 L 132.5 69 L 133.5 70 L 133.5 72 L 134.5 73 L 134.5 75 L 135.5 76 L 135.5 78 L 136.5 79 L 136.5 81 L 137.5 82 L 137.5 84 L 138.5 85 L 138.5 87 L 139.5 88 L 139.5 90 L 140.5 91 L 140.5 94 L 141.5 95 L 141.5 97 L 142.5 98 L 142.5 100 L 143.5 101 L 143.5 103 L 144.5 104 L 144.5 106 L 145.5 107 L 145.5 109 L 146.5 110 L 146.5 112 L 147.5 113 L 147.5 115 L 148.5 116 L 148.5 118 L 149.5 119 L 149.5 121 L 150.5 122 L 150.5 129 L 150 129.5 L 149 129.5 L 148 130.5 L 120 130.5 L 116.5 127 L 116.5 125 L 115.5 124 L 115.5 122 L 114.5 121 L 114.5 119 L 113.5 118 L 113.5 116 L 112.5 115 L 112.5 113 L 111.5 112 L 111.5 110 L 110.5 109 L 110.5 107 L 109.5 106 L 109.5 104 L 108.5 103 L 108.5 101 L 107.5 100 L 107.5 98 L 106 96.5 L 92 96.5 L 90.5 95 L 90.5 93 L 89.5 92 L 89.5 90 L 88.5 89 L 88.5 87 L 87.5 86 L 87.5 84 L 86.5 83 L 86.5 81 L 85.5 80 L 85.5 78 L 84.5 77 L 84.5 75 L 83.5 74 L 83.5 72 L 82.5 71 L 83 70.5 L 98 70.5 L 98.5 70 L 98.5 69 L 97.5 68 L 97.5 66 L 96.5 65 L 96.5 63 L 95.5 62 L 95.5 59 L 94.5 58 L 94.5 56 L 93.5 55 L 93.5 53 L 92.5 52 L 92.5 50 L 91.5 49 L 91.5 47 L 90.5 46 L 90.5 44 L 89 42.5 L 87.5 44 L 87.5 45 L 85.5 47 L 85.5 48 L 83.5 50 L 83.5 51 L 81.5 53 L 81.5 54 L 79.5 56 L 79.5 57 L 79 57.5 L 78.5 57 L 78.5 56 L 77.5 55 L 77.5 53 L 76.5 52 L 76.5 50 L 75.5 49 L 75.5 47 L 74.5 46 L 74.5 44 L 73.5 43 L 73.5 41 L 72.5 40 L 72.5 38 L 71.5 37 L 71.5 35 L 70.5 34 L 70.5 31 L 69.5 30 L 69.5 28 L 68.5 27 L 68.5 25 L 67.5 24 L 67.5 22 L 66.5 21 L 66.5 19 L 68.5 17 L 68.5 16 L 70.5 14 L 70.5 13 L 72.5 11 L 72.5 10 L 75.5 7 L 75.5 6 L 77.5 4 L 77.5 3 L 80 0.5 L 81 0.5 Z M 116.5 0 L 117 -0.5 L 195 -0.5 L 195.5 0 L 195.5 2 L 196.5 3 L 196.5 5 L 197.5 6 L 197.5 8 L 198.5 9 L 198.5 11 L 199.5 12 L 199.5 14 L 200.5 15 L 200.5 17 L 201.5 18 L 201.5 20 L 202.5 21 L 202.5 23 L 203.5 24 L 203.5 26 L 204.5 27 L 204.5 29 L 205.5 30 L 205.5 32 L 206.5 33 L 206.5 35 L 207.5 36 L 207.5 38 L 208.5 39 L 208.5 41 L 209.5 42 L 209.5 44 L 210.5 45 L 210.5 48 L 211.5 49 L 211.5 51 L 212.5 52 L 212.5 54 L 213.5 55 L 213.5 57 L 214.5 58 L 213.5 59 L 213.5 60 L 212.5 61 L 212.5 62 L 211.5 63 L 211.5 64 L 209.5 66 L 209.5 67 L 200 76.5 L 199 76.5 L 198 77.5 L 197 77.5 L 194.5 80 L 194.5 81 L 195.5 82 L 195.5 84 L 196.5 85 L 196.5 87 L 197.5 88 L 197.5 90 L 198.5 91 L 198.5 94 L 199.5 95 L 199.5 97 L 200.5 98 L 200.5 100 L 201.5 101 L 201.5 103 L 202.5 104 L 202.5 106 L 203.5 107 L 203.5 110 L 204.5 111 L 204.5 113 L 205.5 114 L 205.5 116 L 206.5 117 L 206.5 119 L 207.5 120 L 207.5 122 L 208.5 123 L 208.5 128 L 206 130.5 L 177 130.5 L 176 129.5 L 174 129.5 L 172.5 128 L 172.5 126 L 171.5 125 L 171.5 123 L 170.5 122 L 170.5 120 L 169.5 119 L 169.5 117 L 168.5 116 L 168.5 113 L 167.5 112 L 167.5 110 L 166.5 109 L 166.5 107 L 165.5 106 L 165.5 107 L 164.5 103 L 164.5 101 L 163.5 100 L 163.5 97 L 162.5 96 L 162.5 94 L 161.5 93 L 161.5 91 L 160.5 90 L 160.5 88 L 159.5 87 L 159.5 84 L 158 82.5 L 144 82.5 L 142.5 81 L 142.5 79 L 141.5 78 L 141.5 76 L 140.5 75 L 140.5 73 L 139.5 72 L 139.5 70 L 138.5 69 L 138.5 67 L 137.5 66 L 137.5 64 L 136.5 63 L 136.5 61 L 135.5 60 L 135.5 58 L 134.5 57 L 134.5 55 L 135 54.5 L 180 54.5 L 180.5 54 L 179.5 53 L 179.5 51 L 178.5 50 L 178.5 47 L 177.5 46 L 177.5 44 L 176.5 43 L 176.5 41 L 175.5 40 L 175.5 38 L 174.5 37 L 174.5 35 L 173.5 34 L 173.5 32 L 172.5 31 L 172.5 29 L 171.5 28 L 171.5 27 L 171 26.5 L 125 26.5 L 124.5 26 L 124.5 24 L 123.5 23 L 123.5 21 L 122.5 20 L 122.5 17 L 121.5 16 L 121.5 14 L 120.5 13 L 120.5 11 L 119.5 10 L 119.5 8 L 118.5 7 L 118.5 5 L 117.5 4 L 117.5 2 L 116.5 1 Z M 201.5 0 L 202 -0.5 L 260 -0.5 L 261 0.5 L 263 0.5 L 265.5 3 L 265.5 4 L 266.5 5 L 266.5 8 L 267.5 9 L 267.5 14 L 268.5 15 L 268.5 20 L 269.5 21 L 269.5 23 L 268.5 24 L 268.5 25 L 266 27.5 L 211 27.5 L 209.5 26 L 209.5 24 L 208.5 23 L 208.5 21 L 207.5 20 L 207.5 18 L 206.5 17 L 206.5 15 L 205.5 14 L 205.5 12 L 204.5 11 L 204.5 9 L 203.5 8 L 203.5 6 L 202.5 5 L 202.5 3 L 201.5 2 Z M 62 26.5 L 63.5 28 L 63.5 30 L 64.5 31 L 64.5 33 L 65.5 34 L 65.5 36 L 66.5 37 L 66.5 39 L 67.5 40 L 67.5 42 L 68.5 43 L 68.5 45 L 69.5 46 L 69.5 49 L 70.5 50 L 70.5 52 L 71.5 53 L 71.5 55 L 72.5 56 L 72.5 58 L 73.5 59 L 73.5 61 L 74.5 62 L 74.5 65 L 72.5 67 L 72.5 68 L 70.5 70 L 70.5 71 L 69.5 72 L 69.5 73 L 67.5 75 L 67.5 76 L 65.5 78 L 65.5 79 L 64.5 80 L 64.5 81 L 62.5 83 L 62.5 84 L 61.5 85 L 61.5 86 L 59.5 88 L 59.5 89 L 57.5 91 L 57.5 92 L 56.5 93 L 56.5 94 L 54.5 96 L 54.5 97 L 53.5 98 L 53.5 99 L 51.5 101 L 51.5 102 L 50.5 103 L 50.5 104 L 48.5 106 L 48.5 107 L 46.5 109 L 46.5 110 L 45.5 111 L 45.5 112 L 43.5 114 L 43.5 115 L 42.5 116 L 42.5 117 L 40.5 119 L 40.5 120 L 38.5 122 L 38.5 123 L 37.5 124 L 37.5 125 L 33 129.5 L 32 129.5 L 31 130.5 L 3 130.5 L -0.5 127 L -0.5 125 L 0.5 124 L 0.5 123 L 1.5 122 L 1.5 121 L 2.5 120 L 2.5 119 L 4.5 117 L 4.5 116 L 6.5 114 L 6.5 113 L 8.5 111 L 8.5 110 L 9.5 109 L 9.5 108 L 11.5 106 L 11.5 105 L 13.5 103 L 13.5 102 L 15.5 100 L 15.5 99 L 16.5 98 L 16.5 97 L 18.5 95 L 18.5 94 L 20.5 92 L 20.5 91 L 22.5 89 L 22.5 88 L 23.5 87 L 23.5 86 L 25.5 84 L 25.5 83 L 27.5 81 L 27.5 80 L 29.5 78 L 29.5 77 L 30.5 76 L 30.5 75 L 32.5 73 L 32.5 72 L 34.5 70 L 34.5 69 L 36.5 67 L 36.5 66 L 37.5 65 L 37.5 64 L 39.5 62 L 39.5 61 L 41.5 59 L 41.5 58 L 43.5 56 L 43.5 55 L 44.5 54 L 44.5 53 L 46.5 51 L 46.5 50 L 48.5 48 L 48.5 47 L 50.5 45 L 50.5 44 L 51.5 43 L 51.5 42 L 53.5 40 L 53.5 39 L 55.5 37 L 55.5 36 L 57.5 34 L 57.5 33 L 58.5 32 L 58.5 31 L 60.5 29 L 60.5 28 Z M 220.5 52 L 221 51.5 L 221.5 52 L 221.5 53 L 222.5 54 L 222.5 56 L 223.5 57 L 223.5 59 L 224.5 60 L 224.5 62 L 225.5 63 L 225.5 65 L 226.5 66 L 226.5 68 L 226.5 68 L 227.5 69 L 227.5 72 L 228.5 73 L 228.5 75 L 229.5 76 L 229.5 78 L 230.5 79 L 230.5 81 L 231.5 82 L 231.5 84 L 232.5 85 L 232.5 87 L 233.5 88 L 233.5 90 L 234.5 91 L 234.5 93 L 235.5 94 L 235.5 96 L 236.5 97 L 236.5 100 L 237 100.5 L 290 100.5 L 291 101.5 L 292 101.5 L 292.5 102 L 292.5 103 L 294.5 105 L 294.5 106 L 295.5 107 L 295.5 111 L 296.5 112 L 296.5 115 L 297.5 116 L 297.5 119 L 298.5 120 L 298.5 123 L 299.5 124 L 299.5 126 L 298.5 127 L 298.5 128 L 297 129.5 L 296 129.5 L 295 130.5 L 218 130.5 L 217 129.5 L 216 129.5 L 214.5 128 L 214.5 127 L 213.5 126 L 213.5 123 L 212.5 122 L 212.5 120 L 211.5 119 L 211.5 117 L 210.5 116 L 210.5 114 L 209.5 113 L 209.5 111 L 208.5 110 L 208.5 108 L 207.5 107 L 207.5 105 L 206.5 104 L 206.5 101 L 205.5 100 L 205.5 98 L 204.5 97 L 204.5 95 L 203.5 94 L 203.5 91 L 202.5 90 L 202.5 88 L 201.5 87 L 201.5 85 L 200.5 84 L 200.5 80 L 201 79.5 L 202 79.5 L 204 77.5 L 205 77.5 L 212.5 70 L 212.5 69 L 214.5 67 L 214.5 66 L 215.5 65 L 215.5 64 L 216.5 63 L 216.5 62 L 217.5 61 L 217.5 60 L 218.5 59 L 218.5 58 L 219.5 57 L 219.5 55 L 220.5 54 Z" />
                </svg>
            </a>
            <a href="login.php" class="btn-contact">Login</a>
        </div>
    </header>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <svg class="brand-logo-svg" viewBox="0 0 300 131" style="height: 38px; fill: currentColor;">
                    <path fill="currentColor" fill-rule="evenodd" d="M 82 -0.5 L 107 -0.5 L 108 0.5 L 109 0.5 L 110.5 2 L 110.5 3 L 112.5 5 L 112.5 7 L 113.5 8 L 113.5 11 L 114.5 12 L 114.5 14 L 115.5 15 L 115.5 17 L 116.5 18 L 116.5 20 L 117.5 21 L 117.5 23 L 118.5 24 L 118.5 26 L 119.5 27 L 119.5 29 L 120.5 30 L 120.5 32 L 121.5 33 L 121.5 35 L 122.5 36 L 122.5 38 L 123.5 39 L 123.5 41 L 124.5 42 L 124.5 44 L 125.5 45 L 125.5 47 L 126.5 48 L 126.5 51 L 127.5 52 L 127.5 54 L 128.5 55 L 128.5 57 L 129.5 58 L 129.5 60 L 130.5 61 L 130.5 63 L 131.5 64 L 131.5 66 L 132.5 67 L 132.5 69 L 133.5 70 L 133.5 72 L 134.5 73 L 134.5 75 L 135.5 76 L 135.5 78 L 136.5 79 L 136.5 81 L 137.5 82 L 137.5 84 L 138.5 85 L 138.5 87 L 139.5 88 L 139.5 90 L 140.5 91 L 140.5 94 L 141.5 95 L 141.5 97 L 142.5 98 L 142.5 100 L 143.5 101 L 143.5 103 L 144.5 104 L 144.5 106 L 145.5 107 L 145.5 109 L 146.5 110 L 146.5 112 L 147.5 113 L 147.5 115 L 148.5 116 L 148.5 118 L 149.5 119 L 149.5 121 L 150.5 122 L 150.5 129 L 150 129.5 L 149 129.5 L 148 130.5 L 120 130.5 L 116.5 127 L 116.5 125 L 115.5 124 L 115.5 122 L 114.5 121 L 114.5 119 L 113.5 118 L 113.5 116 L 112.5 115 L 112.5 113 L 111.5 112 L 111.5 110 L 110.5 109 L 110.5 107 L 109.5 106 L 109.5 104 L 108.5 103 L 108.5 101 L 107.5 100 L 107.5 98 L 106 96.5 L 92 96.5 L 90.5 95 L 90.5 93 L 89.5 92 L 89.5 90 L 88.5 89 L 88.5 87 L 87.5 86 L 87.5 84 L 86.5 83 L 86.5 81 L 85.5 80 L 85.5 78 L 84.5 77 L 84.5 75 L 83.5 74 L 83.5 72 L 82.5 71 L 83 70.5 L 98 70.5 L 98.5 70 L 98.5 69 L 97.5 68 L 97.5 66 L 96.5 65 L 96.5 63 L 95.5 62 L 95.5 59 L 94.5 58 L 94.5 56 L 93.5 55 L 93.5 53 L 92.5 52 L 92.5 50 L 91.5 49 L 91.5 47 L 90.5 46 L 90.5 44 L 89 42.5 L 87.5 44 L 87.5 45 L 85.5 47 L 85.5 48 L 83.5 50 L 83.5 51 L 81.5 53 L 81.5 54 L 79.5 56 L 79.5 57 L 79 57.5 L 78.5 57 L 78.5 56 L 77.5 55 L 77.5 53 L 76.5 52 L 76.5 50 L 75.5 49 L 75.5 47 L 74.5 46 L 74.5 44 L 73.5 43 L 73.5 41 L 72.5 40 L 72.5 38 L 71.5 37 L 71.5 35 L 70.5 34 L 70.5 31 L 69.5 30 L 69.5 28 L 68.5 27 L 68.5 25 L 67.5 24 L 67.5 22 L 66.5 21 L 66.5 19 L 68.5 17 L 68.5 16 L 70.5 14 L 70.5 13 L 72.5 11 L 72.5 10 L 75.5 7 L 75.5 6 L 77.5 4 L 77.5 3 L 80 0.5 L 81 0.5 Z M 116.5 0 L 117 -0.5 L 195 -0.5 L 195.5 0 L 195.5 2 L 196.5 3 L 196.5 5 L 197.5 6 L 197.5 8 L 198.5 9 L 198.5 11 L 199.5 12 L 199.5 14 L 200.5 15 L 200.5 17 L 201.5 18 L 201.5 20 L 202.5 21 L 202.5 23 L 203.5 24 L 203.5 26 L 204.5 27 L 204.5 29 L 205.5 30 L 205.5 32 L 206.5 33 L 206.5 35 L 207.5 36 L 207.5 38 L 208.5 39 L 208.5 41 L 209.5 42 L 209.5 44 L 210.5 45 L 210.5 48 L 211.5 49 L 211.5 51 L 212.5 52 L 212.5 54 L 213.5 55 L 213.5 57 L 214.5 58 L 213.5 59 L 213.5 60 L 212.5 61 L 212.5 62 L 211.5 63 L 211.5 64 L 209.5 66 L 209.5 67 L 200 76.5 L 199 76.5 L 198 77.5 L 197 77.5 L 194.5 80 L 194.5 81 L 195.5 82 L 195.5 84 L 196.5 85 L 196.5 87 L 197.5 88 L 197.5 90 L 198.5 91 L 198.5 94 L 199.5 95 L 199.5 97 L 200.5 98 L 200.5 100 L 201.5 101 L 201.5 103 L 202.5 104 L 202.5 106 L 203.5 107 L 203.5 110 L 204.5 111 L 204.5 113 L 205.5 114 L 205.5 116 L 206.5 117 L 206.5 119 L 207.5 120 L 207.5 122 L 208.5 123 L 208.5 128 L 206 130.5 L 177 130.5 L 176 129.5 L 174 129.5 L 172.5 128 L 172.5 126 L 171.5 125 L 171.5 123 L 170.5 122 L 170.5 120 L 169.5 119 L 169.5 117 L 168.5 116 L 168.5 113 L 167.5 112 L 167.5 110 L 166.5 109 L 166.5 107 L 165.5 106 L 165.5 107 L 164.5 103 L 164.5 101 L 163.5 100 L 163.5 97 L 162.5 96 L 162.5 94 L 161.5 93 L 161.5 91 L 160.5 90 L 160.5 88 L 159.5 87 L 159.5 84 L 158 82.5 L 144 82.5 L 142.5 81 L 142.5 79 L 141.5 78 L 141.5 76 L 140.5 75 L 140.5 73 L 139.5 72 L 139.5 70 L 138.5 69 L 138.5 67 L 137.5 66 L 137.5 64 L 136.5 63 L 136.5 61 L 135.5 60 L 135.5 58 L 134.5 57 L 134.5 55 L 135 54.5 L 180 54.5 L 180.5 54 L 179.5 53 L 179.5 51 L 178.5 50 L 178.5 47 L 177.5 46 L 177.5 44 L 176.5 43 L 176.5 41 L 175.5 40 L 175.5 38 L 174.5 37 L 174.5 35 L 173.5 34 L 173.5 32 L 172.5 31 L 172.5 29 L 171.5 28 L 171.5 27 L 171 26.5 L 125 26.5 L 124.5 26 L 124.5 24 L 123.5 23 L 123.5 21 L 122.5 20 L 122.5 17 L 121.5 16 L 121.5 14 L 120.5 13 L 120.5 11 L 119.5 10 L 119.5 8 L 118.5 7 L 118.5 5 L 117.5 4 L 117.5 2 L 116.5 1 Z M 201.5 0 L 202 -0.5 L 260 -0.5 L 261 0.5 L 263 0.5 L 265.5 3 L 265.5 4 L 266.5 5 L 266.5 8 L 267.5 9 L 267.5 14 L 268.5 15 L 268.5 20 L 269.5 21 L 269.5 23 L 268.5 24 L 268.5 25 L 266 27.5 L 211 27.5 L 209.5 26 L 209.5 24 L 208.5 23 L 208.5 21 L 207.5 20 L 207.5 18 L 206.5 17 L 206.5 15 L 205.5 14 L 205.5 12 L 204.5 11 L 204.5 9 L 203.5 8 L 203.5 6 L 202.5 5 L 202.5 3 L 201.5 2 Z M 62 26.5 L 63.5 28 L 63.5 30 L 64.5 31 L 64.5 33 L 65.5 34 L 65.5 36 L 66.5 37 L 66.5 39 L 67.5 40 L 67.5 42 L 68.5 43 L 68.5 45 L 69.5 46 L 69.5 49 L 70.5 50 L 70.5 52 L 71.5 53 L 71.5 55 L 72.5 56 L 72.5 58 L 73.5 59 L 73.5 61 L 74.5 62 L 74.5 65 L 72.5 67 L 72.5 68 L 70.5 70 L 70.5 71 L 69.5 72 L 69.5 73 L 67.5 75 L 67.5 76 L 65.5 78 L 65.5 79 L 64.5 80 L 64.5 81 L 62.5 83 L 62.5 84 L 61.5 85 L 61.5 86 L 59.5 88 L 59.5 89 L 57.5 91 L 57.5 92 L 56.5 93 L 56.5 94 L 54.5 96 L 54.5 97 L 53.5 98 L 53.5 99 L 51.5 101 L 51.5 102 L 50.5 103 L 50.5 104 L 48.5 106 L 48.5 107 L 46.5 109 L 46.5 110 L 45.5 111 L 45.5 112 L 43.5 114 L 43.5 115 L 42.5 116 L 42.5 117 L 40.5 119 L 40.5 120 L 38.5 122 L 38.5 123 L 37.5 124 L 37.5 125 L 33 129.5 L 32 129.5 L 31 130.5 L 3 130.5 L -0.5 127 L -0.5 125 L 0.5 124 L 0.5 123 L 1.5 122 L 1.5 121 L 2.5 120 L 2.5 119 L 4.5 117 L 4.5 116 L 6.5 114 L 6.5 113 L 8.5 111 L 8.5 110 L 9.5 109 L 9.5 108 L 11.5 106 L 11.5 105 L 13.5 103 L 13.5 102 L 15.5 100 L 15.5 99 L 16.5 98 L 16.5 97 L 18.5 95 L 18.5 94 L 20.5 92 L 20.5 91 L 22.5 89 L 22.5 88 L 23.5 87 L 23.5 86 L 25.5 84 L 25.5 83 L 27.5 81 L 27.5 80 L 29.5 78 L 29.5 77 L 30.5 76 L 30.5 75 L 32.5 73 L 32.5 72 L 34.5 70 L 34.5 69 L 36.5 67 L 36.5 66 L 37.5 65 L 37.5 64 L 39.5 62 L 39.5 61 L 41.5 59 L 41.5 58 L 43.5 56 L 43.5 55 L 44.5 54 L 44.5 53 L 46.5 51 L 46.5 50 L 48.5 48 L 48.5 47 L 50.5 45 L 50.5 44 L 51.5 43 L 51.5 42 L 53.5 40 L 53.5 39 L 55.5 37 L 55.5 36 L 57.5 34 L 57.5 33 L 58.5 32 L 58.5 31 L 60.5 29 L 60.5 28 Z M 220.5 52 L 221 51.5 L 221.5 52 L 221.5 53 L 222.5 54 L 222.5 56 L 223.5 57 L 223.5 59 L 224.5 60 L 224.5 62 L 225.5 63 L 225.5 65 L 226.5 66 L 226.5 68 L 226.5 68 L 227.5 69 L 227.5 72 L 228.5 73 L 228.5 75 L 229.5 76 L 229.5 78 L 230.5 79 L 230.5 81 L 231.5 82 L 231.5 84 L 232.5 85 L 232.5 87 L 233.5 88 L 233.5 90 L 234.5 91 L 234.5 93 L 235.5 94 L 235.5 96 L 236.5 97 L 236.5 100 L 237 100.5 L 290 100.5 L 291 101.5 L 292 101.5 L 292.5 102 L 292.5 103 L 294.5 105 L 294.5 106 L 295.5 107 L 295.5 111 L 296.5 112 L 296.5 115 L 297.5 116 L 297.5 119 L 298.5 120 L 298.5 123 L 299.5 124 L 299.5 126 L 298.5 127 L 298.5 128 L 297 129.5 L 296 129.5 L 295 130.5 L 218 130.5 L 217 129.5 L 216 129.5 L 214.5 128 L 214.5 127 L 213.5 126 L 213.5 123 L 212.5 122 L 212.5 120 L 211.5 119 L 211.5 117 L 210.5 116 L 210.5 114 L 209.5 113 L 209.5 111 L 208.5 110 L 208.5 108 L 207.5 107 L 207.5 105 L 206.5 104 L 206.5 101 L 205.5 100 L 205.5 98 L 204.5 97 L 204.5 95 L 203.5 94 L 203.5 91 L 202.5 90 L 202.5 88 L 201.5 87 L 201.5 85 L 200.5 84 L 200.5 80 L 201 79.5 L 202 79.5 L 204 77.5 L 205 77.5 L 212.5 70 L 212.5 69 L 214.5 67 L 214.5 66 L 215.5 65 L 215.5 64 L 216.5 63 L 216.5 62 L 217.5 61 L 217.5 60 L 218.5 59 L 218.5 58 L 219.5 57 L 219.5 55 L 220.5 54 Z" />
                </svg>
                </div>
                <h2 class="auth-title">Create Account</h2>
                <p class="text-muted" style="font-size:0.85rem; font-weight:500;">Register to start tracking your performance.</p>
            </div>

            <?php if (!empty($error)) { ?>
                <div class="auth-error">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php } ?>

            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="e.g. John Doe" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-input" placeholder="e.g. jdoe" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-orange" style="width:100%; padding:14px; font-size:0.9rem; margin-top: 10px;">
                    <i class="fa-solid fa-user-plus"></i> Register
                </button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="login.php">Log In</a>
            </div>
        </div>
    </div>

</body>
</html>
