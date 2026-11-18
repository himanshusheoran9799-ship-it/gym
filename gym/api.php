<?php
session_start();
header('Content-Type: application/json');

require_once 'db.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Handle public actions that do not require authentication
if ($action === 'get_reviews') {
    $sql = "SELECT r.review_text, u.name, r.created_at
            FROM gym_reviews r
            JOIN gym_users u ON r.user_id = u.id
            ORDER BY r.created_at DESC";
    $res = mysqli_query($conn, $sql);
    $list = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $list[] = [
                "name" => $row['name'],
                "review_text" => $row['review_text']
            ];
        }
    }
    echo json_encode(["status" => "success", "data" => $list]);
    exit();
}

// Check authentication for all other actions
if (!isset($_SESSION['gym_user_id'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Unauthorized. Please log in."]);
    exit();
}

$userId = intval($_SESSION['gym_user_id']);

// Predefined routines template (Day 1 - Day 7)
$DEFAULT_ROUTINES = [
    1 => [
        "name" => "Day 1: Chest + Shoulders + Triceps",
        "focus" => "Controlled reps, full stretch & contraction",
        "exercises" => [
            ["name" => "Barbell Bench Press", "target" => "Chest", "sets" => 4, "reps" => "6-8", "rest" => 150],
            ["name" => "Incline Dumbbell Press", "target" => "Chest", "sets" => 3, "reps" => "8-12", "rest" => 120],
            ["name" => "Machine Chest Press", "target" => "Chest", "sets" => 3, "reps" => "8-12", "rest" => 90],
            ["name" => "Cable Chest Fly", "target" => "Chest", "sets" => 3, "reps" => "12-15", "rest" => 75],
            ["name" => "Barbell Overhead Press", "target" => "Shoulders", "sets" => 3, "reps" => "6-10", "rest" => 120],
            ["name" => "Dumbbell Lateral Raise", "target" => "Shoulders", "sets" => 3, "reps" => "12-20", "rest" => 75],
            ["name" => "Rear-Delt Fly", "target" => "Shoulders", "sets" => 3, "reps" => "12-20", "rest" => 75],
            ["name" => "Rope Triceps Pushdown", "target" => "Triceps", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "Overhead Cable Extension", "target" => "Triceps", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "Dumbbell Kickback", "target" => "Triceps", "sets" => 2, "reps" => "12-15", "rest" => 60]
        ]
    ],
    2 => [
        "name" => "Day 2: Back + Biceps + Forearms",
        "focus" => "Controlled eccentrics & squeezing contraction",
        "exercises" => [
            ["name" => "Lat Pulldown (Wide Grip)", "target" => "Back", "sets" => 4, "reps" => "8-12", "rest" => 120],
            ["name" => "Close Grip Pulldown", "target" => "Back", "sets" => 3, "reps" => "8-12", "rest" => 90],
            ["name" => "Chest-Supported Row", "target" => "Back", "sets" => 3, "reps" => "8-12", "rest" => 105],
            ["name" => "One-Arm Dumbbell Row", "target" => "Back", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "Hyper-Extension", "target" => "Back", "sets" => 3, "reps" => "12-15", "rest" => 75],
            ["name" => "Incline Dumbbell Curl", "target" => "Biceps", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "EZ-Bar Preacher Curl", "target" => "Biceps", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "Hammer Curl", "target" => "Biceps", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "Reverse Wrist Curl", "target" => "Forearms", "sets" => 3, "reps" => "12-15", "rest" => 60],
            ["name" => "Wrist Curl", "target" => "Forearms", "sets" => 3, "reps" => "12-15", "rest" => 60]
        ]
    ],
    3 => [
        "name" => "Day 3: Legs + Core",
        "focus" => "Legs strength & abdominal stability",
        "exercises" => [
            ["name" => "Barbell Back Squat", "target" => "Legs", "sets" => 4, "reps" => "6-8", "rest" => 180],
            ["name" => "Leg Press", "target" => "Legs", "sets" => 3, "reps" => "10-12", "rest" => 120],
            ["name" => "Romanian Deadlift", "target" => "Legs", "sets" => 3, "reps" => "8-10", "rest" => 120],
            ["name" => "Leg Extension", "target" => "Legs", "sets" => 3, "reps" => "12-15", "rest" => 75],
            ["name" => "Leg Curl", "target" => "Legs", "sets" => 3, "reps" => "10-12", "rest" => 75],
            ["name" => "Calf Raise", "target" => "Legs", "sets" => 4, "reps" => "12-15", "rest" => 60],
            ["name" => "Hanging Knee Raise", "target" => "Core", "sets" => 3, "reps" => "12-15", "rest" => 60],
            ["name" => "Ab Wheel Rollout", "target" => "Core", "sets" => 3, "reps" => "8-12", "rest" => 90],
            ["name" => "Plank", "target" => "Core", "sets" => 3, "reps" => "60s", "rest" => 60]
        ]
    ],
    4 => [
        "name" => "Day 4: Chest + Shoulders (Width Focus)",
        "focus" => "High volume & pump (3D shoulders + upper chest)",
        "exercises" => [
            ["name" => "Incline Dumbbell Press", "target" => "Chest", "sets" => 4, "reps" => "8-12", "rest" => 120],
            ["name" => "Flat Dumbbell Press", "target" => "Chest", "sets" => 3, "reps" => "8-12", "rest" => 105],
            ["name" => "Pec Deck Fly", "target" => "Chest", "sets" => 3, "reps" => "12-15", "rest" => 75],
            ["name" => "Seated Dumbbell Shoulder Press", "target" => "Shoulders", "sets" => 3, "reps" => "8-12", "rest" => 120],
            ["name" => "Dumbbell Lateral Raise", "target" => "Shoulders", "sets" => 4, "reps" => "12-20", "rest" => 75],
            ["name" => "Cable Lateral Raise", "target" => "Shoulders", "sets" => 3, "reps" => "12-15", "rest" => 60],
            ["name" => "Dumbbell Rear-Delt Fly", "target" => "Shoulders", "sets" => 4, "reps" => "12-20", "rest" => 60],
            ["name" => "Face Pull", "target" => "Shoulders", "sets" => 3, "reps" => "15-20", "rest" => 75],
            ["name" => "Dumbbell Shrugs", "target" => "Shoulders", "sets" => 3, "reps" => "12-15", "rest" => 75]
        ]
    ],
    5 => [
        "name" => "Day 5: Arms Peak Day",
        "focus" => "Maximum blood flow, pump & forearms size",
        "exercises" => [
            ["name" => "Close Grip Bench Press", "target" => "Triceps", "sets" => 3, "reps" => "6-8", "rest" => 120],
            ["name" => "Lying Triceps Extension", "target" => "Triceps", "sets" => 3, "reps" => "8-12", "rest" => 90],
            ["name" => "Rope Triceps Pushdown", "target" => "Triceps", "sets" => 3, "reps" => "10-12", "rest" => 75],
            ["name" => "Overhead Cable Extension", "target" => "Triceps", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "EZ-Bar Biceps Curl", "target" => "Biceps", "sets" => 3, "reps" => "8-10", "rest" => 90],
            ["name" => "Incline Dumbbell Curl", "target" => "Biceps", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "Hammer Curl", "target" => "Biceps", "sets" => 3, "reps" => "10-12", "rest" => 90],
            ["name" => "Concentration Curl", "target" => "Biceps", "sets" => 2, "reps" => "12-15", "rest" => 60],
            ["name" => "Reverse Wrist Curl", "target" => "Forearms", "sets" => 3, "reps" => "12-15", "rest" => 60],
            ["name" => "Wrist Curl", "target" => "Forearms", "sets" => 3, "reps" => "12-15", "rest" => 60]
        ]
    ],
    6 => [
        "name" => "Day 6: Back + Legs + Core",
        "focus" => "Heavy pull movements & deadlift strength",
        "exercises" => [
            ["name" => "Conventional Deadlift", "target" => "Back", "sets" => 3, "reps" => "5-6", "rest" => 180],
            ["name" => "Wide-Grip Pull-Ups", "target" => "Back", "sets" => 3, "reps" => "8-12", "rest" => 90],
            ["name" => "Seated Cable Row", "target" => "Back", "sets" => 2, "reps" => "10-12", "rest" => 90],
            ["name" => "Leg Press", "target" => "Legs", "sets" => 3, "reps" => "10-15", "rest" => 120],
            ["name" => "Leg Curl", "target" => "Legs", "sets" => 3, "reps" => "10-15", "rest" => 75],
            ["name" => "Calf Raise", "target" => "Legs", "sets" => 3, "reps" => "12-15", "rest" => 60],
            ["name" => "Hanging Leg Raise", "target" => "Core", "sets" => 3, "reps" => "10-15", "rest" => 60],
            ["name" => "Ab Wheel Rollout", "target" => "Core", "sets" => 3, "reps" => "6-12", "rest" => 90]
        ]
    ],
    0 => [
        "name" => "Day 7: Rest Day",
        "focus" => "Recovery, Stretching, Nutrition & Sleep",
        "exercises" => []
    ]
];

switch ($action) {
    case 'get_workout':
        $date = isset($_GET['date']) ? mysqli_real_escape_string($conn, $_GET['date']) : '';
        if (!$date) {
            echo json_encode(["status" => "error", "message" => "Date required."]);
            exit();
        }

        // Fetch workout metadata
        $sql = "SELECT * FROM gym_workouts WHERE user_id = $userId AND workout_date = '$date'";
        $res = mysqli_query($conn, $sql);
        if ($res && mysqli_num_rows($res) === 1) {
            $workout = mysqli_fetch_assoc($res);
            $workoutId = intval($workout['id']);
            
            // Fetch exercises
            $exSql = "SELECT * FROM gym_workout_exercises WHERE workout_id = $workoutId ORDER BY sort_order ASC";
            $exRes = mysqli_query($conn, $exSql);
            $exercises = [];
            while ($exRow = mysqli_fetch_assoc($exRes)) {
                $exId = intval($exRow['id']);
                
                // Fetch sets list
                $setSql = "SELECT * FROM gym_workout_sets WHERE workout_exercise_id = $exId ORDER BY set_number ASC";
                $setRes = mysqli_query($conn, $setSql);
                $setsList = [];
                while ($setRow = mysqli_fetch_assoc($setRes)) {
                    $setsList[] = [
                        "weight" => floatval($setRow['weight']),
                        "reps" => intval($setRow['reps']),
                        "completed" => intval($setRow['completed'])
                    ];
                }
                
                $exercises[] = [
                    "name" => $exRow['exercise_name'],
                    "target" => $exRow['target_muscle'],
                    "rest" => intval($exRow['rest_time']),
                    "reps" => $exRow['reps_range'],
                    "sets" => count($setsList),
                    "setsList" => $setsList
                ];
            }
            
            echo json_encode([
                "status" => "success",
                "data" => [
                    "routineId" => $workout['routine_id'] !== null ? intval($workout['routine_id']) : null,
                    "routineName" => $workout['routine_name'],
                    "routineFocus" => $workout['routine_focus'],
                    "bodyWeight" => $workout['body_weight'] !== null ? floatval($workout['body_weight']) : null,
                    "notes" => $workout['notes'],
                    "exercises" => $exercises
                ]
            ]);
        } else {
            echo json_encode(["status" => "success", "data" => null]);
        }
        break;

    case 'get_all_workouts':
        $sql = "SELECT * FROM gym_workouts WHERE user_id = $userId ORDER BY workout_date ASC";
        $res = mysqli_query($conn, $sql);
        $allWorkouts = [];
        
        if ($res) {
            while ($workout = mysqli_fetch_assoc($res)) {
                $workoutId = intval($workout['id']);
                $date = $workout['workout_date'];
                
                $exSql = "SELECT * FROM gym_workout_exercises WHERE workout_id = $workoutId ORDER BY sort_order ASC";
                $exRes = mysqli_query($conn, $exSql);
                $exercises = [];
                while ($exRow = mysqli_fetch_assoc($exRes)) {
                    $exId = intval($exRow['id']);
                    
                    $setSql = "SELECT * FROM gym_workout_sets WHERE workout_exercise_id = $exId ORDER BY set_number ASC";
                    $setRes = mysqli_query($conn, $setSql);
                    $setsList = [];
                    while ($setRow = mysqli_fetch_assoc($setRes)) {
                        $setsList[] = [
                            "weight" => floatval($setRow['weight']),
                            "reps" => intval($setRow['reps']),
                            "completed" => intval($setRow['completed'])
                        ];
                    }
                    
                    $exercises[] = [
                        "name" => $exRow['exercise_name'],
                        "target" => $exRow['target_muscle'],
                        "rest" => intval($exRow['rest_time']),
                        "reps" => $exRow['reps_range'],
                        "sets" => count($setsList),
                        "setsList" => $setsList
                    ];
                }
                
                $allWorkouts[$date] = [
                    "routineId" => $workout['routine_id'] !== null ? intval($workout['routine_id']) : null,
                    "routineName" => $workout['routine_name'],
                    "routineFocus" => $workout['routine_focus'],
                    "bodyWeight" => $workout['body_weight'] !== null ? floatval($workout['body_weight']) : null,
                    "notes" => $workout['notes'],
                    "exercises" => $exercises
                ];
            }
        }
        echo json_encode(["status" => "success", "data" => $allWorkouts]);
        break;

    case 'save_workout':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['date'])) {
            echo json_encode(["status" => "error", "message" => "Invalid parameters."]);
            exit();
        }

        $date = mysqli_real_escape_string($conn, $data['date']);
        $routineId = isset($data['routineId']) && $data['routineId'] !== null ? intval($data['routineId']) : "NULL";
        $routineName = isset($data['routineName']) ? mysqli_real_escape_string($conn, $data['routineName']) : '';
        $routineFocus = isset($data['routineFocus']) ? mysqli_real_escape_string($conn, $data['routineFocus']) : '';
        $bodyWeight = isset($data['bodyWeight']) && $data['bodyWeight'] !== '' && $data['bodyWeight'] !== null ? floatval($data['bodyWeight']) : "NULL";
        $notes = isset($data['notes']) ? mysqli_real_escape_string($conn, $data['notes']) : '';

        // Upsert gym_workouts
        $sql = "INSERT INTO gym_workouts (user_id, workout_date, routine_id, routine_name, routine_focus, body_weight, notes)
                VALUES ($userId, '$date', $routineId, '$routineName', '$routineFocus', $bodyWeight, '$notes')
                ON DUPLICATE KEY UPDATE 
                routine_id = $routineId, 
                routine_name = '$routineName', 
                routine_focus = '$routineFocus', 
                body_weight = $bodyWeight, 
                notes = '$notes'";
        
        if (!mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "error", "message" => "Database save error: " . mysqli_error($conn)]);
            exit();
        }

        // Get workout ID
        $getWork = "SELECT id FROM gym_workouts WHERE user_id = $userId AND workout_date = '$date'";
        $workRes = mysqli_query($conn, $getWork);
        $workoutRow = mysqli_fetch_assoc($workRes);
        $workoutId = intval($workoutRow['id']);

        // Delete existing workout exercises & sets (Cascades automatically)
        mysqli_query($conn, "DELETE FROM gym_workout_exercises WHERE workout_id = $workoutId");

        // Insert new exercises and sets
        if (isset($data['exercises']) && is_array($data['exercises'])) {
            foreach ($data['exercises'] as $index => $ex) {
                $exName = mysqli_real_escape_string($conn, $ex['name']);
                $exTarget = isset($ex['target']) ? mysqli_real_escape_string($conn, $ex['target']) : '';
                $exRest = isset($ex['rest']) ? intval($ex['rest']) : 90;
                $exReps = isset($ex['reps']) ? mysqli_real_escape_string($conn, $ex['reps']) : '10';

                $insEx = "INSERT INTO gym_workout_exercises (workout_id, exercise_name, target_muscle, rest_time, reps_range, sort_order)
                          VALUES ($workoutId, '$exName', '$exTarget', $exRest, '$exReps', $index)";
                
                if (mysqli_query($conn, $insEx)) {
                    $exId = mysqli_insert_id($conn);
                    
                    if (isset($ex['setsList']) && is_array($ex['setsList'])) {
                        foreach ($ex['setsList'] as $sIndex => $s) {
                            $weight = floatval($s['weight']);
                            $reps = intval($s['reps']);
                            $completed = isset($s['completed']) && $s['completed'] ? 1 : 0;
                            $setNo = $sIndex + 1;

                            $insSet = "INSERT INTO gym_workout_sets (workout_exercise_id, set_number, weight, reps, completed)
                                       VALUES ($exId, $setNo, $weight, $reps, $completed)";
                            mysqli_query($conn, $insSet);
                        }
                    }
                }
            }
        }

        echo json_encode(["status" => "success"]);
        break;

    case 'clear_workout':
        $date = isset($_GET['date']) ? mysqli_real_escape_string($conn, $_GET['date']) : '';
        if (!$date) {
            echo json_encode(["status" => "error", "message" => "Date required."]);
            exit();
        }

        mysqli_query($conn, "DELETE FROM gym_workouts WHERE user_id = $userId AND workout_date = '$date'");
        echo json_encode(["status" => "success"]);
        break;

    case 'get_routines':
        // Load customized routines for this user
        $sql = "SELECT * FROM gym_custom_plans WHERE user_id = $userId";
        $res = mysqli_query($conn, $sql);
        $routines = $DEFAULT_ROUTINES; // start with default baseline templates
        
        if ($res && mysqli_num_rows($res) > 0) {
            while ($plan = mysqli_fetch_assoc($res)) {
                $dayNo = intval($plan['day_number']);
                $planId = intval($plan['id']);
                
                // Load exercises
                $exSql = "SELECT * FROM gym_custom_plan_exercises WHERE plan_id = $planId ORDER BY sort_order ASC";
                $exRes = mysqli_query($conn, $exSql);
                $exercises = [];
                while ($exRow = mysqli_fetch_assoc($exRes)) {
                    $exercises[] = [
                        "name" => $exRow['exercise_name'],
                        "target" => $exRow['target_muscle'],
                        "sets" => intval($exRow['sets']),
                        "reps" => $exRow['reps'],
                        "rest" => intval($exRow['rest'])
                    ];
                }
                
                $routines[$dayNo] = [
                    "name" => $plan['routine_name'],
                    "focus" => $plan['routine_focus'],
                    "exercises" => $exercises
                ];
            }
        }
        
        echo json_encode(["status" => "success", "data" => $routines]);
        break;

    case 'save_routine':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['day'])) {
            echo json_encode(["status" => "error", "message" => "Day identifier required."]);
            exit();
        }

        $day = intval($data['day']);
        $name = mysqli_real_escape_string($conn, $data['name']);
        $focus = isset($data['focus']) ? mysqli_real_escape_string($conn, $data['focus']) : '';

        // Upsert plan
        $sql = "INSERT INTO gym_custom_plans (user_id, day_number, routine_name, routine_focus)
                VALUES ($userId, $day, '$name', '$focus')
                ON DUPLICATE KEY UPDATE routine_name = '$name', routine_focus = '$focus'";
        
        if (!mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "error", "message" => "Database save error: " . mysqli_error($conn)]);
            exit();
        }

        // Get plan ID
        $getPlan = "SELECT id FROM gym_custom_plans WHERE user_id = $userId AND day_number = $day";
        $planRes = mysqli_query($conn, $getPlan);
        $planRow = mysqli_fetch_assoc($planRes);
        $planId = intval($planRow['id']);

        // Delete existing exercises
        mysqli_query($conn, "DELETE FROM gym_custom_plan_exercises WHERE plan_id = $planId");

        // Insert new exercises
        if (isset($data['exercises']) && is_array($data['exercises'])) {
            foreach ($data['exercises'] as $index => $ex) {
                $exName = mysqli_real_escape_string($conn, $ex['name']);
                $exTarget = mysqli_real_escape_string($conn, $ex['target']);
                $exSets = intval($ex['sets']);
                $exReps = mysqli_real_escape_string($conn, $ex['reps']);
                $exRest = intval($ex['rest']);

                $insEx = "INSERT INTO gym_custom_plan_exercises (plan_id, exercise_name, target_muscle, sets, reps, rest, sort_order)
                          VALUES ($planId, '$exName', '$exTarget', $exSets, '$exReps', $exRest, $index)";
                mysqli_query($conn, $insEx);
            }
        }

        echo json_encode(["status" => "success"]);
        break;

    case 'get_custom_exercises':
        $sql = "SELECT exercise_name AS name, target_muscle AS target FROM gym_custom_library WHERE user_id = $userId";
        $res = mysqli_query($conn, $sql);
        $list = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $list[] = [
                    "name" => $row['name'],
                    "target" => $row['target']
                ];
            }
        }
        echo json_encode(["status" => "success", "data" => $list]);
        break;

    case 'add_custom_exercise':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['name']) || !isset($data['target'])) {
            echo json_encode(["status" => "error", "message" => "Fields required."]);
            exit();
        }

        $name = mysqli_real_escape_string($conn, $data['name']);
        $target = mysqli_real_escape_string($conn, $data['target']);

        $sql = "INSERT INTO gym_custom_library (user_id, exercise_name, target_muscle)
                VALUES ($userId, '$name', '$target')
                ON DUPLICATE KEY UPDATE target_muscle = '$target'";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
        break;

    case 'delete_custom_exercise':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['name'])) {
            echo json_encode(["status" => "error", "message" => "Exercise name required."]);
            exit();
        }

        $name = mysqli_real_escape_string($conn, $data['name']);
        $sql = "DELETE FROM gym_custom_library WHERE user_id = $userId AND exercise_name = '$name'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
        break;

    case 'get_progression':
        $exName = isset($_GET['exercise']) ? mysqli_real_escape_string($conn, $_GET['exercise']) : '';
        if (!$exName) {
            echo json_encode(["status" => "success", "data" => []]);
            exit();
        }

        $sql = "SELECT w.workout_date, s.weight, s.reps, s.completed
                FROM gym_workout_sets s
                JOIN gym_workout_exercises e ON s.workout_exercise_id = e.id
                JOIN gym_workouts w ON e.workout_id = w.id
                WHERE w.user_id = $userId AND e.exercise_name = '$exName'
                ORDER BY w.workout_date ASC";
        
        $res = mysqli_query($conn, $sql);
        $grouped = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $date = $row['workout_date'];
                $weight = floatval($row['weight']);
                $reps = intval($row['reps']);
                $completed = intval($row['completed']);
                
                if (!isset($grouped[$date])) {
                    $grouped[$date] = [
                        "date" => $date,
                        "sets" => []
                    ];
                }
                $grouped[$date]['sets'][] = [
                    "weight" => $weight,
                    "reps" => $reps,
                    "completed" => $completed
                ];
            }
        }

        // Calculate max weight and volume per date
        $output = [];
        foreach ($grouped as $date => $info) {
            $maxWeight = 0;
            $volume = 0;
            foreach ($info['sets'] as $s) {
                if ($s['completed'] || ($s['weight'] > 0 && $s['reps'] > 0)) {
                    if ($s['weight'] > $maxWeight) {
                        $maxWeight = $s['weight'];
                    }
                    $volume += ($s['weight'] * $s['reps']);
                }
            }
            // Even if none completed, we can show total logged if user wants, but standard is completed
            if ($maxWeight > 0 || $volume > 0) {
                $output[] = [
                    "date" => $date,
                    "maxWeight" => $maxWeight,
                    "volume" => $volume
                ];
            }
        }

        echo json_encode(["status" => "success", "data" => $output]);
        break;

    case 'get_weight_logs':
        $sql = "SELECT workout_date, body_weight 
                FROM gym_workouts 
                WHERE user_id = $userId AND body_weight IS NOT NULL 
                ORDER BY workout_date ASC";
        $res = mysqli_query($conn, $sql);
        $logs = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $logs[] = [
                    "date" => $row['workout_date'],
                    "weight" => floatval($row['body_weight'])
                ];
            }
        }
        echo json_encode(["status" => "success", "data" => $logs]);
        break;

    case 'add_review':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['text'])) {
            echo json_encode(["status" => "error", "message" => "Review text required."]);
            exit();
        }

        $text = mysqli_real_escape_string($conn, $data['text']);
        $sql = "INSERT INTO gym_reviews (user_id, review_text) VALUES ($userId, '$text')";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Unknown action."]);
        break;
}
?>
