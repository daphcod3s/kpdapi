## Steps to install
	Run this command to install all the dependencies
		composer install

	Change database credentials in .env to match your database

	Run this command to create all the tables
		php artisan migrate
	
	Run this command to seed some fake data for testing
		php artisan db:seed

	Run this command to prompt a superadmin creation procedure
		php artisan create:superadmin
		then enter your name, email and password as prompted