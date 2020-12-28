# Steps to install
	1. composer install
	2. change database credentials in .env
	3. php artisan migrate
	4. php artisan tinker
	5. $users = new \App\Models\User();
	6. $users->factory(20)->create();
	7. exit