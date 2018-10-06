<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Models\Front\Categories;
use App\PopUp;
use App\NewBooking;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
	     $this->CategoriesModel = new Categories();
		 view()->share('categories_name', $this->CategoriesModel->getCategories());
		 view()->share('popup', PopUp::find(1));
		 view()->share('booking', NewBooking::all());
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
