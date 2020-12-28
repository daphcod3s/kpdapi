# Steps to install
	1. composer install
	2. change database credentials in .env
	3. php artisan migrate
	4. php artisan tinker
	5. $users = new \App\Models\User();
	6. $users->factory(20)->create();
	7. $cuisines = new \App\Models\Cuisine();
	8. $cuisines->factory(30)->create();
	9. php artisan storage:link
	10. exit