<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Service_Infantile\ChildrenController;
use App\Http\Controllers\Service_Infantile\DisplayController;
use App\Http\Controllers\Service_Infantile\Infirmerie\Demande_Modification;
use App\Http\Controllers\Service_Infantile\Infirmerie\SuivieController;
use App\Http\Controllers\Service_Infantile\Pediatrie\Consultation;
use App\Http\Controllers\Service_Infantile\Pediatrie\TraitementController;
use App\Http\Controllers\Service_Infantile\Statistique\StatisticsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
   Route::get('suivie/{id}', [SuivieController::class, 'create_with_consultation'])->name('suivie.pediatrie');
   Route::get('consultation/{child}', [TraitementController::class,'list_Consultation'])->name('list_consultation');
   Route::get('/search-child', [ChildrenController::class, 'search'])->name('child.search');

Route::name('Service_Infantile.')->group(function () {
    Route::resource('child', ChildrenController::class);
    Route::resource('consultation', Consultation::class);
    Route::resource('infirmerie', TraitementController::class);
    Route::resource('suivie', SuivieController::class);
    Route::resource('demande_modification',Demande_Modification::class);
    Route::get('list_child', [ChildrenController::class, 'index_10'])->name('list_child');
    Route::get('pediatrie/create-with-user/{child}',[Consultation::class, 'create_with_User'])->name('create_with_user');  
});

//Route pour récupéré les médecins par département afin de les affichés au niveau de l'acceui. Le contoleur utilisé est DisplayController
Route::get('/get-medecins', [DisplayController::class, 'getMedecins']);
Route::post('/children/{child}/attach-med', [ChildrenController::class, 'attachUser'])->name('child.attachUser');
//Route pour assigner les infirmiers aux consultation. Le contoleur utilisé est DisplayController
Route::get('/getAllInfirmiers', [DisplayController::class, 'getAllInfirmiers']);
Route::post('/conusultation/{consultation}/attach-infirmerie', [DisplayController::class, 'attachInfirmerie'])->name('consultation.attachInfirmerie');
Route::get('/child/{id}/download-qrcode', [ChildrenController::class, 'downloadQRCode'])->name('child.download-qrcode');
// Approuver une modification par les infirmiers
Route::post('/modification/{id}/approve', [Demande_Modification::class, 'approve'])->name('modification.approve');
Route::post('/modification/{id}/reject', [Demande_Modification::class, 'reject'])->name('modification.reject');
// Route pour récupérer les statistiques
Route::get('/statistics', [StatisticsController::class, 'getDailyStats'])->name('statistics');

require __DIR__.'/auth.php';
