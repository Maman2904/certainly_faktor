<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
	DashboardController,
	DiagnosaController,
	RiwayatController,
	PenyakitController,
	GejalaController,
	RuleController,
	UserController,
	HasilController,
	DefectController,
	CiriciriController,
	PenentuanController,
	RuleDefectController
};

Route::redirect('/', '/login');

Route::group([
	'middleware' => 'auth',
	'prefix' => 'panel',
	'as' => 'admin.'
], function () {
	// diagnosa menu
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	Route::get('/penentuan', [PenentuanController::class, 'index'])->name('penentuan');
	Route::post('/penentuan', [PenentuanController::class, 'penentuan'])->name('penentuan');

	// logs
	Route::get('/logs', [DashboardController::class, 'activity_logs'])->name('logs');
	Route::post('/logs/delete', [DashboardController::class, 'delete_logs'])->name('logs.delete');

	Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.daftar');
	Route::get('/hasil/detail/{hasil}', [HasilController::class, 'show'])->name('hasil');

	// Member menu
	Route::get('/member', [UserController::class, 'index'])->name('member');
	Route::get('/member/create', [UserController::class, 'create'])->name('member.create');
	Route::post('/member/create', [UserController::class, 'store'])->name('member.create');
	Route::get('/member/{id}/edit', [UserController::class, 'edit'])->name('member.edit');
	Route::post('/member/{id}/update', [UserController::class, 'update'])->name('member.update');
	Route::post('/member/{id}/delete', [UserController::class, 'destroy'])->name('member.delete');

	Route::get('/defect', [DefectController::class, 'index'])->name('defect');
	Route::post('/defect', [DefectController::class, 'store'])->name('defect.store');
	Route::get('/defect/json', [DefectController::class, 'json'])->name('defect.json');
	Route::post('/defect/update', [DefectController::class, 'update'])->name('defect.update');
	Route::post('/defect/{defect}/destroy', [DefectController::class, 'destroy'])->name('defect.destroy');

	Route::get('/ciriciri', [CiriciriController::class, 'index'])->name('ciriciri');
	Route::post('/ciriciri', [CiriciriController::class, 'store'])->name('ciriciri.store');
	Route::get('/ciriciri/json', [CiriciriController::class, 'json'])->name('ciriciri.json');
	Route::post('/ciriciri/update', [CiriciriController::class, 'update'])->name('ciriciri.update');
	Route::post('/ciriciri/{ciriciri}/destroy', [CiriciriController::class, 'destroy'])->name('ciriciri.destroy');

	Route::get('/rulesdefect/{id}', [RuleDefectController::class, 'index'])->name('rulesdefect');
	Route::post('/rulesdefect/{id}/update', [RuleDefectController::class, 'update'])->name('rulesdefect.update');


	// Profile menu
	Route::view('/profile', 'admin.profile')->name('profile');
	Route::post('/profile', [DashboardController::class, 'profile_update'])->name('profile');
	Route::post('/profile/upload', [DashboardController::class, 'upload_avatar'])
		->name('profile.upload');

	Route::get('/tes', function () {
	})->name('test');
});


require __DIR__ . '/auth.php';
