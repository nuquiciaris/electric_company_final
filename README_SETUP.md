# Electric Demo — XAMPP setup

1. Extract this ZIP into `C:\xampp\htdocs\CedrickValera_IT0049\`. The result must be `C:\xampp\htdocs\CedrickValera_IT0049\electric_demo\index.php` and its sibling `app`, `system`, and `vendor` folders.
2. Start Apache and MySQL in XAMPP. Copy the setup SQL supplied in the chat into phpMyAdmin's SQL tab and execute it. This creates `ciaris_temp_db` with `users`, `user_accounts`, and `customer_accounts`. The ZIP contains no SQL database file.
3. Open `http://localhost/CedrickValera_IT0049/electric_demo/login`. Use username `admin` and password `password`, as in the supplied ElectricCompany database dump. The setup SQL stores the password hash in `user_accounts`. The separate public `/register` page writes to `users`; it does not create a staff login in `user_accounts`.
4. Test the account dashboard and CRUD. After finishing, run the `DROP DATABASE` query from the separate cleanup query in the chat to remove the entire temporary database.

The app uses `ciaris_temp_db` in app/Config/Database.php. It assumes XAMPP's default MySQL root user with no password and PHP 8.1+ with MySQLi, intl and mbstring. The base URL matches the folder under CedrickValera_IT0049.
