<?php
session_start();
require_once 'db.php';
$isLoggedIn = isset($_SESSION['gym_user_id']);
$userName = $isLoggedIn ? $_SESSION['gym_user_name'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARC Gym | Elite Training & Workout Tracker</title>
    
    <!-- Meta tags for SEO -->
    <meta name="description" content="Welcome to ARC Gym. Redefine your limits, track your progress daily, set your workouts, and join our elite community. NO PAIN, NO GAIN.">
    <meta name="keywords" content="Gym, Workout Tracker, ARC, Fitness, Exercises, Calendar log, Progress chart, Weights logging">
    
    <!-- FontAwesome for Premium Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Chart.js for Progression Graph -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jsPDF Library for Weekly Report Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    
    <script>
        const USER_SESSION = {
            isLoggedIn: <?php echo $isLoggedIn ? 'true' : 'false'; ?>,
            name: <?php echo json_encode($userName); ?>
        };
    </script>
    <style>
        .locked-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(244, 244, 246, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            border-radius: 24px;
        }
        .locked-content {
            text-align: center;
            background-color: var(--white);
            padding: 40px;
            border-radius: 24px;
            border: 1px solid var(--grey-200);
            box-shadow: 0 20px 50px rgba(0,0,0,0.06);
            max-width: 380px;
        }
        .user-greeting {
            font-family: var(--font-display);
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: var(--dark);
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="header-container">
            <!-- Stylized ARC SVG Logo -->
            <a href="index.php" class="brand-logo" id="header-logo-link">
                <svg class="brand-logo-svg" viewBox="0 0 300 131" style="height: 38px; fill: currentColor;">
                    <path fill="currentColor" fill-rule="evenodd" d="M 82 -0.5 L 107 -0.5 L 108 0.5 L 109 0.5 L 110.5 2 L 110.5 3 L 112.5 5 L 112.5 7 L 113.5 8 L 113.5 11 L 114.5 12 L 114.5 14 L 115.5 15 L 115.5 17 L 116.5 18 L 116.5 20 L 117.5 21 L 117.5 23 L 118.5 24 L 118.5 26 L 119.5 27 L 119.5 29 L 120.5 30 L 120.5 32 L 121.5 33 L 121.5 35 L 122.5 36 L 122.5 38 L 123.5 39 L 123.5 41 L 124.5 42 L 124.5 44 L 125.5 45 L 125.5 47 L 126.5 48 L 126.5 51 L 127.5 52 L 127.5 54 L 128.5 55 L 128.5 57 L 129.5 58 L 129.5 60 L 130.5 61 L 130.5 63 L 131.5 64 L 131.5 66 L 132.5 67 L 132.5 69 L 133.5 70 L 133.5 72 L 134.5 73 L 134.5 75 L 135.5 76 L 135.5 78 L 136.5 79 L 136.5 81 L 137.5 82 L 137.5 84 L 138.5 85 L 138.5 87 L 139.5 88 L 139.5 90 L 140.5 91 L 140.5 94 L 141.5 95 L 141.5 97 L 142.5 98 L 142.5 100 L 143.5 101 L 143.5 103 L 144.5 104 L 144.5 106 L 145.5 107 L 145.5 109 L 146.5 110 L 146.5 112 L 147.5 113 L 147.5 115 L 148.5 116 L 148.5 118 L 149.5 119 L 149.5 121 L 150.5 122 L 150.5 129 L 150 129.5 L 149 129.5 L 148 130.5 L 120 130.5 L 116.5 127 L 116.5 125 L 115.5 124 L 115.5 122 L 114.5 121 L 114.5 119 L 113.5 118 L 113.5 116 L 112.5 115 L 112.5 113 L 111.5 112 L 111.5 110 L 110.5 109 L 110.5 107 L 109.5 106 L 109.5 104 L 108.5 103 L 108.5 101 L 107.5 100 L 107.5 98 L 106 96.5 L 92 96.5 L 90.5 95 L 90.5 93 L 89.5 92 L 89.5 90 L 88.5 89 L 88.5 87 L 87.5 86 L 87.5 84 L 86.5 83 L 86.5 81 L 85.5 80 L 85.5 78 L 84.5 77 L 84.5 75 L 83.5 74 L 83.5 72 L 82.5 71 L 83 70.5 L 98 70.5 L 98.5 70 L 98.5 69 L 97.5 68 L 97.5 66 L 96.5 65 L 96.5 63 L 95.5 62 L 95.5 59 L 94.5 58 L 94.5 56 L 93.5 55 L 93.5 53 L 92.5 52 L 92.5 50 L 91.5 49 L 91.5 47 L 90.5 46 L 90.5 44 L 89 42.5 L 87.5 44 L 87.5 45 L 85.5 47 L 85.5 48 L 83.5 50 L 83.5 51 L 81.5 53 L 81.5 54 L 79.5 56 L 79.5 57 L 79 57.5 L 78.5 57 L 78.5 56 L 77.5 55 L 77.5 53 L 76.5 52 L 76.5 50 L 75.5 49 L 75.5 47 L 74.5 46 L 74.5 44 L 73.5 43 L 73.5 41 L 72.5 40 L 72.5 38 L 71.5 37 L 71.5 35 L 70.5 34 L 70.5 31 L 69.5 30 L 69.5 28 L 68.5 27 L 68.5 25 L 67.5 24 L 67.5 22 L 66.5 21 L 66.5 19 L 68.5 17 L 68.5 16 L 70.5 14 L 70.5 13 L 72.5 11 L 72.5 10 L 75.5 7 L 75.5 6 L 77.5 4 L 77.5 3 L 80 0.5 L 81 0.5 Z M 116.5 0 L 117 -0.5 L 195 -0.5 L 195.5 0 L 195.5 2 L 196.5 3 L 196.5 5 L 197.5 6 L 197.5 8 L 198.5 9 L 198.5 11 L 199.5 12 L 199.5 14 L 200.5 15 L 200.5 17 L 201.5 18 L 201.5 20 L 202.5 21 L 202.5 23 L 203.5 24 L 203.5 26 L 204.5 27 L 204.5 29 L 205.5 30 L 205.5 32 L 206.5 33 L 206.5 35 L 207.5 36 L 207.5 38 L 208.5 39 L 208.5 41 L 209.5 42 L 209.5 44 L 210.5 45 L 210.5 48 L 211.5 49 L 211.5 51 L 212.5 52 L 212.5 54 L 213.5 55 L 213.5 57 L 214.5 58 L 213.5 59 L 213.5 60 L 212.5 61 L 212.5 62 L 211.5 63 L 211.5 64 L 209.5 66 L 209.5 67 L 200 76.5 L 199 76.5 L 198 77.5 L 197 77.5 L 194.5 80 L 194.5 81 L 195.5 82 L 195.5 84 L 196.5 85 L 196.5 87 L 197.5 88 L 197.5 90 L 198.5 91 L 198.5 94 L 199.5 95 L 199.5 97 L 200.5 98 L 200.5 100 L 201.5 101 L 201.5 103 L 202.5 104 L 202.5 106 L 203.5 107 L 203.5 110 L 204.5 111 L 204.5 113 L 205.5 114 L 205.5 116 L 206.5 117 L 206.5 119 L 207.5 120 L 207.5 122 L 208.5 123 L 208.5 128 L 206 130.5 L 177 130.5 L 176 129.5 L 174 129.5 L 172.5 128 L 172.5 126 L 171.5 125 L 171.5 123 L 170.5 122 L 170.5 120 L 169.5 119 L 169.5 117 L 168.5 116 L 168.5 113 L 167.5 112 L 167.5 110 L 166.5 109 L 166.5 107 L 165.5 106 L 165.5 107 L 164.5 103 L 164.5 101 L 163.5 100 L 163.5 97 L 162.5 96 L 162.5 94 L 161.5 93 L 161.5 91 L 160.5 90 L 160.5 88 L 159.5 87 L 159.5 84 L 158 82.5 L 144 82.5 L 142.5 81 L 142.5 79 L 141.5 78 L 141.5 76 L 140.5 75 L 140.5 73 L 139.5 72 L 139.5 70 L 138.5 69 L 138.5 67 L 137.5 66 L 137.5 64 L 136.5 63 L 136.5 61 L 135.5 60 L 135.5 58 L 134.5 57 L 134.5 55 L 135 54.5 L 180 54.5 L 180.5 54 L 179.5 53 L 179.5 51 L 178.5 50 L 178.5 47 L 177.5 46 L 177.5 44 L 176.5 43 L 176.5 41 L 175.5 40 L 175.5 38 L 174.5 37 L 174.5 35 L 173.5 34 L 173.5 32 L 172.5 31 L 172.5 29 L 171.5 28 L 171.5 27 L 171 26.5 L 125 26.5 L 124.5 26 L 124.5 24 L 123.5 23 L 123.5 21 L 122.5 20 L 122.5 17 L 121.5 16 L 121.5 14 L 120.5 13 L 120.5 11 L 119.5 10 L 119.5 8 L 118.5 7 L 118.5 5 L 117.5 4 L 117.5 2 L 116.5 1 Z M 201.5 0 L 202 -0.5 L 260 -0.5 L 261 0.5 L 263 0.5 L 265.5 3 L 265.5 4 L 266.5 5 L 266.5 8 L 267.5 9 L 267.5 14 L 268.5 15 L 268.5 20 L 269.5 21 L 269.5 23 L 268.5 24 L 268.5 25 L 266 27.5 L 211 27.5 L 209.5 26 L 209.5 24 L 208.5 23 L 208.5 21 L 207.5 20 L 207.5 18 L 206.5 17 L 206.5 15 L 205.5 14 L 205.5 12 L 204.5 11 L 204.5 9 L 203.5 8 L 203.5 6 L 202.5 5 L 202.5 3 L 201.5 2 Z M 62 26.5 L 63.5 28 L 63.5 30 L 64.5 31 L 64.5 33 L 65.5 34 L 65.5 36 L 66.5 37 L 66.5 39 L 67.5 40 L 67.5 42 L 68.5 43 L 68.5 45 L 69.5 46 L 69.5 49 L 70.5 50 L 70.5 52 L 71.5 53 L 71.5 55 L 72.5 56 L 72.5 58 L 73.5 59 L 73.5 61 L 74.5 62 L 74.5 65 L 72.5 67 L 72.5 68 L 70.5 70 L 70.5 71 L 69.5 72 L 69.5 73 L 67.5 75 L 67.5 76 L 65.5 78 L 65.5 79 L 64.5 80 L 64.5 81 L 62.5 83 L 62.5 84 L 61.5 85 L 61.5 86 L 59.5 88 L 59.5 89 L 57.5 91 L 57.5 92 L 56.5 93 L 56.5 94 L 54.5 96 L 54.5 97 L 53.5 98 L 53.5 99 L 51.5 101 L 51.5 102 L 50.5 103 L 50.5 104 L 48.5 106 L 48.5 107 L 46.5 109 L 46.5 110 L 45.5 111 L 45.5 112 L 43.5 114 L 43.5 115 L 42.5 116 L 42.5 117 L 40.5 119 L 40.5 120 L 38.5 122 L 38.5 123 L 37.5 124 L 37.5 125 L 33 129.5 L 32 129.5 L 31 130.5 L 3 130.5 L -0.5 127 L -0.5 125 L 0.5 124 L 0.5 123 L 1.5 122 L 1.5 121 L 2.5 120 L 2.5 119 L 4.5 117 L 4.5 116 L 6.5 114 L 6.5 113 L 8.5 111 L 8.5 110 L 9.5 109 L 9.5 108 L 11.5 106 L 11.5 105 L 13.5 103 L 13.5 102 L 15.5 100 L 15.5 99 L 16.5 98 L 16.5 97 L 18.5 95 L 18.5 94 L 20.5 92 L 20.5 91 L 22.5 89 L 22.5 88 L 23.5 87 L 23.5 86 L 25.5 84 L 25.5 83 L 27.5 81 L 27.5 80 L 29.5 78 L 29.5 77 L 30.5 76 L 30.5 75 L 32.5 73 L 32.5 72 L 34.5 70 L 34.5 69 L 36.5 67 L 36.5 66 L 37.5 65 L 37.5 64 L 39.5 62 L 39.5 61 L 41.5 59 L 41.5 58 L 43.5 56 L 43.5 55 L 44.5 54 L 44.5 53 L 46.5 51 L 46.5 50 L 48.5 48 L 48.5 47 L 50.5 45 L 50.5 44 L 51.5 43 L 51.5 42 L 53.5 40 L 53.5 39 L 55.5 37 L 55.5 36 L 57.5 34 L 57.5 33 L 58.5 32 L 58.5 31 L 60.5 29 L 60.5 28 Z M 220.5 52 L 221 51.5 L 221.5 52 L 221.5 53 L 222.5 54 L 222.5 56 L 223.5 57 L 223.5 59 L 224.5 60 L 224.5 62 L 225.5 63 L 225.5 65 L 226.5 66 L 226.5 68 L 226.5 68 L 227.5 69 L 227.5 72 L 228.5 73 L 228.5 75 L 229.5 76 L 229.5 78 L 230.5 79 L 230.5 81 L 231.5 82 L 231.5 84 L 232.5 85 L 232.5 87 L 233.5 88 L 233.5 90 L 234.5 91 L 234.5 93 L 235.5 94 L 235.5 96 L 236.5 97 L 236.5 100 L 237 100.5 L 290 100.5 L 291 101.5 L 292 101.5 L 292.5 102 L 292.5 103 L 294.5 105 L 294.5 106 L 295.5 107 L 295.5 111 L 296.5 112 L 296.5 115 L 297.5 116 L 297.5 119 L 298.5 120 L 298.5 123 L 299.5 124 L 299.5 126 L 298.5 127 L 298.5 128 L 297 129.5 L 296 129.5 L 295 130.5 L 218 130.5 L 217 129.5 L 216 129.5 L 214.5 128 L 214.5 127 L 213.5 126 L 213.5 123 L 212.5 122 L 212.5 120 L 211.5 119 L 211.5 117 L 210.5 116 L 210.5 114 L 209.5 113 L 209.5 111 L 208.5 110 L 208.5 108 L 207.5 107 L 207.5 105 L 206.5 104 L 206.5 101 L 205.5 100 L 205.5 98 L 204.5 97 L 204.5 95 L 203.5 94 L 203.5 91 L 202.5 90 L 202.5 88 L 201.5 87 L 201.5 85 L 200.5 84 L 200.5 80 L 201 79.5 L 202 79.5 L 204 77.5 L 205 77.5 L 212.5 70 L 212.5 69 L 214.5 67 L 214.5 66 L 215.5 65 L 215.5 64 L 216.5 63 L 216.5 62 L 217.5 61 L 217.5 60 L 218.5 59 L 218.5 58 L 219.5 57 L 219.5 55 L 220.5 54 Z" />
                </svg>
            </a>
            
            <nav>
                <ul class="nav-links">
                    <li><a href="#home" class="nav-link active">Home</a></li>
                    <li><a href="#workout-tracker" class="nav-link">Workout Tracker</a></li>
                    <li><a href="#progression" class="nav-link">Progression</a></li>
                    <li><a href="#workout-plan" class="nav-link">Workout Plan</a></li>
                </ul>
            </nav>
            
            <div style="display:flex; align-items:center; gap:15px;">
                <?php if ($isLoggedIn) { ?>
                    <span class="user-greeting">Hello, <span class="text-orange"><?php echo htmlspecialchars($userName); ?></span></span>
                    <a href="logout.php" class="btn-contact" style="background-color: var(--dark); color: var(--white); border-color: var(--dark);">Logout</a>
                <?php } else { ?>
                    <a href="login.php" class="btn-contact">Login</a>
                <?php } ?>
            </div>
        </div>
    </header>

    <main>
        
        <!-- Hero Section -->
        <section id="home" class="hero">
            <div class="hero-container">
                <div class="hero-content">
                    <span class="hero-subtitle">WELCOME TO ARC GYM</span>
                    <h1 class="hero-title">
                        <span>NO PAIN</span>
                        <span class="text-orange">NO GAIN</span>
                    </h1>
                    <p class="hero-desc">
                        An immersive fitness and tracking destination. Plot your schedule, record your lift history, and analyze your progression over time with our custom dashboard.
                    </p>
                    <div class="hero-actions">
                        <a href="#workout-tracker" class="btn btn-orange" id="hero-start-btn">Start Tracking</a>
                        <a href="#workout-plan" class="btn btn-outline" id="hero-discover-btn">Workout Plan</a>
                    </div>
                </div>
                
                <div class="hero-image-wrapper">
                    <div class="hero-image-bg"></div>
                    <img src="assets/images/hero_bodybuilder.jpg" alt="Bodybuilder lifting heavy weights" class="hero-img">
                    
                    <!-- Stats Badge Overlay -->
                    <div class="stats-badge">
                        <div class="stats-text">
                            <h5>Welcome</h5>
                            <!-- <p>Active Members</p> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Step node divider -->
        <section class="steps-divider-container">
            <h2 class="section-title">COME TO A RESULT WITH US</h2>
            <div class="steps-flow">
                <div class="step-node">
                    <div class="step-circle active"><i class="fa-solid fa-bullseye"></i></div>
                    <span class="step-label">1. Set Goals</span>
                </div>
                <div class="step-node">
                    <div class="step-circle"><i class="fa-solid fa-dumbbell"></i></div>
                    <span class="step-label">2. Log Workouts</span>
                </div>
                <div class="step-node">
                    <div class="step-circle"><i class="fa-solid fa-bed"></i></div>
                    <span class="step-label">3. Rest & Recover</span>
                </div>
                <div class="step-node">
                    <div class="step-circle"><i class="fa-solid fa-chart-line"></i></div>
                    <span class="step-label">4. Track Progress</span>
                </div>
            </div>
        </section>

        <!-- Coaches Section -->
        <section id="coaches" class="coaches">
            <div class="coaches-container">
                <div class="coaches-image">
                    <img src="assets/images/coaches.jpg" alt="ARC Fitness Coaches Team" class="coaches-img">
                </div>
                <div class="coaches-content">
                    <span class="section-subtitle">ARE YOU LOOKING FOR A MENTOR?</span>
                    <h2 class="section-title">OUR COACHES</h2>
                    <p class="coaches-desc">
                        Our battle-tested personal trainers and fitness experts are devoted to helping you reach your peak performance. Whether your goal is to gain lean mass, shed fat, or build athletic power, we design structured tracks tailored for you.
                    </p>
                </div>
            </div>
        </section>

        <!-- Workout Tracker Section (Dashboard) -->
        <section id="workout-tracker" class="workout-tracker" style="position: relative;">
            <?php if (!$isLoggedIn) { ?>
                <div class="locked-overlay">
                    <div class="locked-content">
                        <i class="fa-solid fa-lock" style="font-size: 2.8rem; color: var(--primary); margin-bottom: 20px;"></i>
                        <h3 style="font-weight: 800; font-size: 1.3rem; margin-bottom: 10px;">Tracker Locked</h3>
                        <p class="text-muted" style="font-size: 0.85rem; margin-bottom: 25px; font-weight: 500;">Create an account or log in to track your exercises, weights, and daily records.</p>
                        <div style="display:flex; gap:10px; justify-content:center;">
                            <a href="login.php" class="btn btn-sm btn-dark" style="padding: 10px 20px;">Log In</a>
                            <a href="register.php" class="btn btn-sm btn-orange" style="padding: 10px 20px;">Sign Up</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="tracker-container">
                <div class="section-header">
                    <span class="section-subtitle">DASHBOARD</span>
                    <h2 class="section-title">DAILY WORKOUT TRACKER</h2>
                </div>
                
                <div class="dashboard-grid">
                    <!-- Left Sidebar Panel -->
                    <div class="sidebar-panel">
                        
                        <!-- Monthly Calendar -->
                        <div class="panel-card">
                            <div class="calendar-header">
                                <h4 id="calendar-month-year">August 2026</h4>
                                <div style="display: flex; gap: 5px;">
                                    <button class="calendar-nav-btn" id="prev-month-btn"><i class="fa-solid fa-chevron-left"></i></button>
                                    <button class="calendar-nav-btn" id="next-month-btn"><i class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="calendar-grid">
                                <div class="calendar-day-label">Su</div>
                                <div class="calendar-day-label">Mo</div>
                                <div class="calendar-day-label">Tu</div>
                                <div class="calendar-day-label">We</div>
                                <div class="calendar-day-label">Th</div>
                                <div class="calendar-day-label">Fr</div>
                                <div class="calendar-day-label">Sa</div>
                            </div>
                            <div class="calendar-grid" id="calendar-days">
                                <!-- Calendar days injected here -->
                            </div>
                        </div>

                        <!-- Stats and Streaks -->
                        <div class="panel-card">
                            <h4 class="panel-title"><i class="fa-solid fa-fire text-orange"></i> Your Streaks</h4>
                            <div class="streak-display">
                                <div class="streak-box">
                                    <h5>Current Streak</h5>
                                    <div class="number text-orange" id="current-streak-val">0 Days</div>
                                </div>
                                <div class="streak-box">
                                    <h5>Total Sessions</h5>
                                    <div class="number" id="total-sessions-val">0</div>
                                </div>
                            </div>
                        </div>

                        <!-- Body Weight Logger -->
                        <div class="panel-card">
                            <h4 class="panel-title"><i class="fa-solid fa-scale-balanced text-orange"></i> Body Weight</h4>
                            <div class="weight-logger-flex">
                                <input type="number" id="daily-weight-input" placeholder="e.g. 78.5" step="any">
                                <span>kg</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Workout Logger Panel -->
                    <div class="workout-logger-panel">
                        <div class="logger-header">
                            <div class="logger-header-left">
                                <h3 class="selected-date-title" id="selected-date-title">Saturday, August 8, 2026</h3>
                                <div class="routine-focus-badge" id="routine-focus">
                                    <span class="focus-badge">Focus</span> Strength (Deadlift) + Balance + Core
                                </div>
                            </div>
                            <div class="logger-header-right">
                                <div class="routine-select-wrapper">
                                    <label for="routine-selector">Active Routine</label>
                                    <select class="routine-select" id="routine-selector">
                                        <option value="1">Day 1: Chest + Shoulders + Triceps</option>
                                        <option value="2">Day 2: Back + Biceps + Forearms</option>
                                        <option value="3">Day 3: Full Legs + Core</option>
                                        <option value="4">Day 4: Chest + Shoulders</option>
                                        <option value="5">Day 5: Full Arms</option>
                                        <option value="6">Day 6: Back + Legs + Core</option>
                                        <option value="0">Day 7: Rest Day</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Exercises Container -->
                        <div class="exercises-container" id="exercises-container">
                            <!-- Exercise cards injected by app.js -->
                        </div>

                        <!-- Logging notes -->
                        <div class="workout-notes-area">
                            <label for="workout-notes">Workout Session Notes</label>
                            <textarea id="workout-notes" placeholder="How did you feel? Note down sets, energy, or diet metrics..."></textarea>
                        </div>

                        <!-- Action buttons -->
                        <div class="logger-footer">
                            <button type="button" class="btn btn-outline" id="add-custom-ex-btn"><i class="fa-solid fa-plus-circle"></i> Add Custom Exercise</button>
                            <div class="logger-footer-actions">
                                <button type="button" class="btn btn-outline-danger" id="clear-workout-btn"><i class="fa-solid fa-trash-can"></i> Reset Day</button>
                                <button type="button" class="btn btn-orange" id="save-workout-btn"><i class="fa-solid fa-floppy-disk"></i> Save Workout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Progression & Analytics Charts -->
        <section id="progression" class="progression" style="position: relative;">
            <?php if (!$isLoggedIn) { ?>
                <div class="locked-overlay">
                    <div class="locked-content">
                        <i class="fa-solid fa-lock" style="font-size: 2.8rem; color: var(--primary); margin-bottom: 20px;"></i>
                        <h3 style="font-weight: 800; font-size: 1.3rem; margin-bottom: 10px;">Analytics Locked</h3>
                        <p class="text-muted" style="font-size: 0.85rem; margin-bottom: 25px; font-weight: 500;">Progression charts and weight tracking trends require a user session.</p>
                        <div style="display:flex; gap:10px; justify-content:center;">
                            <a href="login.php" class="btn btn-sm btn-dark" style="padding: 10px 20px;">Log In</a>
                            <a href="register.php" class="btn btn-sm btn-orange" style="padding: 10px 20px;">Sign Up</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="progression-container">
                <div class="section-header">
                    <span class="section-subtitle">ANALYTICS</span>
                    <h2 class="section-title">PROGRESSION METRICS</h2>
                </div>
                
                <div class="analytics-grid">
                    <!-- Exercise Progression Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h4 class="panel-title" style="margin-bottom:0; border:none; padding:0;"><i class="fa-solid fa-chart-line text-orange"></i> Lift Progression</h4>
                            <div class="chart-selector-wrapper">
                                <label for="analytics-exercise-selector" style="font-size:0.8rem; font-weight:800; text-transform:uppercase;">Select Lift:</label>
                                <select id="analytics-exercise-selector">
                                    <!-- Populated dynamically -->
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="progression-chart"></canvas>
                        </div>
                    </div>

                    <!-- Body Weight Chart & Backup Tools -->
                    <div style="display:flex; flex-direction:column; gap:25px;">
                        <div class="chart-card">
                            <h4 class="panel-title"><i class="fa-solid fa-weight-scale text-orange"></i> Body Weight Log</h4>
                            <div class="chart-container" style="height: 180px;">
                                <canvas id="weight-chart"></canvas>
                            </div>
                        </div>

                        <!-- Data Backup Panel -->
                        <div class="chart-card">
                            <h4 class="panel-title"><i class="fa-solid fa-database text-orange"></i> Backup & Export</h4>
                            <p class="text-muted" style="font-size:0.85rem; margin-bottom:15px; font-weight:500;">
                                Export your logs as JSON/PDF, or restore your backup file.
                            </p>
                            <div style="display:flex; flex-direction:column; gap:10px;">
                                <div style="display:flex; gap:10px;">
                                    <button type="button" class="btn btn-sm btn-outline" id="backup-export-btn" style="flex-grow:1;"><i class="fa-solid fa-download"></i> Export JSON</button>
                                    <button type="button" class="btn btn-sm btn-dark" id="backup-import-btn" style="flex-grow:1;"><i class="fa-solid fa-upload"></i> Import JSON</button>
                                </div>
                                <button type="button" class="btn btn-sm btn-orange" id="pdf-report-btn" style="width:100%;"><i class="fa-solid fa-file-pdf"></i> Export Weekly PDF Report</button>
                                <input type="file" id="backup-import-input" accept=".json" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Workout Plan Editor Section -->
        <section id="workout-plan" class="workout-plan" style="position: relative; padding: 100px 24px; background-color: var(--light-bg); border-top: 1px solid var(--grey-200);">
            <?php if (!$isLoggedIn) { ?>
                <div class="locked-overlay">
                    <div class="locked-content">
                        <i class="fa-solid fa-lock" style="font-size: 2.8rem; color: var(--primary); margin-bottom: 20px;"></i>
                        <h3 style="font-weight: 800; font-size: 1.3rem; margin-bottom: 10px;">Editor Locked</h3>
                        <p class="text-muted" style="font-size: 0.85rem; margin-bottom: 25px; font-weight: 500;">To customize and save your personal training routines, please log in.</p>
                        <div style="display:flex; gap:10px; justify-content:center;">
                            <a href="login.php" class="btn btn-sm btn-dark" style="padding: 10px 20px;">Log In</a>
                            <a href="register.php" class="btn btn-sm btn-orange" style="padding: 10px 20px;">Sign Up</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="tracker-container" style="max-width: 1200px; margin: 0 auto;">
                <div class="section-header">
                    <span class="section-subtitle">CUSTOMIZATION</span>
                    <h2 class="section-title">WORKOUT PLAN EDITOR</h2>
                </div>
                
                <div class="dashboard-grid" style="grid-template-columns: 1.2fr 1fr;">
                    <!-- Left Column: Active Routine Editor -->
                    <div class="workout-logger-panel" style="padding: 24px;">
                        <h4 class="panel-title" style="margin-bottom: 20px;"><i class="fa-solid fa-pen-to-square text-orange"></i> Edit Routine</h4>
                        
                        <!-- Weekdays Tabs Selector -->
                        <div style="display: flex; gap: 8px; margin-bottom: 20px; overflow-x: auto; padding-bottom: 10px;" id="plan-day-tabs">
                            <button type="button" class="btn btn-sm btn-dark active" data-day="1">Day 1</button>
                            <button type="button" class="btn btn-sm btn-outline" data-day="2">Day 2</button>
                            <button type="button" class="btn btn-sm btn-outline" data-day="3">Day 3</button>
                            <button type="button" class="btn btn-sm btn-outline" data-day="4">Day 4</button>
                            <button type="button" class="btn btn-sm btn-outline" data-day="5">Day 5</button>
                            <button type="button" class="btn btn-sm btn-outline" data-day="6">Day 6</button>
                        </div>
                        
                        <!-- Routine Header Inputs -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                            <div>
                                <label style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--grey-600); display: block; margin-bottom: 6px;">Routine Name</label>
                                <input type="text" id="plan-routine-name" class="routine-select" style="width: 100%;" placeholder="e.g. Chest + Shoulders">
                            </div>
                            <div>
                                <label style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--grey-600); display: block; margin-bottom: 6px;">Routine Focus</label>
                                <input type="text" id="plan-routine-focus" class="routine-select" style="width: 100%;" placeholder="e.g. Mind-Muscle Connection">
                            </div>
                        </div>

                        <!-- Active Exercises Reorder List -->
                        <div style="margin-bottom: 20px;">
                            <label style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--grey-600); display: block; margin-bottom: 10px;">Exercises in Routine</label>
                            <div id="plan-exercises-list" style="display: flex; flex-direction: column; gap: 10px;">
                                <!-- Dynamically loaded exercises to edit -->
                            </div>
                        </div>
                        
                        <div style="text-align: right; border-top: 1px solid var(--grey-200); padding-top: 20px;">
                            <button type="button" class="btn btn-orange" id="save-plan-btn"><i class="fa-solid fa-floppy-disk"></i> Save Workout Plan</button>
                        </div>
                    </div>

                    <!-- Right Column: Exercise Library Finder -->
                    <div class="workout-logger-panel" style="padding: 24px; display: flex; flex-direction: column; gap: 20px;">
                        <h4 class="panel-title" style="margin-bottom: 0;"><i class="fa-solid fa-search text-orange"></i> Exercise Library</h4>
                        
                        <!-- Search & Filter Controls -->
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <input type="text" id="library-search" class="routine-select" style="width: 100%; padding: 12px; font-size: 0.95rem;" placeholder="Search exercises by name...">
                            
                            <!-- Categories Pills -->
                            <div style="display: flex; gap: 6px; flex-wrap: wrap;" id="library-filter-pills">
                                <button type="button" class="btn btn-sm btn-dark active-pill" data-filter="All" style="padding: 4px 12px; font-size: 0.7rem;">All</button>
                                <button type="button" class="btn btn-sm btn-outline" data-filter="Chest" style="padding: 4px 12px; font-size: 0.7rem;">Chest</button>
                                <button type="button" class="btn btn-sm btn-outline" data-filter="Back" style="padding: 4px 12px; font-size: 0.7rem;">Back</button>
                                <button type="button" class="btn btn-sm btn-outline" data-filter="Shoulders" style="padding: 4px 12px; font-size: 0.7rem;">Shoulders</button>
                                <button type="button" class="btn btn-sm btn-outline" data-filter="Biceps" style="padding: 4px 12px; font-size: 0.7rem;">Biceps</button>
                                <button type="button" class="btn btn-sm btn-outline" data-filter="Triceps" style="padding: 4px 12px; font-size: 0.7rem;">Triceps</button>
                                <button type="button" class="btn btn-sm btn-outline" data-filter="Forearms" style="padding: 4px 12px; font-size: 0.7rem;">Forearms</button>
                                <button type="button" class="btn btn-sm btn-outline" data-filter="Legs" style="padding: 4px 12px; font-size: 0.7rem;">Legs</button>
                                <button type="button" class="btn btn-sm btn-outline" data-filter="Core" style="padding: 4px 12px; font-size: 0.7rem;">Core</button>
                            </div>
                        </div>

                        <!-- Results List -->
                        <div id="library-results" style="max-height: 380px; overflow-y: auto; border: 1px solid var(--grey-200); border-radius: 12px; padding: 10px; display: flex; flex-direction: column; gap: 8px;">
                            <!-- Filtered results populated dynamically -->
                        </div>

                        <!-- Create Custom Exercise Form -->
                        <div style="border-top: 1px solid var(--grey-200); padding-top: 15px;">
                            <label style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--grey-600); display: block; margin-bottom: 10px;">Create Custom Exercise</label>
                            <div style="display: grid; grid-template-columns: 1.2fr 1fr auto; gap: 10px; align-items: end;">
                                <div>
                                    <input type="text" id="custom-ex-name" class="routine-select" style="width:100%; padding:8px;" placeholder="Name...">
                                </div>
                                <div>
                                    <select id="custom-ex-category" class="routine-select" style="width:100%; padding:8px;">
                                        <option value="Chest">Chest</option>
                                        <option value="Back">Back</option>
                                        <option value="Shoulders">Shoulders</option>
                                        <option value="Biceps">Biceps</option>
                                        <option value="Triceps">Triceps</option>
                                        <option value="Forearms">Forearms</option>
                                        <option value="Legs">Legs</option>
                                        <option value="Core">Core</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-orange" id="add-to-lib-btn" style="padding: 10px 15px;"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials/Reviews Section -->
        <section class="reviews">
            <div class="reviews-container">
                <div class="reviews-flex">
                    <div class="reviews-sidebar-left">
                        <span class="section-subtitle" style="align-self: flex-start;">REVIEWS</span>
                        <h2 class="reviews-title section-title">FROM YOU</h2>
                        <div class="reviews-nav">
                            <button class="reviews-nav-btn" id="review-prev-btn"><i class="fa-solid fa-chevron-left"></i></button>
                            <button class="reviews-nav-btn" id="review-next-btn"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                    
                    <div class="testimonial-slider">
                        <div class="testimonial-track" id="testimonial-track">
                            <!-- Filled dynamically by app.js -->
                        </div>
                    </div>
                </div>

                <!-- Add Review Submission Block -->
                <div class="reviews-write-wrapper" style="margin-top: 40px; border-top: 1px solid var(--grey-200); padding-top: 30px;">
                    <?php if ($isLoggedIn) { ?>
                        <div class="write-review-card" style="background: var(--white); padding: 30px; border-radius: 16px; border: 1px solid var(--grey-200); max-width: 700px; margin: 0 auto;">
                            <h3 style="font-weight: 800; font-family: var(--font-display); letter-spacing: -0.5px; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-pen-nib text-orange"></i> SHARE YOUR ARC EXPERIENCE</h3>
                            <p class="text-muted" style="font-size: 0.85rem; font-weight: 600; margin-bottom: 20px;">Let other members know about your progression, your thoughts on the tracker, or your general coaching experience.</p>
                            <form id="add-review-form" style="display: flex; flex-direction: column; gap: 15px;">
                                <textarea id="review-text-input" placeholder="Type your testimonial or review here..." style="width: 100%; min-height: 90px; padding: 15px; border-radius: 12px; border: 2px solid var(--grey-200); font-family: var(--font-body); font-weight: 600; resize: vertical; font-size: 0.92rem; outline: none; transition: border-color 0.2s;" required></textarea>
                                <button type="submit" class="btn btn-orange" style="align-self: flex-end; padding: 12px 24px; font-size: 0.85rem;"><i class="fa-solid fa-paper-plane"></i> SUBMIT REVIEW</button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class="write-review-card locked-overlay-reviews" style="background: rgba(255,255,255,0.7); backdrop-filter: blur(4px); padding: 30px; border-radius: 16px; border: 1px dashed var(--grey-300); max-width: 700px; margin: 0 auto; text-align: center;">
                            <p class="text-muted" style="font-size: 0.9rem; font-weight: 800; text-transform: uppercase; margin: 0; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <i class="fa-solid fa-lock text-orange"></i> Want to write a review? <a href="login.php" style="color: var(--primary); text-decoration: underline;">Log In</a> or <a href="register.php" style="color: var(--primary); text-decoration: underline;">Sign Up</a> first.
                            </p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-brand">
                <div class="footer-logo">
                    <svg class="brand-logo-svg" viewBox="0 0 300 131" style="height: 42px; fill: currentColor;">
                        <path fill="currentColor" fill-rule="evenodd" d="M 82 -0.5 L 107 -0.5 L 108 0.5 L 109 0.5 L 110.5 2 L 110.5 3 L 112.5 5 L 112.5 7 L 113.5 8 L 113.5 11 L 114.5 12 L 114.5 14 L 115.5 15 L 115.5 17 L 116.5 18 L 116.5 20 L 117.5 21 L 117.5 23 L 118.5 24 L 118.5 26 L 119.5 27 L 119.5 29 L 120.5 30 L 120.5 32 L 121.5 33 L 121.5 35 L 122.5 36 L 122.5 38 L 123.5 39 L 123.5 41 L 124.5 42 L 124.5 44 L 125.5 45 L 125.5 47 L 126.5 48 L 126.5 51 L 127.5 52 L 127.5 54 L 128.5 55 L 128.5 57 L 129.5 58 L 129.5 60 L 130.5 61 L 130.5 63 L 131.5 64 L 131.5 66 L 132.5 67 L 132.5 69 L 133.5 70 L 133.5 72 L 134.5 73 L 134.5 75 L 135.5 76 L 135.5 78 L 136.5 79 L 136.5 81 L 137.5 82 L 137.5 84 L 138.5 85 L 138.5 87 L 139.5 88 L 139.5 90 L 140.5 91 L 140.5 94 L 141.5 95 L 141.5 97 L 142.5 98 L 142.5 100 L 143.5 101 L 143.5 103 L 144.5 104 L 144.5 106 L 145.5 107 L 145.5 109 L 146.5 110 L 146.5 112 L 147.5 113 L 147.5 115 L 148.5 116 L 148.5 118 L 149.5 119 L 149.5 121 L 150.5 122 L 150.5 129 L 150 129.5 L 149 129.5 L 148 130.5 L 120 130.5 L 116.5 127 L 116.5 125 L 115.5 124 L 115.5 122 L 114.5 121 L 114.5 119 L 113.5 118 L 113.5 116 L 112.5 115 L 112.5 113 L 111.5 112 L 111.5 110 L 110.5 109 L 110.5 107 L 109.5 106 L 109.5 104 L 108.5 103 L 108.5 101 L 107.5 100 L 107.5 98 L 106 96.5 L 92 96.5 L 90.5 95 L 90.5 93 L 89.5 92 L 89.5 90 L 88.5 89 L 88.5 87 L 87.5 86 L 87.5 84 L 86.5 83 L 86.5 81 L 85.5 80 L 85.5 78 L 84.5 77 L 84.5 75 L 83.5 74 L 83.5 72 L 82.5 71 L 83 70.5 L 98 70.5 L 98.5 70 L 98.5 69 L 97.5 68 L 97.5 66 L 96.5 65 L 96.5 63 L 95.5 62 L 95.5 59 L 94.5 58 L 94.5 56 L 93.5 55 L 93.5 53 L 92.5 52 L 92.5 50 L 91.5 49 L 91.5 47 L 90.5 46 L 90.5 44 L 89 42.5 L 87.5 44 L 87.5 45 L 85.5 47 L 85.5 48 L 83.5 50 L 83.5 51 L 81.5 53 L 81.5 54 L 79.5 56 L 79.5 57 L 79 57.5 L 78.5 57 L 78.5 56 L 77.5 55 L 77.5 53 L 76.5 52 L 76.5 50 L 75.5 49 L 75.5 47 L 74.5 46 L 74.5 44 L 73.5 43 L 73.5 41 L 72.5 40 L 72.5 38 L 71.5 37 L 71.5 35 L 70.5 34 L 70.5 31 L 69.5 30 L 69.5 28 L 68.5 27 L 68.5 25 L 67.5 24 L 67.5 22 L 66.5 21 L 66.5 19 L 68.5 17 L 68.5 16 L 70.5 14 L 70.5 13 L 72.5 11 L 72.5 10 L 75.5 7 L 75.5 6 L 77.5 4 L 77.5 3 L 80 0.5 L 81 0.5 Z M 116.5 0 L 117 -0.5 L 195 -0.5 L 195.5 0 L 195.5 2 L 196.5 3 L 196.5 5 L 197.5 6 L 197.5 8 L 198.5 9 L 198.5 11 L 199.5 12 L 199.5 14 L 200.5 15 L 200.5 17 L 201.5 18 L 201.5 20 L 202.5 21 L 202.5 23 L 203.5 24 L 203.5 26 L 204.5 27 L 204.5 29 L 205.5 30 L 205.5 32 L 206.5 33 L 206.5 35 L 207.5 36 L 207.5 38 L 208.5 39 L 208.5 41 L 209.5 42 L 209.5 44 L 210.5 45 L 210.5 48 L 211.5 49 L 211.5 51 L 212.5 52 L 212.5 54 L 213.5 55 L 213.5 57 L 214.5 58 L 213.5 59 L 213.5 60 L 212.5 61 L 212.5 62 L 211.5 63 L 211.5 64 L 209.5 66 L 209.5 67 L 200 76.5 L 199 76.5 L 198 77.5 L 197 77.5 L 194.5 80 L 194.5 81 L 195.5 82 L 195.5 84 L 196.5 85 L 196.5 87 L 197.5 88 L 197.5 90 L 198.5 91 L 198.5 94 L 199.5 95 L 199.5 97 L 200.5 98 L 200.5 100 L 201.5 101 L 201.5 103 L 202.5 104 L 202.5 106 L 203.5 107 L 203.5 110 L 204.5 111 L 204.5 113 L 205.5 114 L 205.5 116 L 206.5 117 L 206.5 119 L 207.5 120 L 207.5 122 L 208.5 123 L 208.5 128 L 206 130.5 L 177 130.5 L 176 129.5 L 174 129.5 L 172.5 128 L 172.5 126 L 171.5 125 L 171.5 123 L 170.5 122 L 170.5 120 L 169.5 119 L 169.5 117 L 168.5 116 L 168.5 113 L 167.5 112 L 167.5 110 L 166.5 109 L 166.5 107 L 165.5 106 L 165.5 107 L 164.5 103 L 164.5 101 L 163.5 100 L 163.5 97 L 162.5 96 L 162.5 94 L 161.5 93 L 161.5 91 L 160.5 90 L 160.5 88 L 159.5 87 L 159.5 84 L 158 82.5 L 144 82.5 L 142.5 81 L 142.5 79 L 141.5 78 L 141.5 76 L 140.5 75 L 140.5 73 L 139.5 72 L 139.5 70 L 138.5 69 L 138.5 67 L 137.5 66 L 137.5 64 L 136.5 63 L 136.5 61 L 135.5 60 L 135.5 58 L 134.5 57 L 134.5 55 L 135 54.5 L 180 54.5 L 180.5 54 L 179.5 53 L 179.5 51 L 178.5 50 L 178.5 47 L 177.5 46 L 177.5 44 L 176.5 43 L 176.5 41 L 175.5 40 L 175.5 38 L 174.5 37 L 174.5 35 L 173.5 34 L 173.5 32 L 172.5 31 L 172.5 29 L 171.5 28 L 171.5 27 L 171 26.5 L 125 26.5 L 124.5 26 L 124.5 24 L 123.5 23 L 123.5 21 L 122.5 20 L 122.5 17 L 121.5 16 L 121.5 14 L 120.5 13 L 120.5 11 L 119.5 10 L 119.5 8 L 118.5 7 L 118.5 5 L 117.5 4 L 117.5 2 L 116.5 1 Z M 201.5 0 L 202 -0.5 L 260 -0.5 L 261 0.5 L 263 0.5 L 265.5 3 L 265.5 4 L 266.5 5 L 266.5 8 L 267.5 9 L 267.5 14 L 268.5 15 L 268.5 20 L 269.5 21 L 269.5 23 L 268.5 24 L 268.5 25 L 266 27.5 L 211 27.5 L 209.5 26 L 209.5 24 L 208.5 23 L 208.5 21 L 207.5 20 L 207.5 18 L 206.5 17 L 206.5 15 L 205.5 14 L 205.5 12 L 204.5 11 L 204.5 9 L 203.5 8 L 203.5 6 L 202.5 5 L 202.5 3 L 201.5 2 Z M 62 26.5 L 63.5 28 L 63.5 30 L 64.5 31 L 64.5 33 L 65.5 34 L 65.5 36 L 66.5 37 L 66.5 39 L 67.5 40 L 67.5 42 L 68.5 43 L 68.5 45 L 69.5 46 L 69.5 49 L 70.5 50 L 70.5 52 L 71.5 53 L 71.5 55 L 72.5 56 L 72.5 58 L 73.5 59 L 73.5 61 L 74.5 62 L 74.5 65 L 72.5 67 L 72.5 68 L 70.5 70 L 70.5 71 L 69.5 72 L 69.5 73 L 67.5 75 L 67.5 76 L 65.5 78 L 65.5 79 L 64.5 80 L 64.5 81 L 62.5 83 L 62.5 84 L 61.5 85 L 61.5 86 L 59.5 88 L 59.5 89 L 57.5 91 L 57.5 92 L 56.5 93 L 56.5 94 L 54.5 96 L 54.5 97 L 53.5 98 L 53.5 99 L 51.5 101 L 51.5 102 L 50.5 103 L 50.5 104 L 48.5 106 L 48.5 107 L 46.5 109 L 46.5 110 L 45.5 111 L 45.5 112 L 43.5 114 L 43.5 115 L 42.5 116 L 42.5 117 L 40.5 119 L 40.5 120 L 38.5 122 L 38.5 123 L 37.5 124 L 37.5 125 L 33 129.5 L 32 129.5 L 31 130.5 L 3 130.5 L -0.5 127 L -0.5 125 L 0.5 124 L 0.5 123 L 1.5 122 L 1.5 121 L 2.5 120 L 2.5 119 L 4.5 117 L 4.5 116 L 6.5 114 L 6.5 113 L 8.5 111 L 8.5 110 L 9.5 109 L 9.5 108 L 11.5 106 L 11.5 105 L 13.5 103 L 13.5 102 L 15.5 100 L 15.5 99 L 16.5 98 L 16.5 97 L 18.5 95 L 18.5 94 L 20.5 92 L 20.5 91 L 22.5 89 L 22.5 88 L 23.5 87 L 23.5 86 L 25.5 84 L 25.5 83 L 27.5 81 L 27.5 80 L 29.5 78 L 29.5 77 L 30.5 76 L 30.5 75 L 32.5 73 L 32.5 72 L 34.5 70 L 34.5 69 L 36.5 67 L 36.5 66 L 37.5 65 L 37.5 64 L 39.5 62 L 39.5 61 L 41.5 59 L 41.5 58 L 43.5 56 L 43.5 55 L 44.5 54 L 44.5 53 L 46.5 51 L 46.5 50 L 48.5 48 L 48.5 47 L 50.5 45 L 50.5 44 L 51.5 43 L 51.5 42 L 53.5 40 L 53.5 39 L 55.5 37 L 55.5 36 L 57.5 34 L 57.5 33 L 58.5 32 L 58.5 31 L 60.5 29 L 60.5 28 Z M 220.5 52 L 221 51.5 L 221.5 52 L 221.5 53 L 222.5 54 L 222.5 56 L 223.5 57 L 223.5 59 L 224.5 60 L 224.5 62 L 225.5 63 L 225.5 65 L 226.5 66 L 226.5 68 L 226.5 68 L 227.5 69 L 227.5 72 L 228.5 73 L 228.5 75 L 229.5 76 L 229.5 78 L 230.5 79 L 230.5 81 L 231.5 82 L 231.5 84 L 232.5 85 L 232.5 87 L 233.5 88 L 233.5 90 L 234.5 91 L 234.5 93 L 235.5 94 L 235.5 96 L 236.5 97 L 236.5 100 L 237 100.5 L 290 100.5 L 291 101.5 L 292 101.5 L 292.5 102 L 292.5 103 L 294.5 105 L 294.5 106 L 295.5 107 L 295.5 111 L 296.5 112 L 296.5 115 L 297.5 116 L 297.5 119 L 298.5 120 L 298.5 123 L 299.5 124 L 299.5 126 L 298.5 127 L 298.5 128 L 297 129.5 L 296 129.5 L 295 130.5 L 218 130.5 L 217 129.5 L 216 129.5 L 214.5 128 L 214.5 127 L 213.5 126 L 213.5 123 L 212.5 122 L 212.5 120 L 211.5 119 L 211.5 117 L 210.5 116 L 210.5 114 L 209.5 113 L 209.5 111 L 208.5 110 L 208.5 108 L 207.5 107 L 207.5 105 L 206.5 104 L 206.5 101 L 205.5 100 L 205.5 98 L 204.5 97 L 204.5 95 L 203.5 94 L 203.5 91 L 202.5 90 L 202.5 88 L 201.5 87 L 201.5 85 L 200.5 84 L 200.5 80 L 201 79.5 L 202 79.5 L 204 77.5 L 205 77.5 L 212.5 70 L 212.5 69 L 214.5 67 L 214.5 66 L 215.5 65 L 215.5 64 L 216.5 63 L 216.5 62 L 217.5 61 L 217.5 60 L 218.5 59 L 218.5 58 L 219.5 57 L 219.5 55 L 220.5 54 Z" />
                    </svg>
                </div>
                <p>Redefining athletic potential. Elite facilities, premium coaching, and built-in progression tracking designed to unlock your ultimate strength.</p>
            </div>
            
            <div class="footer-col">
                <h5>Menu</h5>
                <ul class="footer-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#workout-tracker">Workout Tracker</a></li>
                    <li><a href="#progression">Progression</a></li>
                    <li><a href="#workout-plan">Workout Plan</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="#workout-plan">Workout Plan Editor</a></li>
                    <li><a href="#coaches">Our Coaches</a></li>
                    <li><a href="#home">Reviews</a></li>
                    <li><a href="#workout-tracker">Calendar View</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Operational</h5>
                <div class="footer-info">
                    <p><i class="fa-solid fa-phone"></i> +91 7355894409</p>
                    <p><i class="fa-solid fa-envelope"></i> himanshusheoran9799@gmail.com</p>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 ARC Gym. All rights reserved. Created in partnership with Antigravity.</p>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <!-- Global Floating Rest Timer Screen Overlay -->
    <div class="timer-overlay" id="timer-overlay">
        <div class="timer-card">
            <button class="timer-close-btn" id="timer-close-btn">&times;</button>
            <h3>REST TIME</h3>
            <div class="timer-exercise-name" id="timer-exercise-name">Barbell Bench Press</div>
            
            <!-- Animated Timer Ring -->
            <div class="timer-circle">
                <div class="timer-circle-text">
                    <span class="timer-countdown" id="timer-countdown">1:30</span>
                </div>
            </div>
            
            <div class="timer-actions">
                <button type="button" class="btn btn-outline" id="timer-add15-btn"><i class="fa-solid fa-plus"></i> 15s</button>
                <button type="button" class="btn btn-orange" id="timer-skip-btn"><i class="fa-solid fa-forward"></i> Skip Rest</button>
            </div>
        </div>
    </div>

    <!-- Week Selection Modal for PDF Export -->
    <div class="timer-overlay" id="pdf-modal-overlay">
        <div class="timer-card" style="max-width: 480px;">
            <button class="timer-close-btn" id="pdf-modal-close-btn">&times;</button>
            <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fa-solid fa-file-pdf"></i> Export Weekly Report</h3>
            <p class="text-muted" style="font-size: 0.85rem; margin-bottom: 20px;">
                Select any date in the week you wish to export. The system will collect all logged exercises from Monday to Sunday for that week.
            </p>
            
            <div style="text-align: left; margin-bottom: 25px;">
                <label for="pdf-week-date" style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--grey-600); display: block; margin-bottom: 6px;">Select Date in Week</label>
                <input type="date" id="pdf-week-date" class="routine-select" style="width: 100%; padding: 12px; font-size: 1rem; border-radius: 12px; margin-bottom: 15px;">
                
                <div class="last-time-box" id="pdf-week-range-display" style="margin-bottom: 0;">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Selected Week: Select a date first</span>
                </div>
            </div>
            
            <div class="timer-actions">
                <button type="button" class="btn btn-outline" id="pdf-modal-cancel-btn">Cancel</button>
                <button type="button" class="btn btn-orange" id="pdf-modal-confirm-btn"><i class="fa-solid fa-download"></i> Generate PDF</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div class="toast-container" id="toast-container"></div>

    <!-- App Logic -->
    <script src="app.js"></script>
</body>
</html>
