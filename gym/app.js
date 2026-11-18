// ARC Gym - Workout Tracker Logic

// User's Exercise Routine Chart (Day 1 - Day 6 + Rest)
let WORKOUT_ROUTINES = {
    1: {
        name: "Day 1: Chest + Shoulders + Triceps",
        focus: "Controlled reps, full stretch & contraction",
        exercises: [
            { name: "Barbell Bench Press", target: "Chest", sets: 4, reps: "6-8", rest: 150 }, // seconds
            { name: "Incline Dumbbell Press", target: "Chest", sets: 3, reps: "8-12", rest: 120 },
            { name: "Machine Chest Press", target: "Chest", sets: 3, reps: "8-12", rest: 90 },
            { name: "Cable Chest Fly", target: "Chest", sets: 3, reps: "12-15", rest: 75 },
            { name: "Barbell Overhead Press", target: "Shoulders", sets: 3, reps: "6-10", rest: 120 },
            { name: "Dumbbell Lateral Raise", target: "Shoulders", sets: 3, reps: "12-20", rest: 75 },
            { name: "Rear-Delt Fly", target: "Shoulders", sets: 3, reps: "12-20", rest: 75 },
            { name: "Overhead Cable Triceps Extension", target: "Triceps", sets: 3, reps: "10-15", rest: 75 },
            { name: "Rope Triceps Pushdown", target: "Triceps", sets: 3, reps: "10-15", rest: 75 },
            { name: "Close-Grip Bench Press", target: "Triceps", sets: 2, reps: "8-12", rest: 120 }
        ]
    },
    2: {
        name: "Day 2: Back + Biceps + Forearms",
        focus: "Mind-Muscle Connection",
        exercises: [
            { name: "Pull-Ups / Lat Pulldown", target: "Back", sets: 4, reps: "6-12", rest: 120 },
            { name: "Barbell Row", target: "Back", sets: 3, reps: "6-10", rest: 150 },
            { name: "Chest-Supported Row", target: "Back", sets: 3, reps: "8-12", rest: 120 },
            { name: "Seated Cable Row", target: "Back", sets: 3, reps: "10-12", rest: 90 },
            { name: "Straight-Arm Pulldown", target: "Back", sets: 3, reps: "12-15", rest: 75 },
            { name: "Incline Dumbbell Curl", target: "Biceps", sets: 3, reps: "8-12", rest: 90 },
            { name: "EZ-Bar Curl", target: "Biceps", sets: 3, reps: "8-12", rest: 90 },
            { name: "Hammer Curl", target: "Biceps", sets: 3, reps: "10-12", rest: 90 },
            { name: "Reverse Wrist Curl", target: "Forearms", sets: 3, reps: "12-20", rest: 60 },
            { name: "Farmer's Walk", target: "Forearms", sets: 3, reps: "30-45s", rest: 90 }
        ]
    },
    3: {
        name: "Day 3: Full Legs + Core",
        focus: "Legs Strength + Core Stability",
        exercises: [
            { name: "Back Squat", target: "Legs", sets: 4, reps: "6-10", rest: 150 },
            { name: "Romanian Deadlift", target: "Legs", sets: 3, reps: "8-10", rest: 120 },
            { name: "Leg Press", target: "Legs", sets: 3, reps: "10-15", rest: 120 },
            { name: "Leg Extension", target: "Legs", sets: 3, reps: "12-15", rest: 75 },
            { name: "Leg Curl", target: "Legs", sets: 3, reps: "10-15", rest: 75 },
            { name: "Calf Raise", target: "Legs", sets: 4, reps: "10-15", rest: 75 },
            { name: "Hanging Knee Raise", target: "Core", sets: 3, reps: "10-15", rest: 60 },
            { name: "Reverse Crunch", target: "Core", sets: 3, reps: "12-20", rest: 60 },
            { name: "Ab Wheel Rollout", target: "Core", sets: 3, reps: "6-12", rest: 90 }
        ]
    },
    4: {
        name: "Day 4: Chest + Shoulders",
        focus: "Build Width & 3D Shoulders",
        exercises: [
            { name: "Incline Barbell Press", target: "Chest", sets: 3, reps: "6-10", rest: 150 },
            { name: "Machine Chest Press", target: "Chest", sets: 3, reps: "8-12", rest: 90 },
            { name: "Cable Fly", target: "Chest", sets: 3, reps: "12-15", rest: 75 },
            { name: "Seated Dumbbell Shoulder Press", target: "Shoulders", sets: 3, reps: "8-12", rest: 120 },
            { name: "Dumbbell Lateral Raise", target: "Shoulders", sets: 4, reps: "12-20", rest: 75 },
            { name: "Cable Lateral Raise", target: "Shoulders", sets: 3, reps: "12-15", rest: 75 },
            { name: "Rear-Delt Fly", target: "Shoulders", sets: 3, reps: "12-20", rest: 75 },
            { name: "Face Pull", target: "Shoulders", sets: 3, reps: "12-20", rest: 75 },
            { name: "Machine Lateral Raise", target: "Shoulders", sets: 2, reps: "15-20", rest: 60 }
        ]
    },
    5: {
        name: "Day 5: Full Arms",
        focus: "Peak Arms & Strong Forearms",
        exercises: [
            { name: "EZ-Bar Curl", target: "Biceps", sets: 3, reps: "8-12", rest: 90 },
            { name: "Incline Dumbbell Curl", target: "Biceps", sets: 3, reps: "8-12", rest: 90 },
            { name: "Preacher Curl", target: "Biceps", sets: 3, reps: "10-15", rest: 90 },
            { name: "Cable Curl", target: "Biceps", sets: 2, reps: "12-15", rest: 75 },
            { name: "Close-Grip Bench Press", target: "Triceps", sets: 3, reps: "6-10", rest: 120 },
            { name: "Overhead Cable Triceps Extension", target: "Triceps", sets: 3, reps: "10-15", rest: 90 },
            { name: "Rope Pushdown", target: "Triceps", sets: 3, reps: "10-15", rest: 75 },
            { name: "Single-Arm Cable Pushdown", target: "Triceps", sets: 2, reps: "12-15", rest: 60 },
            { name: "Reverse Wrist Curl", target: "Forearms", sets: 3, reps: "12-20", rest: 60 },
            { name: "Wrist Curl", target: "Forearms", sets: 3, reps: "12-20", rest: 60 }
        ]
    },
    6: {
        name: "Day 6: Back + Legs + Core",
        focus: "Strength (Deadlift) + Balance + Core",
        exercises: [
            { name: "Conventional Deadlift", target: "Back", sets: 3, reps: "4-6", rest: 210 },
            { name: "Lat Pulldown", target: "Back", sets: 3, reps: "8-12", rest: 90 },
            { name: "Chest-Supported Row", target: "Back", sets: 3, reps: "8-12", rest: 100 },
            { name: "Seated Cable Row", target: "Back", sets: 2, reps: "10-12", rest: 90 },
            { name: "Leg Press", target: "Legs", sets: 3, reps: "10-15", rest: 120 },
            { name: "Leg Curl", target: "Legs", sets: 3, reps: "10-15", rest: 75 },
            { name: "Calf Raise", target: "Legs", sets: 3, reps: "12-15", rest: 60 },
            { name: "Hanging Leg Raise", target: "Core", sets: 3, reps: "10-15", rest: 60 },
            { name: "Ab Wheel Rollout", target: "Core", sets: 3, reps: "6-12", rest: 90 }
        ]
    },
    0: {
        name: "Day 7: Rest Day",
        focus: "Recovery, Stretching, Nutrition & Sleep",
        exercises: []
    }
};

// Load custom workout routines if saved (offline fallback)
let savedCustomRoutines = localStorage.getItem('arc_custom_workout_routines');
if (!USER_SESSION.isLoggedIn) {
    if (savedCustomRoutines) {
        try {
            WORKOUT_ROUTINES = JSON.parse(savedCustomRoutines);
        } catch (err) {
            console.error("Error loading custom routines:", err);
        }
    } else {
        localStorage.setItem('arc_custom_workout_routines', JSON.stringify(WORKOUT_ROUTINES));
    }
}

// Global State
let selectedDate = getFormattedDate(new Date());
let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();
let progressionChartInstance = null;
let weightChartInstance = null;
let timerInterval = null;
let timerSecondsLeft = 0;
let audioCtx = null;

// Server Workout Logs Cache
let USER_WORKOUTS = {};

// Workout Plan Editor State
let activePlanDay = 1;
let activePlanExercises = [];
let librarySearchQuery = "";
let libraryCategoryFilter = "All";

let customExercises = JSON.parse(localStorage.getItem('arc_custom_exercises')) || [];
const BASE_EXERCISE_LIBRARY = [
    // Chest
    { name: "Barbell Bench Press", target: "Chest" },
    { name: "Incline Dumbbell Bench Press", target: "Chest" },
    { name: "Dumbbell Bench Press", target: "Chest" },
    { name: "Decline Dumbbell Bench Press", target: "Chest" },
    { name: "Cable Crossover", target: "Chest" },
    { name: "Machine Chest Press", target: "Chest" },
    { name: "Pec Deck Fly", target: "Chest" },
    { name: "Incline Barbell Bench Press", target: "Chest" },
    { name: "Push-Up", target: "Chest" },
    { name: "Chest Dips", target: "Chest" },
    
    // Back
    { name: "Lat Pulldown", target: "Back" },
    { name: "Pull-Ups", target: "Back" },
    { name: "Chin-Ups", target: "Back" },
    { name: "Barbell Row", target: "Back" },
    { name: "Seated Cable Row", target: "Back" },
    { name: "Chest-Supported Row", target: "Back" },
    { name: "One Arm Dumbbell Row", target: "Back" },
    { name: "Conventional Deadlift", target: "Back" },
    { name: "T-Bar Row", target: "Back" },
    { name: "Dumbbell Pullover", target: "Back" },
    { name: "Hyper-Extension", target: "Back" },
    
    // Shoulders
    { name: "Barbell Overhead Press", target: "Shoulders" },
    { name: "Seated Dumbbell Shoulder Press", target: "Shoulders" },
    { name: "Dumbbell Lateral Raise", target: "Shoulders" },
    { name: "Cable Lateral Raise", target: "Shoulders" },
    { name: "Dumbbell Rear-Delt Fly", target: "Shoulders" },
    { name: "Face Pull", target: "Shoulders" },
    { name: "Machine Lateral Raise", target: "Shoulders" },
    { name: "Upright Row", target: "Shoulders" },
    { name: "Dumbbell Shrugs", target: "Shoulders" },
    { name: "Dumbbell Front Raise", target: "Shoulders" },
    
    // Biceps
    { name: "Incline Dumbbell Curl", target: "Biceps" },
    { name: "EZ-Bar Curl", target: "Biceps" },
    { name: "Hammer Curl", target: "Biceps" },
    { name: "Preacher Curl", target: "Biceps" },
    { name: "Concentration Curl", target: "Biceps" },
    { name: "Cable Curl", target: "Biceps" },
    { name: "Spider Curl", target: "Biceps" },
    
    // Triceps
    { name: "Overhead Cable Triceps Extension", target: "Triceps" },
    { name: "Rope Triceps Pushdown", target: "Triceps" },
    { name: "Close-Grip Bench Press", target: "Triceps" },
    { name: "Lying Triceps Extension (Skull Crusher)", target: "Triceps" },
    { name: "Triceps Dip", target: "Triceps" },
    { name: "Dumbbell Kickback", target: "Triceps" },
    
    // Forearms
    { name: "Reverse Wrist Curl", target: "Forearms" },
    { name: "Wrist Curl", target: "Forearms" },
    { name: "Farmer's Walk", target: "Forearms" },
    
    // Legs
    { name: "Back Squat", target: "Legs" },
    { name: "Romanian Deadlift", target: "Legs" },
    { name: "Leg Press", target: "Legs" },
    { name: "Leg Extension", target: "Legs" },
    { name: "Leg Curl", target: "Legs" },
    { name: "Calf Raise", target: "Legs" },
    { name: "Front Squat", target: "Legs" },
    { name: "Bulgarian Split Squat", target: "Legs" },
    { name: "Dumbbell Lunges", target: "Legs" },
    { name: "Hip Thrust", target: "Legs" },
    { name: "Goblet Squat", target: "Legs" },
    
    // Core
    { name: "Hanging Knee Raise", target: "Core" },
    { name: "Reverse Crunch", target: "Core" },
    { name: "Ab Wheel Rollout", target: "Core" },
    { name: "Hanging Leg Raise", target: "Core" },
    { name: "Plank", target: "Core" },
    { name: "Russian Twist", target: "Core" },
    { name: "Decline Crunch", target: "Core" }
];
let EXERCISE_LIBRARY = BASE_EXERCISE_LIBRARY.concat(customExercises);

// Helpers
function getFormattedDate(date) {
    const d = new Date(date);
    let month = '' + (d.getMonth() + 1);
    let day = '' + d.getDate();
    const year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

function formatDateDisplay(dateStr) {
    const parts = dateStr.split('-');
    const d = new Date(parts[0], parts[1] - 1, parts[2]);
    return d.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
}

// Database and Local Storage Helpers
async function initServerData() {
    try {
        const resRoutines = await fetch('api.php?action=get_routines');
        const routinesJson = await resRoutines.json();
        if (routinesJson.status === 'success') {
            WORKOUT_ROUTINES = routinesJson.data;
        }

        const resExercises = await fetch('api.php?action=get_custom_exercises');
        const exercisesJson = await resExercises.json();
        if (exercisesJson.status === 'success') {
            customExercises = exercisesJson.data;
            EXERCISE_LIBRARY = BASE_EXERCISE_LIBRARY.concat(customExercises);
        }

        const resWorkouts = await fetch('api.php?action=get_all_workouts');
        const workoutsJson = await resWorkouts.json();
        if (workoutsJson.status === 'success') {
            USER_WORKOUTS = workoutsJson.data;
        }
    } catch (err) {
        console.error("Error loading server data:", err);
    }
}

function getWorkoutLog(dateStr) {
    if (USER_SESSION.isLoggedIn) {
        return USER_WORKOUTS[dateStr] || null;
    } else {
        const data = localStorage.getItem(`arc_workout_${dateStr}`);
        return data ? JSON.parse(data) : null;
    }
}

async function saveWorkoutLog(dateStr, data) {
    if (USER_SESSION.isLoggedIn) {
        USER_WORKOUTS[dateStr] = data;
        updateCalendarHighlights();
        updateStreaks();
        
        try {
            await fetch('api.php?action=save_workout', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
        } catch (err) {
            console.error("Error saving workout to database:", err);
            showToast("Failed to save workout to server.", "error");
        }
    } else {
        localStorage.setItem(`arc_workout_${dateStr}`, JSON.stringify(data));
        updateCalendarHighlights();
        updateStreaks();
    }
}

async function deleteWorkoutLog(dateStr) {
    if (USER_SESSION.isLoggedIn) {
        delete USER_WORKOUTS[dateStr];
        updateCalendarHighlights();
        updateStreaks();
        
        try {
            await fetch(`api.php?action=clear_workout&date=${dateStr}`);
        } catch (err) {
            console.error("Error clearing workout from database:", err);
        }
    } else {
        localStorage.removeItem(`arc_workout_${dateStr}`);
        updateCalendarHighlights();
        updateStreaks();
    }
}

// Find historical statistics for an exercise BEFORE the given date
function getExerciseLastTime(exerciseName, beforeDateStr) {
    let sourceKeys = [];
    let getLogFn = null;

    if (USER_SESSION.isLoggedIn) {
        sourceKeys = Object.keys(USER_WORKOUTS);
        getLogFn = (k) => USER_WORKOUTS[k];
    } else {
        sourceKeys = Object.keys(localStorage)
            .filter(k => k.startsWith('arc_workout_'))
            .map(k => k.replace('arc_workout_', ''));
        getLogFn = (k) => JSON.parse(localStorage.getItem(`arc_workout_${k}`));
    }

    const sortedKeys = sourceKeys
        .filter(dStr => dStr < beforeDateStr)
        .sort((a, b) => b.localeCompare(a)); // Sort descending to get the most recent first

    for (const dStr of sortedKeys) {
        const log = getLogFn(dStr);
        if (log && log.exercises) {
            const match = log.exercises.find(e => e.name.toLowerCase() === exerciseName.toLowerCase());
            if (match) {
                const sets = match.setsList || match.sets;
                if (sets && sets.length > 0) {
                    return {
                        date: dStr,
                        sets: sets
                    };
                }
            }
        }
    }
    return null;
}

// Initialize Application
document.addEventListener("DOMContentLoaded", async () => {
    // If logged in, load server data before building calendar & UI
    if (USER_SESSION.isLoggedIn) {
        await initServerData();
    }

    // Nav handling
    setupNavigation();
    
    // Set initial date display
    document.getElementById("selected-date-title").innerText = formatDateDisplay(selectedDate);
    
    // Build calendar
    renderCalendar(currentYear, currentMonth);
    
    // Load workout for selected date
    loadWorkoutForDate(selectedDate);
    
    // Setup Routine Selector
    const routineSelect = document.getElementById("routine-selector");
    routineSelect.addEventListener("change", (e) => {
        const val = parseInt(e.target.value);
        if (!isNaN(val)) {
            loadRoutineStructure(val);
        }
    });

    // Save/Clear Buttons
    document.getElementById("save-workout-btn").addEventListener("click", saveCurrentWorkout);
    document.getElementById("clear-workout-btn").addEventListener("click", clearCurrentWorkout);
    
    // Add custom exercise
    document.getElementById("add-custom-ex-btn").addEventListener("click", addCustomExercise);
    
    // Body weight logger
    setupBodyWeightLogger();
    
    // Rest Timer Setup
    setupRestTimer();

    // Progression analytics setup
    setupProgressionAnalytics();

    // Data Export/Import
    setupBackupTools();

    // PDF Report Export
    setupPdfExport();

    // Workout Plan Editor Setup
    setupPlanEditor();

    // Testimonial sliders
    setupTestimonials();

    // Update Streaks
    updateStreaks();

    // Smooth Scroll for Hero Button
    document.getElementById("hero-start-btn").addEventListener("click", (e) => {
        e.preventDefault();
        const trackerSection = document.getElementById("workout-tracker");
        trackerSection.scrollIntoView({ behavior: 'smooth' });
    });
});

// Setup Site Navigation Tabs
function setupNavigation() {
    const navLinks = document.querySelectorAll(".nav-link");
    const sections = document.querySelectorAll("main > section");

    navLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            const targetId = link.getAttribute("href").substring(1);
            if (targetId && document.getElementById(targetId)) {
                // If it's a section on the main page, we can handle SPA navigation or scrolling
                // Let's make it scroll smoothly if it's the home page
                if (window.location.hash !== "" || targetId === "workout-tracker" || targetId === "progression" || targetId === "workout-plan" || targetId === "coaches") {
                    e.preventDefault();
                    document.getElementById(targetId).scrollIntoView({ behavior: 'smooth' });
                    
                    // Update active state in nav
                    navLinks.forEach(l => l.classList.remove("active"));
                    link.classList.add("active");
                }
            }
        });
    });
}

// Calendar Generator
function renderCalendar(year, month) {
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.getElementById("calendar-month-year").innerText = `${monthNames[month]} ${year}`;

    const calendarDaysGrid = document.getElementById("calendar-days");
    calendarDaysGrid.innerHTML = "";

    // Header labels
    const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    // Render first day of month and offset
    const firstDayIndex = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();
    const prevMonthTotalDays = new Date(year, month, 0).getDate();

    // Previous Month's trailing days
    for (let i = firstDayIndex - 1; i >= 0; i--) {
        const dayDiv = document.createElement("div");
        dayDiv.classList.add("calendar-day", "other-month");
        dayDiv.innerText = prevMonthTotalDays - i;
        calendarDaysGrid.appendChild(dayDiv);
    }

    // Active Month's days
    for (let day = 1; day <= totalDays; day++) {
        const dayDiv = document.createElement("div");
        dayDiv.classList.add("calendar-day");
        dayDiv.innerText = day;
        
        const dateStr = getFormattedDate(new Date(year, month, day));
        dayDiv.dataset.date = dateStr;

        // Highlight today
        const todayStr = getFormattedDate(new Date());
        if (dateStr === todayStr) {
            dayDiv.classList.add("today");
        }

        // Highlight selected day
        if (dateStr === selectedDate) {
            dayDiv.classList.add("selected");
        }

        // Check if workout is logged on this day
        if (localStorage.getItem(`arc_workout_${dateStr}`)) {
            dayDiv.classList.add("completed");
        }

        // Click handler to select date
        dayDiv.addEventListener("click", () => {
            document.querySelectorAll(".calendar-day").forEach(d => d.classList.remove("selected"));
            dayDiv.classList.add("selected");
            selectedDate = dateStr;
            document.getElementById("selected-date-title").innerText = formatDateDisplay(selectedDate);
            loadWorkoutForDate(selectedDate);
        });

        calendarDaysGrid.appendChild(dayDiv);
    }

    // Next Month's leading days
    const totalRendered = firstDayIndex + totalDays;
    const remainingSlots = 42 - totalRendered; // standard 6 rows grid
    for (let i = 1; i <= remainingSlots; i++) {
        const dayDiv = document.createElement("div");
        dayDiv.classList.add("calendar-day", "other-month");
        dayDiv.innerText = i;
        calendarDaysGrid.appendChild(dayDiv);
    }

    // Navigation buttons
    document.getElementById("prev-month-btn").onclick = () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentYear, currentMonth);
    };

    document.getElementById("next-month-btn").onclick = () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentYear, currentMonth);
    };
}

function updateCalendarHighlights() {
    document.querySelectorAll(".calendar-day").forEach(dayDiv => {
        const dateStr = dayDiv.dataset.date;
        if (dateStr) {
            let hasWorkout = false;
            if (USER_SESSION.isLoggedIn) {
                hasWorkout = !!USER_WORKOUTS[dateStr];
            } else {
                hasWorkout = !!localStorage.getItem(`arc_workout_${dateStr}`);
            }
            if (hasWorkout) {
                dayDiv.classList.add("completed");
            } else {
                dayDiv.classList.remove("completed");
            }
        }
    });
}

// Workout Log Controller
function loadWorkoutForDate(dateStr) {
    const existingLog = getWorkoutLog(dateStr);
    
    // Update daily body weight input display
    const weightInput = document.getElementById("daily-weight-input");
    if (existingLog && existingLog.bodyWeight) {
        weightInput.value = existingLog.bodyWeight;
    } else {
        weightInput.value = "";
    }

    // Update notes
    const notesInput = document.getElementById("workout-notes");
    notesInput.value = (existingLog && existingLog.notes) ? existingLog.notes : "";

    if (existingLog) {
        // Set routine selector dropdown
        const routineSelector = document.getElementById("routine-selector");
        routineSelector.value = existingLog.routineId !== undefined ? existingLog.routineId : "";
        
        // Show routine title
        document.getElementById("routine-focus").innerHTML = `<span class="focus-badge">Focus</span> ${existingLog.routineFocus || 'General Workout'}`;
        
        // Render logged exercises
        renderLoggedExercises(existingLog.exercises);
    } else {
        // No log exists yet for this date. Default to the weekday routine!
        const parts = dateStr.split('-');
        const dateObj = new Date(parts[0], parts[1] - 1, parts[2]);
        const dayOfWeek = dateObj.getDay(); // 0 is Sunday, 1 is Monday...
        
        // Convert getDay() to routine index
        // Sunday (0) -> Rest Day (0)
        // Mon-Sat (1-6) -> Day 1-6 (1-6)
        let defaultRoutineId = dayOfWeek;
        
        const routineSelector = document.getElementById("routine-selector");
        routineSelector.value = defaultRoutineId;
        
        loadRoutineStructure(defaultRoutineId);
    }
}

// Load routine layout from static definition
function loadRoutineStructure(routineId) {
    const routine = WORKOUT_ROUTINES[routineId];
    if (!routine) return;

    document.getElementById("routine-focus").innerHTML = `<span class="focus-badge">Focus</span> ${routine.focus}`;
    
    const container = document.getElementById("exercises-container");
    container.innerHTML = "";

    if (routine.exercises.length === 0) {
        container.innerHTML = `
            <div class="rest-day-message">
                <i class="fa-solid fa-mug-hot rest-icon"></i>
                <h3>Rest & Recover</h3>
                <p>No exercises scheduled for today. Spend time stretching, hydrating, and focusing on quality sleep and nutrition.</p>
                <button type="button" class="btn btn-sm btn-orange" id="rest-day-pdf-btn" style="margin-top: 15px; margin-bottom: 15px;"><i class="fa-solid fa-file-pdf"></i> Download Weekly Progress PDF</button>
                <p class="small text-muted">You can still add custom exercises using the button below if you are doing active recovery or a makeup workout.</p>
            </div>
        `;
        setTimeout(() => {
            const restPdfBtn = document.getElementById("rest-day-pdf-btn");
            if (restPdfBtn) {
                restPdfBtn.onclick = () => {
                    const range = getWeekRange(selectedDate);
                    generateWeeklyPdfReport(range.mondayStr, range.sundayStr, range.allDates);
                };
            }
        }, 10);
        return;
    }

    routine.exercises.forEach(ex => {
        // Get last session weight/reps for this exercise
        const lastTime = getExerciseLastTime(ex.name, selectedDate);
        
        // Generate exercise card
        const card = createExerciseCardHTML(ex.name, ex.target, ex.sets, ex.reps, ex.rest, lastTime, []);
        container.appendChild(card);
    });
}

function renderLoggedExercises(loggedExercises) {
    const container = document.getElementById("exercises-container");
    container.innerHTML = "";

    if (!loggedExercises || loggedExercises.length === 0) {
        container.innerHTML = `
            <div class="rest-day-message">
                <i class="fa-solid fa-circle-info rest-icon"></i>
                <h3>Empty Workout Log</h3>
                <p>Select a routine or add custom exercises to get started.</p>
                <button type="button" class="btn btn-sm btn-orange" id="rest-day-pdf-btn" style="margin-top: 15px; margin-bottom: 15px;"><i class="fa-solid fa-file-pdf"></i> Download Weekly Progress PDF</button>
            </div>
        `;
        setTimeout(() => {
            const restPdfBtn = document.getElementById("rest-day-pdf-btn");
            if (restPdfBtn) {
                restPdfBtn.onclick = () => {
                    const range = getWeekRange(selectedDate);
                    generateWeeklyPdfReport(range.mondayStr, range.sundayStr, range.allDates);
                };
            }
        }, 10);
        return;
    }

    loggedExercises.forEach(ex => {
        const lastTime = getExerciseLastTime(ex.name, selectedDate);
        const card = createExerciseCardHTML(ex.name, ex.target || "General", ex.sets || ex.setsList?.length || 3, ex.reps || "8-12", ex.rest || 90, lastTime, ex.setsList || []);
        container.appendChild(card);
    });
}

// Generate the DOM element for an exercise card
function createExerciseCardHTML(name, target, numSets, defaultReps, restTimeSec, lastTimeData, savedSets = []) {
    const card = document.createElement("div");
    card.classList.add("exercise-card");
    card.dataset.name = name;
    card.dataset.target = target;
    card.dataset.defaultReps = defaultReps;
    card.dataset.rest = restTimeSec;

    // Header info
    let lastTimeHTML = "";
    if (lastTimeData) {
        const dateFormatted = lastTimeData.date.split('-').slice(1).join('/'); // MM/DD
        const setStrings = lastTimeData.sets.map((s, idx) => `S${idx+1}: <strong>${s.weight}kg</strong>x${s.reps}`).join(', ');
        lastTimeHTML = `
            <div class="last-time-box">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Last Time (${dateFormatted}): ${setStrings}</span>
            </div>
        `;
    } else {
        lastTimeHTML = `
            <div class="last-time-box empty">
                <i class="fa-solid fa-star"></i>
                <span>First time tracking this exercise!</span>
            </div>
        `;
    }

    // Build sets UI
    let setsListHTML = "";
    const setsToRender = savedSets.length > 0 ? savedSets : Array.from({ length: numSets }, (_, i) => ({
        weight: lastTimeData && lastTimeData.sets[i] ? lastTimeData.sets[i].weight : "",
        reps: lastTimeData && lastTimeData.sets[i] ? lastTimeData.sets[i].reps : (typeof defaultReps === 'string' ? defaultReps.split('-')[0] : 10),
        completed: false
    }));

    card.innerHTML = `
        <div class="exercise-header">
            <div>
                <h4 class="exercise-title">${name}</h4>
                <span class="exercise-tag tag-${target.toLowerCase().replace(/[^a-z]/g, '')}">${target}</span>
            </div>
            <div class="exercise-meta">
                <span><i class="fa-solid fa-repeat"></i> ${defaultReps} reps</span>
                <span><i class="fa-solid fa-hourglass-half"></i> ${Math.floor(restTimeSec / 60)}:${(restTimeSec % 60).toString().padStart(2, '0')}</span>
            </div>
        </div>
        
        ${lastTimeHTML}

        <div class="sets-table">
            <div class="sets-header-row">
                <span>Set</span>
                <span>Prev</span>
                <span>Weight (kg)</span>
                <span>Reps</span>
                <span>Done</span>
            </div>
            <div class="sets-body">
                <!-- Dynamically filled sets -->
            </div>
        </div>

        <div class="exercise-actions">
            <button type="button" class="btn btn-sm btn-outline btn-add-set"><i class="fa-solid fa-plus"></i> Add Set</button>
            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-set"><i class="fa-solid fa-minus"></i> Remove Set</button>
            <button type="button" class="btn btn-sm btn-orange btn-timer-trigger"><i class="fa-solid fa-hourglass-start"></i> Start Rest</button>
        </div>
    `;

    const setsBody = card.querySelector(".sets-body");

    // Populate Sets
    setsToRender.forEach((set, idx) => {
        const prevWeightText = (lastTimeData && lastTimeData.sets[idx]) ? `${lastTimeData.sets[idx].weight}kg` : "—";
        const row = document.createElement("div");
        row.classList.add("set-row");
        if (set.completed) row.classList.add("completed");

        row.innerHTML = `
            <span class="set-number">${idx + 1}</span>
            <span class="set-prev">${prevWeightText}</span>
            <input type="number" class="set-weight" placeholder="kg" value="${set.weight}" step="any">
            <input type="number" class="set-reps" placeholder="reps" value="${set.reps}">
            <label class="checkbox-container">
                <input type="checkbox" class="set-completed" ${set.completed ? "checked" : ""}>
                <span class="checkmark"></span>
            </label>
        `;

        // Checkbox complete event
        const checkbox = row.querySelector(".set-completed");
        checkbox.addEventListener("change", (e) => {
            if (e.target.checked) {
                row.classList.add("completed");
                // Trigger rest timer automatically on checking completed set
                triggerRestTimer(restTimeSec, name);
            } else {
                row.classList.remove("completed");
            }
        });

        setsBody.appendChild(row);
    });

    // Add Set Action
    card.querySelector(".btn-add-set").addEventListener("click", () => {
        const nextSetIndex = setsBody.children.length;
        const lastRow = setsBody.lastElementChild;
        let lastWeight = "";
        let lastReps = 10;
        
        if (lastRow) {
            lastWeight = lastRow.querySelector(".set-weight").value;
            lastReps = lastRow.querySelector(".set-reps").value;
        }

        const prevWeightText = (lastTimeData && lastTimeData.sets[nextSetIndex]) ? `${lastTimeData.sets[nextSetIndex].weight}kg` : "—";
        const row = document.createElement("div");
        row.classList.add("set-row");

        row.innerHTML = `
            <span class="set-number">${nextSetIndex + 1}</span>
            <span class="set-prev">${prevWeightText}</span>
            <input type="number" class="set-weight" placeholder="kg" value="${lastWeight}" step="any">
            <input type="number" class="set-reps" placeholder="reps" value="${lastReps}">
            <label class="checkbox-container">
                <input type="checkbox" class="set-completed">
                <span class="checkmark"></span>
            </label>
        `;

        const checkbox = row.querySelector(".set-completed");
        checkbox.addEventListener("change", (e) => {
            if (e.target.checked) {
                row.classList.add("completed");
                triggerRestTimer(restTimeSec, name);
            } else {
                row.classList.remove("completed");
            }
        });

        setsBody.appendChild(row);
    });

    // Remove Set Action
    card.querySelector(".btn-remove-set").addEventListener("click", () => {
        if (setsBody.children.length > 1) {
            setsBody.removeChild(setsBody.lastElementChild);
        }
    });

    // Action button rest timer
    card.querySelector(".btn-timer-trigger").addEventListener("click", () => {
        triggerRestTimer(restTimeSec, name);
    });

    return card;
}

// Add Custom Exercise
function addCustomExercise() {
    const name = prompt("Enter Exercise Name:");
    if (!name) return;
    
    const target = prompt("Target Muscle Group (e.g. Chest, Back, Legs, Arms, Core):", "General") || "General";
    const sets = parseInt(prompt("Number of Sets:", "3")) || 3;
    const reps = prompt("Target Reps (e.g. 8-12):", "10") || "10";
    const rest = parseInt(prompt("Rest Time (seconds):", "90")) || 90;

    const container = document.getElementById("exercises-container");
    
    // Clear rest-day-message if present
    const restMessage = container.querySelector(".rest-day-message");
    if (restMessage) {
        container.innerHTML = "";
    }

    const card = createExerciseCardHTML(name, target, sets, reps, rest, null, []);
    container.appendChild(card);
    card.scrollIntoView({ behavior: 'smooth' });
}

// Save Workout Data to Local Storage
function saveCurrentWorkout() {
    const exercises = [];
    const cards = document.querySelectorAll("#exercises-container .exercise-card");

    cards.forEach(card => {
        const name = card.dataset.name;
        const target = card.dataset.target;
        const rest = parseInt(card.dataset.rest);
        const reps = card.dataset.defaultReps;
        
        const setsList = [];
        const rows = card.querySelectorAll(".sets-body .set-row");
        
        rows.forEach(row => {
            const weightVal = parseFloat(row.querySelector(".set-weight").value);
            const repsVal = parseInt(row.querySelector(".set-reps").value);
            const completed = row.querySelector(".set-completed").checked;

            if (!isNaN(repsVal)) {
                setsList.push({
                    weight: isNaN(weightVal) ? 0 : weightVal,
                    reps: repsVal,
                    completed: completed
                });
            }
        });

        if (setsList.length > 0) {
            exercises.push({
                name: name,
                target: target,
                rest: rest,
                reps: reps,
                setsList: setsList
            });
        }
    });

    const bodyWeight = parseFloat(document.getElementById("daily-weight-input").value);
    const notes = document.getElementById("workout-notes").value;
    const routineSelector = document.getElementById("routine-selector");
    const routineId = routineSelector.value !== "" ? parseInt(routineSelector.value) : null;
    const routineFocusText = document.getElementById("routine-focus").innerText.replace("Focus ", "");

    if (exercises.length === 0 && isNaN(bodyWeight) && !notes) {
        showToast("Cannot save empty logs!", "error");
        return;
    }

    const payload = {
        date: selectedDate,
        routineId: routineId,
        routineName: routineId !== null && WORKOUT_ROUTINES[routineId] ? WORKOUT_ROUTINES[routineId].name : "Custom Workout",
        routineFocus: routineFocusText,
        exercises: exercises,
        bodyWeight: isNaN(bodyWeight) ? null : bodyWeight,
        notes: notes
    };

    saveWorkoutLog(selectedDate, payload);
    showToast("Workout saved successfully!", "success");
    
    // Re-render progression page stats and weight logs
    updateProgressionChart();
    updateWeightChart();
}

// Clear Workout Log
function clearCurrentWorkout() {
    if (confirm("Are you sure you want to clear workout records for this date? This cannot be undone.")) {
        deleteWorkoutLog(selectedDate);
        loadWorkoutForDate(selectedDate);
        showToast("Log cleared for selected date.", "success");
        updateProgressionChart();
        updateWeightChart();
    }
}

// Daily Body Weight Input Setup
function setupBodyWeightLogger() {
    const weightInput = document.getElementById("daily-weight-input");
    weightInput.addEventListener("change", async () => {
        // Autosave body weight if a workout session log is running or just started
        const bodyWeight = parseFloat(weightInput.value);
        if (!isNaN(bodyWeight)) {
            let existing = getWorkoutLog(selectedDate);
            if (!existing) {
                existing = {
                    date: selectedDate,
                    routineId: null,
                    routineName: "Weight Log Only",
                    routineFocus: "Body Metrics",
                    exercises: [],
                    bodyWeight: bodyWeight,
                    notes: ""
                };
            } else {
                existing.bodyWeight = bodyWeight;
            }
            await saveWorkoutLog(selectedDate, existing);
            showToast("Body weight updated!", "success");
            updateWeightChart();
        }
    });
}

// Web Audio API Beep Generator
function initAudio() {
    if (!audioCtx) {
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }
}

function playBeep(frequency = 587.33, duration = 0.3) {
    try {
        initAudio();
        const osc = audioCtx.createOscillator();
        const gainNode = audioCtx.createGain();

        osc.connect(gainNode);
        gainNode.connect(audioCtx.destination);

        osc.frequency.value = frequency; // D5 pitch
        osc.type = "sine";

        gainNode.gain.setValueAtTime(0.3, audioCtx.currentTime);
        // Exponential decay
        gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + duration);

        osc.start(audioCtx.currentTime);
        osc.stop(audioCtx.currentTime + duration);
    } catch (e) {
        console.error("Audio beep error:", e);
    }
}

// Rest Countdown Timer Controller
function setupRestTimer() {
    const timerOverlay = document.getElementById("timer-overlay");
    const closeBtn = document.getElementById("timer-close-btn");
    const skipBtn = document.getElementById("timer-skip-btn");
    const add15Btn = document.getElementById("timer-add15-btn");

    closeBtn.onclick = hideTimer;
    skipBtn.onclick = hideTimer;
    
    add15Btn.onclick = () => {
        timerSecondsLeft += 15;
        updateTimerDisplay();
    };
}

function triggerRestTimer(seconds, exerciseName) {
    if (timerInterval) clearInterval(timerInterval);
    
    initAudio(); // Initialize audio context on user interaction
    
    document.getElementById("timer-exercise-name").innerText = exerciseName;
    timerSecondsLeft = seconds;
    updateTimerDisplay();
    
    const timerOverlay = document.getElementById("timer-overlay");
    timerOverlay.classList.add("active");
    
    timerInterval = setInterval(() => {
        timerSecondsLeft--;
        updateTimerDisplay();
        
        if (timerSecondsLeft <= 0) {
            clearInterval(timerInterval);
            timerInterval = null;
            // Play alert beeps
            playBeep(659.25, 0.2); // E5
            setTimeout(() => playBeep(659.25, 0.2), 250);
            setTimeout(() => playBeep(880.00, 0.4), 500); // A5 high note
            
            document.getElementById("timer-countdown").innerText = "REST DONE!";
            setTimeout(hideTimer, 2000);
        } else if (timerSecondsLeft <= 3) {
            // Ticking sound
            playBeep(440, 0.05); // A4
        }
    }, 1000);
}

function updateTimerDisplay() {
    const mins = Math.floor(timerSecondsLeft / 60);
    const secs = timerSecondsLeft % 60;
    document.getElementById("timer-countdown").innerText = `${mins}:${secs.toString().padStart(2, '0')}`;
}

function hideTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
    }
    document.getElementById("timer-overlay").classList.remove("active");
}

// Toast Notifications
function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <i class="${type === 'success' ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-exclamation'}"></i>
        <span>${message}</span>
    `;
    
    document.getElementById("toast-container").appendChild(toast);
    
    // Trigger entrance animation
    setTimeout(() => toast.classList.add("show"), 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Progression Analytics & Charting
function setupProgressionAnalytics() {
    const exerciseSelector = document.getElementById("analytics-exercise-selector");
    
    // Populate the progression dropdown with unique exercises
    const allExercises = new Set();
    
    // Pre-populate with all library exercises (base + custom)
    if (typeof EXERCISE_LIBRARY !== 'undefined') {
        EXERCISE_LIBRARY.forEach(ex => allExercises.add(ex.name));
    }
    
    // Check customized active weekly routines
    Object.values(WORKOUT_ROUTINES).forEach(routine => {
        if (routine.exercises) {
            routine.exercises.forEach(ex => allExercises.add(ex.name));
        }
    });
    
    // Check logged exercises from database cache or local storage
    if (USER_SESSION.isLoggedIn) {
        Object.values(USER_WORKOUTS).forEach(log => {
            if (log && log.exercises) {
                log.exercises.forEach(e => allExercises.add(e.name));
            }
        });
    } else {
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            if (key.startsWith('arc_workout_')) {
                try {
                    const log = JSON.parse(localStorage.getItem(key));
                    if (log && log.exercises) {
                        log.exercises.forEach(e => allExercises.add(e.name));
                    }
                } catch (err) {}
            }
        }
    }

    // Clear and populate dropdown
    exerciseSelector.innerHTML = '<option value="">-- Choose Exercise --</option>';
    Array.from(allExercises).sort().forEach(exName => {
        const opt = document.createElement("option");
        opt.value = exName;
        opt.innerText = exName;
        exerciseSelector.appendChild(opt);
    });

    exerciseSelector.addEventListener("change", updateProgressionChart);

    // Initial chart rendering
    updateProgressionChart();
    updateWeightChart();
}

function updateProgressionChart() {
    const selectedEx = document.getElementById("analytics-exercise-selector").value;
    const ctx = document.getElementById("progression-chart").getContext("2d");

    if (!selectedEx) {
        if (progressionChartInstance) {
            progressionChartInstance.destroy();
            progressionChartInstance = null;
        }
        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        // Show indicator message
        return;
    }

    // Extract records chronologically
    const records = [];
    let sourceKeys = [];
    if (USER_SESSION.isLoggedIn) {
        sourceKeys = Object.keys(USER_WORKOUTS);
    } else {
        sourceKeys = Object.keys(localStorage)
            .filter(k => k.startsWith('arc_workout_'))
            .map(k => k.replace('arc_workout_', ''));
    }
    const keys = sourceKeys.sort((a, b) => a.localeCompare(b)); // Ascending chronological

    keys.forEach(dStr => {
        const log = getWorkoutLog(dStr);
        if (log && log.exercises) {
            const ex = log.exercises.find(e => e.name.toLowerCase() === selectedEx.toLowerCase());
            if (ex) {
                // Calculate max weight and volume
                let maxWeight = 0;
                let volume = 0;
                let repsList = [];
                
                const sets = ex.setsList || [];
                sets.forEach(s => {
                    // Count any set marked as completed or containing entered weight and reps
                    if (s.completed || (s.weight > 0 && s.reps > 0)) {
                        if (s.weight > maxWeight) maxWeight = s.weight;
                        volume += (s.weight * s.reps);
                        repsList.push(`${s.weight}kg x ${s.reps}`);
                    }
                });

                if (maxWeight > 0) {
                    records.push({
                        date: dStr,
                        maxWeight: maxWeight,
                        volume: volume,
                        details: repsList.join(" | ")
                    });
                }
            }
        }
    });

    if (progressionChartInstance) {
        progressionChartInstance.destroy();
    }

    if (records.length === 0) {
        // No records logged for this exercise
        showToast(`No completed sets logged for "${selectedEx}" yet.`, "info");
        return;
    }

    const labels = records.map(r => {
        const parts = r.date.split('-');
        return `${parts[1]}/${parts[2]}`; // MM/DD
    });
    const maxWeights = records.map(r => r.maxWeight);
    const volumes = records.map(r => r.volume);

    progressionChartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Max Weight Lifted (kg)',
                    data: maxWeights,
                    borderColor: '#ff6000',
                    backgroundColor: 'rgba(255, 96, 0, 0.1)',
                    borderWidth: 3,
                    tension: 0.25,
                    fill: true,
                    yAxisID: 'y'
                },
                {
                    label: 'Total Volume (Weight x Reps)',
                    data: volumes,
                    borderColor: '#111112',
                    backgroundColor: 'rgba(17, 17, 18, 0.05)',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    tension: 0.2,
                    fill: false,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: { family: 'Outfit', size: 12 }
                    }
                },
                tooltip: {
                    callbacks: {
                        footer: (context) => {
                            const index = context[0].dataIndex;
                            return `Sets: ${records[index].details}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: { display: true, text: 'Max Weight (kg)' },
                    grid: { color: '#eaeaea' }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: { display: true, text: 'Volume (kg)' },
                    grid: { drawOnChartArea: false } // only show grid lines for left axis
                }
            }
        }
    });
}

function updateWeightChart() {
    const ctx = document.getElementById("weight-chart").getContext("2d");
    
    const records = [];
    let sourceKeys = [];
    if (USER_SESSION.isLoggedIn) {
        sourceKeys = Object.keys(USER_WORKOUTS);
    } else {
        sourceKeys = Object.keys(localStorage)
            .filter(k => k.startsWith('arc_workout_'))
            .map(k => k.replace('arc_workout_', ''));
    }
    const keys = sourceKeys.sort((a, b) => a.localeCompare(b));

    keys.forEach(dStr => {
        const log = getWorkoutLog(dStr);
        if (log && log.bodyWeight) {
            records.push({
                date: dStr,
                weight: log.bodyWeight
            });
        }
    });

    if (weightChartInstance) {
        weightChartInstance.destroy();
    }

    if (records.length === 0) {
        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        return;
    }

    const labels = records.map(r => {
        const parts = r.date.split('-');
        return `${parts[1]}/${parts[2]}`;
    });
    const weights = records.map(r => r.weight);

    weightChartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Body Weight (kg)',
                data: weights,
                borderColor: '#2e7d32',
                backgroundColor: 'rgba(46, 125, 50, 0.1)',
                borderWidth: 2,
                tension: 0.15,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { grid: { display: false } },
                y: { title: { display: true, text: 'Body Weight (kg)' } }
            }
        }
    });
}

// Workout Completion Streak Counters
function updateStreaks() {
    let sourceKeys = [];
    if (USER_SESSION.isLoggedIn) {
        sourceKeys = Object.keys(USER_WORKOUTS);
    } else {
        sourceKeys = Object.keys(localStorage)
            .filter(k => k.startsWith('arc_workout_'))
            .map(k => k.replace('arc_workout_', ''));
    }
    const keys = sourceKeys.sort((a, b) => b.localeCompare(a)); // Descending chronological

    let totalWorkouts = keys.length;
    let currentStreak = 0;
    
    if (totalWorkouts > 0) {
        const todayStr = getFormattedDate(new Date());
        const yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);
        const yesterdayStr = getFormattedDate(yesterday);

        // Check if user has logged today or yesterday to start streak counting
        if (keys[0] === todayStr || keys[0] === yesterdayStr) {
            let expectedDate = new Date(keys[0].split('-')[0], keys[0].split('-')[1] - 1, keys[0].split('-')[2]);
            currentStreak = 1;
            
            for (let i = 1; i < keys.length; i++) {
                expectedDate.setDate(expectedDate.getDate() - 1);
                const expectedStr = getFormattedDate(expectedDate);
                
                if (keys[i] === expectedStr) {
                    currentStreak++;
                } else if (keys[i] > expectedStr) {
                    // Duplicate logged on same day (shouldn't happen with our calendar)
                    continue;
                } else {
                    // Gap detected in streak
                    break;
                }
            }
        }
    }

    document.getElementById("current-streak-val").innerText = `${currentStreak} Days`;
    document.getElementById("total-sessions-val").innerText = totalWorkouts;
}

// JSON Backup / Restore Tools
function setupBackupTools() {
    const exportBtn = document.getElementById("backup-export-btn");
    const importBtn = document.getElementById("backup-import-btn");
    const importInput = document.getElementById("backup-import-input");

    exportBtn.onclick = () => {
        const data = {};
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            if (key.startsWith('arc_workout_')) {
                data[key] = localStorage.getItem(key);
            }
        }
        
        const jsonStr = JSON.stringify(data, null, 2);
        const blob = new Blob([jsonStr], { type: "application/json" });
        const url = URL.createObjectURL(blob);
        
        const a = document.createElement("a");
        a.href = url;
        a.download = `arc_gym_workout_backup_${getFormattedDate(new Date())}.json`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        showToast("Workout history exported!", "success");
    };

    importBtn.onclick = () => {
        importInput.click();
    };

    importInput.onchange = (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (event) => {
            try {
                const parsed = JSON.parse(event.target.result);
                let importedCount = 0;
                
                Object.keys(parsed).forEach(key => {
                    if (key.startsWith('arc_workout_')) {
                        localStorage.setItem(key, parsed[key]);
                        importedCount++;
                    }
                });

                if (importedCount > 0) {
                    showToast(`Successfully imported ${importedCount} workouts!`, "success");
                    // Reload data
                    renderCalendar(currentYear, currentMonth);
                    loadWorkoutForDate(selectedDate);
                    setupProgressionAnalytics();
                    updateStreaks();
                } else {
                    showToast("No valid ARC workout records found in file.", "error");
                }
            } catch (err) {
                showToast("Failed to parse backup JSON file.", "error");
            }
        };
        reader.readAsText(file);
    };
}

// Testimonial Sliders
// Testimonial Sliders & Review Form Submission
async function setupTestimonials() {
    const testimonialTrack = document.getElementById("testimonial-track");
    if (!testimonialTrack) return;
    
    // Fetch reviews from server with hardcoded defaults as fallback
    let reviews = [
        { name: "Emily H.", review_text: "I've been a member of ARC Gym for over a year. The trainers are incredibly supportive and professional. But what I love most is the custom workout log on the website; I can track my lift progression on my phone and always know exactly what weight to set next!" },
        { name: "Alexandra T.", review_text: "The workout schedules align perfectly with my weekly routine. The embedded rest timer is a total gamechanger for keeping my workouts dense and efficient. Visualizing my max weight lift graphs in the progression panel has pushed me to beat my limits." },
        { name: "Marcus D.", review_text: "Exceptional facilities, but the local browser workout logger is by far my favorite feature. Knowing my sets and weights automatically pre-fill from my last session saves so much time compared to paper logs. Strongly recommend ARC!" }
    ];

    try {
        const res = await fetch('api.php?action=get_reviews');
        const json = await res.json();
        if (json.status === 'success' && json.data.length > 0) {
            reviews = json.data;
        }
    } catch (err) {
        console.error("Error fetching reviews:", err);
    }

    // Render cards
    testimonialTrack.innerHTML = "";
    reviews.forEach(r => {
        const card = document.createElement("div");
        card.className = "testimonial-card";
        card.innerHTML = `
            <p class="testimonial-text">"${r.review_text}"</p>
            <div class="testimonial-user">
                <span class="user-name">${r.name}</span>
                <i class="fa-solid fa-quote-right quote-icon"></i>
            </div>
        `;
        testimonialTrack.appendChild(card);
    });

    const cards = testimonialTrack.querySelectorAll(".testimonial-card");
    const prevBtn = document.getElementById("review-prev-btn");
    const nextBtn = document.getElementById("review-next-btn");
    let activeIndex = 0;

    function updateSlider() {
        if (cards.length === 0) return;
        const width = cards[0].offsetWidth + 24; // Card width + gap
        testimonialTrack.scrollTo({
            left: activeIndex * width,
            behavior: 'smooth'
        });
    }

    if (prevBtn && nextBtn) {
        prevBtn.onclick = () => {
            if (activeIndex > 0) {
                activeIndex--;
                updateSlider();
            }
        };

        nextBtn.onclick = () => {
            if (activeIndex < cards.length - 1) {
                activeIndex++;
                updateSlider();
            }
        };
    }

    // Write review form handler
    const addReviewForm = document.getElementById("add-review-form");
    if (addReviewForm) {
        addReviewForm.onsubmit = async (e) => {
            e.preventDefault();
            const textInput = document.getElementById("review-text-input");
            const reviewText = textInput.value.trim();

            if (!reviewText) return;

            try {
                const res = await fetch('api.php?action=add_review', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ text: reviewText })
                });
                const json = await res.json();
                if (json.status === 'success') {
                    showToast("Thank you for your review!", "success");
                    textInput.value = "";
                    
                    // Reload and render updated reviews
                    await setupTestimonials();
                } else {
                    showToast("Failed to submit review.", "error");
                }
            } catch (err) {
                console.error("Error submitting review:", err);
                showToast("Failed to submit review.", "error");
            }
        };
    }
}

// PDF Report Export Logic
function setupPdfExport() {
    const pdfReportBtn = document.getElementById("pdf-report-btn");
    const pdfModalOverlay = document.getElementById("pdf-modal-overlay");
    const pdfModalCloseBtn = document.getElementById("pdf-modal-close-btn");
    const pdfModalCancelBtn = document.getElementById("pdf-modal-cancel-btn");
    const pdfModalConfirmBtn = document.getElementById("pdf-modal-confirm-btn");
    const pdfWeekDateInput = document.getElementById("pdf-week-date");
    const pdfWeekRangeDisplay = document.getElementById("pdf-week-range-display");

    if (!pdfReportBtn || !pdfModalOverlay) return;

    // Initialize date input to today
    const todayStr = getFormattedDate(new Date());
    pdfWeekDateInput.value = todayStr;
    updatePdfModalWeekDisplay(todayStr);

    pdfReportBtn.onclick = () => {
        pdfModalOverlay.classList.add("active");
    };

    const closeModal = () => {
        pdfModalOverlay.classList.remove("active");
    };

    pdfModalCloseBtn.onclick = closeModal;
    pdfModalCancelBtn.onclick = closeModal;

    pdfWeekDateInput.onchange = (e) => {
        updatePdfModalWeekDisplay(e.target.value);
    };

    pdfModalConfirmBtn.onclick = () => {
        const selectedVal = pdfWeekDateInput.value;
        if (!selectedVal) {
            showToast("Please select a date first.", "error");
            return;
        }
        
        const range = getWeekRange(selectedVal);
        generateWeeklyPdfReport(range.mondayStr, range.sundayStr, range.allDates);
        closeModal();
    };
}

function updatePdfModalWeekDisplay(dateVal) {
    if (!dateVal) return;
    const range = getWeekRange(dateVal);
    const display = document.getElementById("pdf-week-range-display");
    
    const formattedMon = new Date(range.mondayStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    const formattedSun = new Date(range.sundayStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    
    display.querySelector("span").innerText = `Selected Week: Mon, ${formattedMon} to Sun, ${formattedSun}`;
}

function getWeekRange(dateInputVal) {
    const parts = dateInputVal.split('-');
    const dateObj = new Date(parts[0], parts[1] - 1, parts[2]);
    const day = dateObj.getDay();
    // Monday is the start of our workout week (Day 1)
    // Sunday is the end of our workout week (Day 7 / 0 in JS getDay)
    // We adjust so Monday is first (dayIndex = 0), Sunday is last (dayIndex = 6)
    const diff = dateObj.getDate() - day + (day === 0 ? -6 : 1);
    const monday = new Date(dateObj.setDate(diff));
    
    const weekDates = [];
    for (let i = 0; i < 7; i++) {
        const nextDay = new Date(monday);
        nextDay.setDate(monday.getDate() + i);
        weekDates.push(getFormattedDate(nextDay));
    }
    
    return {
        mondayStr: weekDates[0],
        sundayStr: weekDates[6],
        allDates: weekDates
    };
}

function generateWeeklyPdfReport(mondayStr, sundayStr, allDates) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    let y = 20;
    
    // Helper to print text and auto page-break
    function printText(text, x, size = 10, style = 'normal', color = '#111112') {
        doc.setFont("Helvetica", style);
        doc.setFontSize(size);
        
        let r = 17, g = 17, b = 18;
        if (color === '#ff6000') { r = 255; g = 96; b = 0; }
        else if (color === '#6b7280') { r = 107; g = 114; b = 128; }
        else if (color === '#2e7d32') { r = 46; g = 125; b = 50; }
        
        doc.setTextColor(r, g, b);
        
        const splitText = doc.splitTextToSize(text, 180);
        splitText.forEach(line => {
            if (y > 275) {
                doc.addPage();
                y = 20;
            }
            doc.text(line, x, y);
            y += size * 0.45 + 2.5; // Line height
        });
    }

    function drawLine(color = '#eaeaea') {
        if (y > 275) {
            doc.addPage();
            y = 20;
        }
        let r = 234, g = 234, b = 234;
        if (color === '#ff6000') { r = 255; g = 96; b = 0; }
        
        doc.setDrawColor(r, g, b);
        doc.setLineWidth(0.5);
        doc.line(15, y, 195, y);
        y += 6;
    }
    
    // ARC Header styling
    printText("ARC GYM - WEEKLY PERFORMANCE REPORT", 15, 18, 'bold', '#111112');
    printText("NO PAIN, NO GAIN.", 15, 10, 'italic', '#ff6000');
    y += 2;
    
    const formattedMon = new Date(mondayStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    const formattedSun = new Date(sundayStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    printText(`Reporting Week: ${formattedMon} to ${formattedSun}`, 15, 11, 'bold', '#6b7280');
    drawLine('#ff6000');
    
    let totalCompletedSessions = 0;
    let totalWeeklyVolume = 0;
    let hasAnyLogs = false;
    
    allDates.forEach((dStr) => {
        const parts = dStr.split('-');
        const dObj = new Date(parts[0], parts[1] - 1, parts[2]);
        const weekdayName = dObj.toLocaleDateString('en-US', { weekday: 'long', month: 'short', day: 'numeric' });
        const log = getWorkoutLog(dStr);
        
        printText(weekdayName, 15, 12, 'bold', '#111112');
        y += 1;
        
        if (log && (log.exercises?.length > 0 || log.bodyWeight || log.notes)) {
            hasAnyLogs = true;
            totalCompletedSessions++;
            
            printText(`Routine: ${log.routineName || 'Custom'} (${log.routineFocus || 'Focus: General'})`, 20, 10, 'bold', '#ff6000');
            
            if (log.bodyWeight) {
                printText(`Body Weight: ${log.bodyWeight} kg`, 20, 9.5, 'bold', '#2e7d32');
            }
            
            if (log.exercises && log.exercises.length > 0) {
                log.exercises.forEach(ex => {
                    printText(`• ${ex.name} (${ex.target || 'General'})`, 20, 10, 'bold', '#111112');
                    
                    const sets = ex.setsList || [];
                    sets.forEach((s, sIdx) => {
                        const status = s.completed ? "COMPLETED" : "INCOMPLETE";
                        printText(`  Set ${sIdx + 1}: ${s.weight}kg x ${s.reps} reps - ${status}`, 25, 9, 'normal', s.completed ? '#2e7d32' : '#6b7280');
                        
                        if (s.completed) {
                            totalWeeklyVolume += (s.weight * s.reps);
                        }
                    });
                    y += 1.5;
                });
            }
            
            if (log.notes) {
                printText(`Notes: ${log.notes}`, 20, 9, 'italic', '#6b7280');
            }
        } else {
            printText("Rest Day / No Workouts Logged", 20, 9.5, 'normal', '#6b7280');
        }
        
        y += 3;
        drawLine();
    });

    if (!hasAnyLogs) {
        showToast("No workout records found for this week. Exporting default blank report.", "info");
    } else {
        showToast("PDF report generated successfully!", "success");
    }

    // Weekly summary panel
    printText("WEEKLY SUMMARY", 15, 14, 'bold', '#111112');
    y += 2;
    printText(`Completed Workouts: ${totalCompletedSessions} Days`, 15, 10, 'bold', '#111112');
    printText(`Total Volume: ${totalWeeklyVolume.toLocaleString()} kg`, 15, 10, 'bold', '#ff6000');
    
    y += 6;
    printText("Keep pushing your boundaries. ARC Gym.", 15, 10, 'italic', '#6b7280');
    
    doc.save(`arc_weekly_report_${mondayStr}_to_${sundayStr}.pdf`);
}

// Workout Plan Editor Setup & Controls
function setupPlanEditor() {
    const tabContainer = document.getElementById("plan-day-tabs");
    const savePlanBtn = document.getElementById("save-plan-btn");
    const searchInput = document.getElementById("library-search");
    const pillsContainer = document.getElementById("library-filter-pills");
    const addToLibBtn = document.getElementById("add-to-lib-btn");

    if (!tabContainer || !savePlanBtn) return;

    // Tab selection
    tabContainer.querySelectorAll("button").forEach(btn => {
        btn.addEventListener("click", () => {
            tabContainer.querySelectorAll("button").forEach(b => b.className = "btn btn-sm btn-outline");
            btn.className = "btn btn-sm btn-dark active";
            activePlanDay = parseInt(btn.dataset.day);
            loadActivePlanDay();
        });
    });

    // Search filter
    searchInput.addEventListener("input", (e) => {
        librarySearchQuery = e.target.value;
        renderLibrary();
    });

    // Pill filters
    pillsContainer.querySelectorAll("button").forEach(btn => {
        btn.addEventListener("click", () => {
            pillsContainer.querySelectorAll("button").forEach(b => b.className = "btn btn-sm btn-outline");
            btn.className = "btn btn-sm btn-dark active-pill";
            libraryCategoryFilter = btn.dataset.filter;
            renderLibrary();
        });
    });

    // Add to library
    addToLibBtn.onclick = addCustomExerciseToLibrary;

    // Save button
    savePlanBtn.onclick = saveCustomPlan;

    // Load default active day
    loadActivePlanDay();
    renderLibrary();
}

function loadActivePlanDay() {
    const routine = WORKOUT_ROUTINES[activePlanDay];
    if (!routine) return;

    document.getElementById("plan-routine-name").value = routine.name || "";
    document.getElementById("plan-routine-focus").value = routine.focus || "";

    // Deep copy current exercises list
    activePlanExercises = JSON.parse(JSON.stringify(routine.exercises || []));
    renderPlanExercises();
}

function renderPlanExercises() {
    const container = document.getElementById("plan-exercises-list");
    container.innerHTML = "";

    if (activePlanExercises.length === 0) {
        container.innerHTML = `<p class="text-muted" style="text-align:center; padding:20px; font-weight:500;">No exercises in this routine yet. Add from the library on the right!</p>`;
        return;
    }

    activePlanExercises.forEach((ex, index) => {
        const row = document.createElement("div");
        row.className = "plan-ex-row";
        row.innerHTML = `
            <div class="plan-ex-info">
                <span class="plan-ex-name">${ex.name}</span>
                <span class="exercise-tag tag-${ex.target.toLowerCase().replace(/[^a-z]/g, '')}" style="align-self: flex-start;">${ex.target}</span>
            </div>
            <div class="plan-ex-fields">
                <div class="plan-ex-field-group">
                    <label>Sets</label>
                    <input type="number" class="plan-sets-input" value="${ex.sets || 3}" min="1">
                </div>
                <div class="plan-ex-field-group">
                    <label>Reps</label>
                    <input type="text" class="plan-reps-input wide" value="${ex.reps || '10'}">
                </div>
                <div class="plan-ex-field-group">
                    <label>Rest (s)</label>
                    <input type="number" class="plan-rest-input wide" value="${ex.rest || 90}" min="10" step="5">
                </div>
            </div>
            <div class="plan-ex-actions">
                <button type="button" class="plan-ex-btn btn-up" title="Move Up"><i class="fa-solid fa-arrow-up"></i></button>
                <button type="button" class="plan-ex-btn btn-down" title="Move Down"><i class="fa-solid fa-arrow-down"></i></button>
                <button type="button" class="plan-ex-btn btn-delete" title="Delete"><i class="fa-solid fa-trash"></i></button>
            </div>
        `;

        // Sets value edit binding
        row.querySelector(".plan-sets-input").onchange = (e) => {
            ex.sets = parseInt(e.target.value) || 3;
        };
        // Reps value edit binding
        row.querySelector(".plan-reps-input").onchange = (e) => {
            ex.reps = e.target.value || "10";
        };
        // Rest value edit binding
        row.querySelector(".plan-rest-input").onchange = (e) => {
            ex.rest = parseInt(e.target.value) || 90;
        };

        // Up button action
        row.querySelector(".btn-up").onclick = () => {
            if (index > 0) {
                const temp = activePlanExercises[index];
                activePlanExercises[index] = activePlanExercises[index - 1];
                activePlanExercises[index - 1] = temp;
                renderPlanExercises();
            }
        };

        // Down button action
        row.querySelector(".btn-down").onclick = () => {
            if (index < activePlanExercises.length - 1) {
                const temp = activePlanExercises[index];
                activePlanExercises[index] = activePlanExercises[index + 1];
                activePlanExercises[index + 1] = temp;
                renderPlanExercises();
            }
        };

        // Delete action
        row.querySelector(".btn-delete").onclick = () => {
            activePlanExercises.splice(index, 1);
            renderPlanExercises();
        };

        container.appendChild(row);
    });
}

function renderLibrary() {
    const container = document.getElementById("library-results");
    container.innerHTML = "";

    const searchLower = librarySearchQuery.toLowerCase();
    
    const filtered = EXERCISE_LIBRARY.filter(ex => {
        const matchesSearch = ex.name.toLowerCase().includes(searchLower);
        const matchesFilter = libraryCategoryFilter === "All" || ex.target.toLowerCase() === libraryCategoryFilter.toLowerCase();
        return matchesSearch && matchesFilter;
    });

    if (filtered.length === 0) {
        container.innerHTML = `<p class="text-muted" style="text-align:center; padding:15px; font-size:0.85rem;">No matching exercises found.</p>`;
        return;
    }

    filtered.forEach(ex => {
        const isCustom = customExercises.some(ce => ce.name.toLowerCase() === ex.name.toLowerCase());
        
        const card = document.createElement("div");
        card.className = "lib-ex-card";
        
        let actionHTML = `<button type="button" class="btn btn-sm btn-orange btn-add-lib-ex" style="padding: 4px 10px; font-size: 0.75rem;"><i class="fa-solid fa-plus"></i> Add</button>`;
        if (isCustom) {
            actionHTML = `
                <div style="display:flex; gap:5px; align-items:center;">
                    <button type="button" class="plan-ex-btn btn-delete btn-delete-lib-ex" title="Remove from Library" style="border-color: rgba(220,53,69,0.3); color:#dc3545; height: 26px; width: 26px; font-size: 0.7rem;"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="btn btn-sm btn-orange btn-add-lib-ex" style="padding: 4px 10px; font-size: 0.75rem;"><i class="fa-solid fa-plus"></i> Add</button>
                </div>
            `;
        }

        card.innerHTML = `
            <div>
                <div class="lib-ex-title">${ex.name}</div>
                <span class="exercise-tag tag-${ex.target.toLowerCase().replace(/[^a-z]/g, '')}">${ex.target}</span>
            </div>
            ${actionHTML}
        `;

        card.querySelector(".btn-add-lib-ex").onclick = () => {
            activePlanExercises.push({
                name: ex.name,
                target: ex.target,
                sets: 3,
                reps: "8-12",
                rest: 90
            });
            renderPlanExercises();
            showToast(`Added "${ex.name}" to Day ${activePlanDay}!`, "success");
        };

        if (isCustom) {
            card.querySelector(".btn-delete-lib-ex").onclick = async () => {
                if (confirm(`Are you sure you want to delete "${ex.name}" from the exercise library?`)) {
                    if (USER_SESSION.isLoggedIn) {
                        try {
                            const res = await fetch('api.php?action=delete_custom_exercise', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ name: ex.name })
                            });
                            const json = await res.json();
                            if (json.status === 'success') {
                                customExercises = customExercises.filter(ce => ce.name.toLowerCase() !== ex.name.toLowerCase());
                                EXERCISE_LIBRARY = BASE_EXERCISE_LIBRARY.concat(customExercises);
                            } else {
                                showToast("Failed to delete exercise from server: " + json.message, "error");
                                return;
                            }
                        } catch (err) {
                            console.error("Error deleting exercise:", err);
                            showToast("Failed to delete exercise from server.", "error");
                            return;
                        }
                    } else {
                        customExercises = customExercises.filter(ce => ce.name.toLowerCase() !== ex.name.toLowerCase());
                        localStorage.setItem('arc_custom_exercises', JSON.stringify(customExercises));
                        EXERCISE_LIBRARY = BASE_EXERCISE_LIBRARY.concat(customExercises);
                    }
                    
                    renderLibrary();
                    setupProgressionAnalytics();
                    showToast(`"${ex.name}" removed from library.`, "success");
                }
            };
        }

        container.appendChild(card);
    });
}

async function addCustomExerciseToLibrary() {
    const nameInput = document.getElementById("custom-ex-name");
    const catSelect = document.getElementById("custom-ex-category");

    const name = nameInput.value.trim();
    const category = catSelect.value;

    if (!name) {
        showToast("Please enter an exercise name.", "error");
        return;
    }

    const dup = EXERCISE_LIBRARY.find(e => e.name.toLowerCase() === name.toLowerCase());
    if (dup) {
        showToast("Exercise already exists in library.", "error");
        return;
    }

    const newEx = { name: name, target: category };
    
    if (USER_SESSION.isLoggedIn) {
        try {
            const res = await fetch('api.php?action=add_custom_exercise', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(newEx)
            });
            const json = await res.json();
            if (json.status === 'success') {
                customExercises.push(newEx);
                EXERCISE_LIBRARY = BASE_EXERCISE_LIBRARY.concat(customExercises);
            } else {
                showToast("Failed to add exercise to server: " + json.message, "error");
                return;
            }
        } catch (err) {
            console.error("Error saving exercise:", err);
            showToast("Failed to save exercise to server.", "error");
            return;
        }
    } else {
        customExercises.push(newEx);
        localStorage.setItem('arc_custom_exercises', JSON.stringify(customExercises));
        EXERCISE_LIBRARY = BASE_EXERCISE_LIBRARY.concat(customExercises);
    }
    
    nameInput.value = "";
    renderLibrary();
    setupProgressionAnalytics();
    showToast(`"${name}" added to Exercise Library!`, "success");
}

async function saveCustomPlan() {
    const routineNameInput = document.getElementById("plan-routine-name");
    const routineFocusInput = document.getElementById("plan-routine-focus");

    const name = routineNameInput.value.trim() || `Day ${activePlanDay} Routine`;
    const focus = routineFocusInput.value.trim() || "General focus";

    WORKOUT_ROUTINES[activePlanDay] = {
        name: name,
        focus: focus,
        exercises: activePlanExercises
    };

    if (USER_SESSION.isLoggedIn) {
        try {
            const res = await fetch('api.php?action=save_routine', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    day: activePlanDay,
                    name: name,
                    focus: focus,
                    exercises: activePlanExercises
                })
            });
            const json = await res.json();
            if (json.status !== 'success') {
                showToast("Failed to save routine on server: " + json.message, "error");
                return;
            }
        } catch (err) {
            console.error("Error saving routine to database:", err);
            showToast("Failed to save routine on server.", "error");
            return;
        }
    } else {
        localStorage.setItem('arc_custom_workout_routines', JSON.stringify(WORKOUT_ROUTINES));
    }

    loadWorkoutForDate(selectedDate);
    setupProgressionAnalytics();
    showToast(`Workout plan saved for Day ${activePlanDay}!`, "success");
}
