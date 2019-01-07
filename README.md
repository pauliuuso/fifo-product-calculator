# App setup

1. Based on .env.dist file you should create your own .env file in the same directory, all you have to change is database line "DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name" change db_user yo your local database user name, db_password to your database password for that user, db_name to your database name.

2. If you choose to run this web app locally by using XAMPP or similar technology, then go to your apache configuration and add virtual host which will point to this app.

3. Then change your hosts file, and add a line which will point your local domain to apache virtual host which was configured in step 2.

4. Install composer, then open command prompt and navigate to root folder for this app and run "composer install".

5. Then run "yarn install" or "npm install" command to install all dependencies (yarn is strongly recommended as it is much better package manager).

6. Run "yarn run encore dev" to build scss and js files. It will build 2 files (app.css and app.js) in public/build folder. To build production css and js run "yarn run encore production".

7. If you haven't already created a database for this web app you can do it by running command "php bin/console doctrine:database:create"

8. When you have your database run this command "php bin/console d:s:u --force" it is a quick way to sync database and all your entities.

7. Now you can open the browser and put the url that you configured in step 3 and you should see the web app.
