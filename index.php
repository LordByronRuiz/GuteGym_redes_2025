<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymTrack - Gestión de Rutinas</title>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #2ecc71;
            --warning: #f39c12;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background-color: var(--primary);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .nav-links a:hover {
            background-color: rgba(255,255,255,0.1);
        }
        
        .auth-section {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: var(--secondary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .btn-accent {
            background-color: var(--accent);
            color: white;
        }
        
        .btn-accent:hover {
            background-color: #c0392b;
        }
        
        .btn-success {
            background-color: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background-color: #27ae60;
        }
        
        .btn-warning {
            background-color: var(--warning);
            color: white;
        }
        
        .btn-warning:hover {
            background-color: #d35400;
        }
        
        .main-content {
            padding: 2rem 0;
        }
        
        .auth-forms {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }
        
        .dashboard {
            display: grid;
            grid-template-columns: 1fr 3fr;
            gap: 20px;
        }
        
        .sidebar {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .workout-list {
            list-style: none;
            margin-top: 1rem;
        }
        
        .workout-list li {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .workout-list li:hover {
            background-color: #f9f9f9;
        }
        
        .workout-list li.active {
            background-color: var(--light);
            font-weight: bold;
        }
        
        .routine-badge {
            background-color: var(--secondary);
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 0.8rem;
        }
        
        .main-panel {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .exercise-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 1rem;
        }
        
        .exercise-list {
            margin-top: 2rem;
        }
        
        .exercise-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 10px;
            padding: 10px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }
        
        .exercise-item:hover {
            background-color: #f9f9f9;
        }
        
        .exercise-header {
            font-weight: bold;
            background-color: var(--light);
            border-radius: 4px;
        }
        
        .hidden {
            display: none;
        }
        
        .error-message {
            color: var(--accent);
            margin-top: 5px;
            font-size: 0.9rem;
        }
        
        .success-message {
            color: var(--success);
            margin-top: 5px;
            font-size: 0.9rem;
        }
        
        /* Estilos para el modo entrenamiento */
        .workout-mode {
            background-color: #fff3cd;
            border-left: 4px solid var(--warning);
        }
        
        .timer-container {
            text-align: center;
            margin: 1rem 0;
            padding: 1rem;
            background-color: var(--primary);
            color: white;
            border-radius: 8px;
        }
        
        .timer {
            font-size: 2.5rem;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }
        
        .timer-controls {
            margin-top: 1rem;
        }
        
        .exercise-progress {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto auto;
            gap: 10px;
            padding: 10px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }
        
        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #eee;
            border-radius: 4px;
            margin-top: 5px;
        }
        
        .progress-fill {
            height: 100%;
            background-color: var(--success);
            border-radius: 4px;
            transition: width 0.3s;
        }
        
        .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .checkmark.checked {
            background-color: var(--success);
            border-color: var(--success);
            color: white;
        }
        
        .weight-input {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
        }
        
        .modal-buttons {
            display: flex;
            gap: 10px;
            margin-top: 1rem;
            justify-content: flex-end;
        }
        
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .exercise-form {
                grid-template-columns: 1fr;
            }
            
            .exercise-item {
                grid-template-columns: 1fr;
            }
            
            .exercise-progress {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">GymTrack</div>
                <div class="nav-links">
                    <a href="#" id="home-link">Inicio</a>
                    <a href="#" id="my-routines-link">Mis Rutinas</a>
                </div>
                <div class="auth-section">
                    <button id="login-btn" class="btn btn-primary">Iniciar Sesión</button>
                    <button id="register-btn" class="btn btn-accent">Registrarse</button>
                    <button id="logout-btn" class="btn btn-accent hidden">Cerrar Sesión</button>
                </div>
            </nav>
        </div>
    </header>

    <div class="container main-content">
        <!-- Sección de Inicio -->
        <div id="home-section">
            <h1>Bienvenido a GymTrack</h1>
            <p>Gestiona tus rutinas de gimnasio, registra pesos y repeticiones, y haz un seguimiento de tu progreso.</p>
        </div>

        <!-- Sección de Autenticación -->
        <div id="auth-section" class="hidden">
            <div class="auth-forms">
                <div id="login-form">
                    <h2 class="form-title">Iniciar Sesión</h2>
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" required>
                    </div>
                    <div class="form-group">
                        <label for="login-password">Contraseña</label>
                        <input type="password" id="login-password" required>
                    </div>
                    <button id="do-login-btn" class="btn btn-primary">Iniciar Sesión</button>
                    <p id="login-message" class="error-message"></p>
                </div>

                <div id="register-form" class="hidden">
                    <h2 class="form-title">Registrarse</h2>
                    <div class="form-group">
                        <label for="register-name">Nombre</label>
                        <input type="text" id="register-name" required>
                    </div>
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" required>
                    </div>
                    <div class="form-group">
                        <label for="register-password">Contraseña</label>
                        <input type="password" id="register-password" required>
                    </div>
                    <div class="form-group">
                        <label for="register-confirm">Confirmar Contraseña</label>
                        <input type="password" id="register-confirm" required>
                    </div>
                    <button id="do-register-btn" class="btn btn-primary">Registrarse</button>
                    <p id="register-message" class="error-message"></p>
                </div>
            </div>
        </div>

        <!-- Sección de Rutinas -->
        <div id="routines-section" class="hidden">
            <h2>Mis Rutinas de Entrenamiento</h2>
            
            <div class="dashboard">
                <div class="sidebar">
                    <h3>Mis Rutinas</h3>
                    <button id="add-routine-btn" class="btn btn-success">Nueva Rutina</button> <br>
                    <br>
                    <button id="load-default-btn" class="btn btn-warning">Cargar Rutinas Predeterminadas</button>
                    <ul class="workout-list" id="routines-list">
                        <!-- Las rutinas se cargarán aquí dinámicamente -->
                    </ul>
                </div>
                
                <div class="main-panel" id="routine-panel">
                    <div id="routine-detail">
                        <p>Selecciona una rutina para ver sus detalles o crea una nueva.</p>
                    </div>
                    
                    <div id="routine-exercises" class="hidden">
                        <h3 id="routine-name">Nombre de la Rutina</h3>
                        <button id="start-workout-btn" class="btn btn-success">Iniciar Rutina</button>
                        <button id="edit-routine-btn" class="btn btn-primary">Editar Rutina</button>
                        
                        <div class="exercise-form hidden" id="edit-exercise-form">
                            <input type="text" id="exercise-name" placeholder="Nombre del ejercicio">
                            <input type="number" id="exercise-sets" placeholder="Series">
                            <input type="number" id="exercise-reps" placeholder="Repeticiones">
                            <input type="number" id="exercise-weight" placeholder="Peso (kg)">
                            <button id="add-exercise-btn" class="btn btn-success">Añadir</button>
                        </div>
                        
                        <div class="exercise-list">
                            <div class="exercise-item exercise-header">
                                <div>Ejercicio</div>
                                <div>Series</div>
                                <div>Reps</div>
                                <div>Peso</div>
                                <div>Acciones</div>
                            </div>
                            <div id="exercises-container">
                                <!-- Los ejercicios se cargarán aquí dinámicamente -->
                            </div>
                        </div>
                    </div>

                    <!-- Modo Entrenamiento -->
                    <div id="workout-mode" class="hidden">
                        <div class="timer-container">
                            <div class="timer" id="workout-timer">00:00</div>
                            <div class="timer-controls">
                                <button id="pause-timer-btn" class="btn btn-warning">Pausar</button>
                                <button id="stop-workout-btn" class="btn btn-accent">Finalizar Entrenamiento</button>
                            </div>
                        </div>
                        
                        <h3>Progreso del Entrenamiento</h3>
                        <div id="workout-exercises">
                            <!-- Los ejercicios en modo entrenamiento se cargarán aquí -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para guardar cambios -->
    <div id="save-changes-modal" class="modal">
        <div class="modal-content">
            <h3>Guardar Cambios</h3>
            <p>Has realizado cambios durante el entrenamiento. ¿Deseas actualizar tu rutina con estos cambios?</p>
            <div class="modal-buttons">
                <button id="save-changes-btn" class="btn btn-success">Sí, Guardar Cambios</button>
                <button id="discard-changes-btn" class="btn btn-accent">No, Mantener Original</button>
                <button id="cancel-save-btn" class="btn btn-primary">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
        // Elementos del DOM
        const homeSection = document.getElementById('home-section');
        const authSection = document.getElementById('auth-section');
        const routinesSection = document.getElementById('routines-section');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const loginBtn = document.getElementById('login-btn');
        const registerBtn = document.getElementById('register-btn');
        const logoutBtn = document.getElementById('logout-btn');
        const doLoginBtn = document.getElementById('do-login-btn');
        const doRegisterBtn = document.getElementById('do-register-btn');
        const myRoutinesLink = document.getElementById('my-routines-link');
        const homeLink = document.getElementById('home-link');
        const routineExercises = document.getElementById('routine-exercises');
        const routinesList = document.getElementById('routines-list');
        const addRoutineBtn = document.getElementById('add-routine-btn');
        const loadDefaultBtn = document.getElementById('load-default-btn');
        const addExerciseBtn = document.getElementById('add-exercise-btn');
        const exercisesContainer = document.getElementById('exercises-container');
        const routineName = document.getElementById('routine-name');
        const startWorkoutBtn = document.getElementById('start-workout-btn');
        const editRoutineBtn = document.getElementById('edit-routine-btn');
        const editExerciseForm = document.getElementById('edit-exercise-form');
        const workoutMode = document.getElementById('workout-mode');
        const workoutTimer = document.getElementById('workout-timer');
        const pauseTimerBtn = document.getElementById('pause-timer-btn');
        const stopWorkoutBtn = document.getElementById('stop-workout-btn');
        const workoutExercises = document.getElementById('workout-exercises');
        const saveChangesModal = document.getElementById('save-changes-modal');
        const saveChangesBtn = document.getElementById('save-changes-btn');
        const discardChangesBtn = document.getElementById('discard-changes-btn');
        const cancelSaveBtn = document.getElementById('cancel-save-btn');

        // Estado de la aplicación
        let currentUser = null;
        let currentRoutineId = null;
        let currentSessionId = null;
        let timerInterval = null;
        let timerSeconds = 0;
        let isTimerRunning = false;
        let workoutChanges = false;
        let modifiedExercises = [];

        // Event Listeners
        loginBtn.addEventListener('click', showLoginForm);
        registerBtn.addEventListener('click', showRegisterForm);
        logoutBtn.addEventListener('click', logout);
        doLoginBtn.addEventListener('click', login);
        doRegisterBtn.addEventListener('click', register);
        myRoutinesLink.addEventListener('click', showRoutinesSection);
        homeLink.addEventListener('click', showHomeSection);
        addRoutineBtn.addEventListener('click', addNewRoutine);
        loadDefaultBtn.addEventListener('click', loadDefaultRoutines);
        addExerciseBtn.addEventListener('click', addExercise);
        startWorkoutBtn.addEventListener('click', startWorkout);
        editRoutineBtn.addEventListener('click', toggleEditMode);
        pauseTimerBtn.addEventListener('click', toggleTimer);
        stopWorkoutBtn.addEventListener('click', stopWorkout);
        saveChangesBtn.addEventListener('click', saveWorkoutChanges);
        discardChangesBtn.addEventListener('click', discardWorkoutChanges);
        cancelSaveBtn.addEventListener('click', cancelSaveChanges);

        // Comprobar si el usuario está autenticado al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            checkAuthStatus();
        });

        // Funciones de autenticación (mantener igual que antes)
        function checkAuthStatus() {
            const userData = localStorage.getItem('currentUser');
            if (userData) {
                currentUser = JSON.parse(userData);
                updateUIForAuth();
            }
        }

        function showLoginForm() {
            authSection.classList.remove('hidden');
            homeSection.classList.add('hidden');
            routinesSection.classList.add('hidden');
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
        }

        function showRegisterForm() {
            authSection.classList.remove('hidden');
            homeSection.classList.add('hidden');
            routinesSection.classList.add('hidden');
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
        }

        function login() {
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            
            if (!email || !password) {
                document.getElementById('login-message').textContent = 'Por favor, completa todos los campos.';
                return;
            }
            
            fetch('api/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentUser = data.user;
                    localStorage.setItem('currentUser', JSON.stringify(currentUser));
                    updateUIForAuth();
                    showRoutinesSection();
                } else {
                    document.getElementById('login-message').textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('login-message').textContent = 'Error de conexión. Intenta nuevamente.';
            });
        }

        function register() {
            const name = document.getElementById('register-name').value;
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const confirm = document.getElementById('register-confirm').value;
            
            if (!name || !email || !password || !confirm) {
                document.getElementById('register-message').textContent = 'Por favor, completa todos los campos.';
                return;
            }
            
            if (password !== confirm) {
                document.getElementById('register-message').textContent = 'Las contraseñas no coinciden.';
                return;
            }
            
            fetch('api/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name, email, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('register-message').textContent = 'Registro exitoso. Ahora puedes iniciar sesión.';
                    document.getElementById('register-message').className = 'success-message';
                    setTimeout(() => {
                        showLoginForm();
                    }, 1500);
                } else {
                    document.getElementById('register-message').textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('register-message').textContent = 'Error de conexión. Intenta nuevamente.';
            });
        }

        function logout() {
            currentUser = null;
            localStorage.removeItem('currentUser');
            updateUIForAuth();
            showHomeSection();
        }

        function updateUIForAuth() {
            if (currentUser) {
                loginBtn.classList.add('hidden');
                registerBtn.classList.add('hidden');
                logoutBtn.classList.remove('hidden');
                myRoutinesLink.classList.remove('hidden');
            } else {
                loginBtn.classList.remove('hidden');
                registerBtn.classList.remove('hidden');
                logoutBtn.classList.add('hidden');
                myRoutinesLink.classList.add('hidden');
                routinesSection.classList.add('hidden');
            }
        }

        // Navegación
        function showHomeSection() {
            homeSection.classList.remove('hidden');
            authSection.classList.add('hidden');
            routinesSection.classList.add('hidden');
        }

        function showRoutinesSection() {
            if (!currentUser) {
                showLoginForm();
                return;
            }
            
            homeSection.classList.add('hidden');
            authSection.classList.add('hidden');
            routinesSection.classList.remove('hidden');
            
            loadUserRoutines();
        }

        // Funciones para rutinas
        function loadUserRoutines() {
            fetch(`api/routines.php?user_id=${currentUser.id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayRoutines(data.routines);
                } else {
                    console.error('Error al cargar rutinas:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function displayRoutines(routines) {
            routinesList.innerHTML = '';
            
            if (routines.length === 0) {
                routinesList.innerHTML = '<p>No tienes rutinas aún.</p>';
                return;
            }
            
            routines.forEach(routine => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span>${routine.name}</span>
                    ${routine.is_default ? '<span class="routine-badge">Predeterminada</span>' : ''}
                `;
                li.dataset.id = routine.id;
                li.addEventListener('click', () => loadRoutineDetails(routine.id));
                routinesList.appendChild(li);
            });
        }

        function addNewRoutine() {
            const routineName = prompt('Nombre de la nueva rutina:');
            if (!routineName) return;
            
            fetch('api/routines.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    user_id: currentUser.id, 
                    name: routineName 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadUserRoutines();
                } else {
                    alert('Error al crear la rutina: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión. Intenta nuevamente.');
            });
        }

        function loadDefaultRoutines() {
            fetch('api/setup_default_routines.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Rutinas predeterminadas cargadas correctamente.');
                    loadUserRoutines();
                } else {
                    alert('Error al cargar rutinas predeterminadas: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión. Intenta nuevamente.');
            });
        }

        function loadRoutineDetails(routineId) {
            currentRoutineId = routineId;
            
            fetch(`api/exercises.php?routine_id=${routineId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    routineExercises.classList.remove('hidden');
                    workoutMode.classList.add('hidden');
                    routineName.textContent = data.routine_name;
                    displayExercises(data.exercises);
                } else {
                    console.error('Error al cargar ejercicios:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function displayExercises(exercises) {
            exercisesContainer.innerHTML = '';
            
            if (exercises.length === 0) {
                exercisesContainer.innerHTML = '<div class="exercise-item"><div>No hay ejercicios en esta rutina.</div></div>';
                return;
            }
            
            exercises.forEach(exercise => {
                const exerciseEl = document.createElement('div');
                exerciseEl.className = 'exercise-item';
                exerciseEl.innerHTML = `
                    <div>${exercise.name}</div>
                    <div>${exercise.sets}</div>
                    <div>${exercise.reps}</div>
                    <div>${exercise.weight} kg</div>
                    <div>
                        <button class="btn btn-accent btn-sm" onclick="deleteExercise(${exercise.id})">Eliminar</button>
                    </div>
                `;
                exercisesContainer.appendChild(exerciseEl);
            });
        }

        function toggleEditMode() {
            const isEditing = editExerciseForm.classList.contains('hidden');
            editExerciseForm.classList.toggle('hidden', !isEditing);
            editRoutineBtn.textContent = isEditing ? 'Cancelar Edición' : 'Editar Rutina';
            editRoutineBtn.className = isEditing ? 'btn btn-accent' : 'btn btn-primary';
        }

        function addExercise() {
            const name = document.getElementById('exercise-name').value;
            const sets = document.getElementById('exercise-sets').value;
            const reps = document.getElementById('exercise-reps').value;
            const weight = document.getElementById('exercise-weight').value;
            
            if (!name || !sets || !reps || !weight) {
                alert('Por favor, completa todos los campos.');
                return;
            }
            
            fetch('api/exercises.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    routine_id: currentRoutineId, 
                    name, 
                    sets, 
                    reps, 
                    weight 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('exercise-name').value = '';
                    document.getElementById('exercise-sets').value = '';
                    document.getElementById('exercise-reps').value = '';
                    document.getElementById('exercise-weight').value = '';
                    loadRoutineDetails(currentRoutineId);
                } else {
                    alert('Error al añadir el ejercicio: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión. Intenta nuevamente.');
            });
        }

        function deleteExercise(exerciseId) {
            if (confirm('¿Estás seguro de que quieres eliminar este ejercicio?')) {
                fetch(`api/exercises.php?exercise_id=${exerciseId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadRoutineDetails(currentRoutineId);
                    } else {
                        alert('Error al eliminar el ejercicio: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error de conexión. Intenta nuevamente.');
                });
            }
        }

        // Funciones del modo entrenamiento
        function startWorkout() {
            // Crear nueva sesión de entrenamiento
            fetch('api/workout_sessions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    user_id: currentUser.id, 
                    routine_id: currentRoutineId 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentSessionId = data.session_id;
                    routineExercises.classList.add('hidden');
                    workoutMode.classList.remove('hidden');
                    startTimer();
                    loadWorkoutExercises();
                } else {
                    alert('Error al iniciar entrenamiento: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión. Intenta nuevamente.');
            });
        }

        function startTimer() {
            timerSeconds = 0;
            isTimerRunning = true;
            updateTimerDisplay();
            timerInterval = setInterval(() => {
                if (isTimerRunning) {
                    timerSeconds++;
                    updateTimerDisplay();
                }
            }, 1000);
        }

        function updateTimerDisplay() {
            const minutes = Math.floor(timerSeconds / 60);
            const seconds = timerSeconds % 60;
            workoutTimer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function toggleTimer() {
            isTimerRunning = !isTimerRunning;
            pauseTimerBtn.textContent = isTimerRunning ? 'Pausar' : 'Reanudar';
        }

        function loadWorkoutExercises() {
            fetch(`api/exercises.php?routine_id=${currentRoutineId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayWorkoutExercises(data.exercises);
                } else {
                    console.error('Error al cargar ejercicios:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function displayWorkoutExercises(exercises) {
            workoutExercises.innerHTML = '';
            
            exercises.forEach((exercise, index) => {
                const exerciseEl = document.createElement('div');
                exerciseEl.className = 'exercise-progress';
                exerciseEl.innerHTML = `
                    <div>
                        <strong>${exercise.name}</strong>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 0%"></div>
                        </div>
                    </div>
                    <div>
                        <span id="sets-${exercise.id}">0/${exercise.sets}</span>
                    </div>
                    <div>${exercise.reps} reps</div>
                    <div>
                        <input type="number" class="weight-input" value="${exercise.weight}" 
                               onchange="updateExerciseWeight(${exercise.id}, this.value)" 
                               id="weight-${exercise.id}"> kg
                    </div>
                    <div>
                        <button class="btn btn-success btn-sm" onclick="completeSet(${exercise.id}, ${exercise.sets})">
                            + Serie
                        </button>
                    </div>
                    <div class="checkmark" id="check-${exercise.id}" onclick="toggleExerciseComplete(${exercise.id})">
                        ✓
                    </div>
                `;
                workoutExercises.appendChild(exerciseEl);
            });
        }

        function completeSet(exerciseId, totalSets) {
            const setsElement = document.getElementById(`sets-${exerciseId}`);
            const currentSets = parseInt(setsElement.textContent.split('/')[0]);
            
            if (currentSets < totalSets) {
                const newSets = currentSets + 1;
                setsElement.textContent = `${newSets}/${totalSets}`;
                
                // Actualizar barra de progreso
                const progress = (newSets / totalSets) * 100;
                document.querySelector(`#sets-${exerciseId}`).parentElement.parentElement.querySelector('.progress-fill').style.width = `${progress}%`;
                
                // Marcar como modificado
                if (!modifiedExercises.find(e => e.id === exerciseId)) {
                    modifiedExercises.push({
                        id: exerciseId,
                        sets: totalSets,
                        weight: parseFloat(document.getElementById(`weight-${exerciseId}`).value)
                    });
                    workoutChanges = true;
                }
            }
        }

        function toggleExerciseComplete(exerciseId) {
            const checkmark = document.getElementById(`check-${exerciseId}`);
            checkmark.classList.toggle('checked');
        }

        function updateExerciseWeight(exerciseId, newWeight) {
            const exercise = modifiedExercises.find(e => e.id === exerciseId);
            if (exercise) {
                exercise.weight = parseFloat(newWeight);
            } else {
                modifiedExercises.push({
                    id: exerciseId,
                    weight: parseFloat(newWeight)
                });
                workoutChanges = true;
            }
        }

        function stopWorkout() {
            if (workoutChanges) {
                showSaveChangesModal();
            } else {
                finishWorkout(false);
            }
        }

        function showSaveChangesModal() {
            saveChangesModal.style.display = 'flex';
        }

        function saveWorkoutChanges() {
            saveChangesModal.style.display = 'none';
            finishWorkout(true);
        }

        function discardWorkoutChanges() {
            saveChangesModal.style.display = 'none';
            finishWorkout(false);
        }

        function cancelSaveChanges() {
            saveChangesModal.style.display = 'none';
        }

        function finishWorkout(saveChanges) {
            // Detener timer
            clearInterval(timerInterval);
            isTimerRunning = false;
            
            // Guardar sesión
            fetch('api/workout_sessions.php', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    session_id: currentSessionId,
                    duration: timerSeconds,
                    save_changes: saveChanges,
                    exercises: saveChanges ? modifiedExercises : []
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    workoutMode.classList.add('hidden');
                    routineExercises.classList.remove('hidden');
                    workoutChanges = false;
                    modifiedExercises = [];
                    loadRoutineDetails(currentRoutineId);
                    alert('Entrenamiento finalizado correctamente.');
                } else {
                    alert('Error al finalizar entrenamiento: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión. Intenta nuevamente.');
            });
        }

        // Hacer funciones globales para los event listeners inline
        window.completeSet = completeSet;
        window.toggleExerciseComplete = toggleExerciseComplete;
        window.updateExerciseWeight = updateExerciseWeight;
        window.deleteExercise = deleteExercise;
    </script>
</body>
</html>