<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\FactureController;
use App\Models\Conge;
// Public routes (no authentication required)
Route::post('/login', [AuthController::class, 'login']);
// routes/api.php


Route::post('/forgot-password', [UserController::class, 'forgotPassword']);

// Protected routes (require Sanctum authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Authentication routes
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // User routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/conge', [UserController::class, 'conge']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    // Patient routes
    Route::prefix('patients')->group(function () {
        Route::get('/', [PatientController::class, 'index']);
        Route::post('/', [PatientController::class, 'store']);
        Route::get('/{id}', [PatientController::class, 'show']);
        Route::put('/{id}', [PatientController::class, 'update']);
        Route::delete('/{id}', [PatientController::class, 'destroy']);
    });

    // Rendez-vous routes
    Route::prefix('rendezvous')->group(function () {
        Route::get('/', [RendezvousController::class, 'index']);
        Route::post('/', [RendezvousController::class, 'store']);
        Route::get('/{id}', [RendezvousController::class, 'show']);
        Route::put('/{id}', [RendezvousController::class, 'update']);
        Route::delete('/{id}', [RendezvousController::class, 'destroy']);
        Route::get('/patients/{patient_id}/rendezvous', [RendezvousController::class, 'getByPatient']);
    });

    // Ordonnance routes
    Route::prefix('ordonnances')->group(function () {
        Route::get('/', [OrdonnanceController::class, 'index']);
        Route::post('/', [OrdonnanceController::class, 'store']);
        Route::get('/{id}', [OrdonnanceController::class, 'show']);
        Route::put('/{id}', [OrdonnanceController::class, 'update']);
        Route::delete('/{id}', [OrdonnanceController::class, 'destroy']);
        Route::get('/patients/{patient_id}/ordonnances', [OrdonnanceController::class, 'getByPatient']);
    });

    // Observation routes
    Route::prefix('observations')->group(function () {
        Route::get('/', [ObservationController::class, 'index']);
        Route::post('/', [ObservationController::class, 'store']);
        
        Route::get('/{id}', [ObservationController::class, 'show']); // Récupérer une observation spécifique
        Route::put('/{id}', [ObservationController::class, 'update']); // Modifier une observation
        Route::delete('/{id}', [ObservationController::class, 'destroy']);
    });

    // Equipment routes
    Route::prefix('equipments')->group(function () {
        Route::get('/', [EquipmentController::class, 'index']);
        Route::post('/', [EquipmentController::class, 'store']);
        Route::get('/{id}', [EquipmentController::class, 'show']);
        Route::put('/{id}', [EquipmentController::class, 'update']);
        Route::delete('/{id}', [EquipmentController::class, 'destroy']);
    });

    // Maintenance Request routes
    Route::prefix('maintenance-requests')->group(function () {
        Route::get('/', [MaintenanceRequestController::class, 'index']);
        Route::post('/', [MaintenanceRequestController::class, 'store']);
        Route::get('/{id}', [MaintenanceRequestController::class, 'show']);
        Route::put('/{id}', [MaintenanceRequestController::class, 'update']);
        Route::delete('/{id}', [MaintenanceRequestController::class, 'destroy']);
        Route::put('/{id}/complete', [MaintenanceRequestController::class, 'complete']);
    });

    // Conge routes

    // Conge routes

        
    Route::get('/conges', [CongeController::class, 'index']);
    Route::post('/conges', [CongeController::class, 'store']);
    Route::put('/conges/{conge}', [CongeController::class, 'update']);
    Route::delete('/conges/{conge}', [CongeController::class, 'destroy']);
    Route::put('/conges/{conge}/approve', [CongeController::class, 'approve']);
    Route::put('/conges/{conge}/reject', [CongeController::class, 'reject']);

    // Dashboard statistics
    Route::get('/statistiques', [StatistiqueController::class, 'getDashboardStats']);

    // Facture routes with prefix
    Route::prefix('factures')->group(function () {
        Route::get('/', [FactureController::class, 'index']);
        Route::post('/', [FactureController::class, 'store']);
        Route::get('/{id}', [FactureController::class, 'show']);
        Route::put('/{id}', [FactureController::class, 'update']);
        Route::delete('/{id}', [FactureController::class, 'destroy']);
    });
    
});