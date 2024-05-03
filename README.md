Pharmacy Management System

Installation

1.git clone https://github.com/athulamwasala/pharmcy-mangment.git

2.Application files are located in the htdocs folder in XAMPP or /var/www/html in a Linux nvironment. Ensure full permissions are granted to the root folder in Linux.

3.Update the database credentials (username and password) in the .env file.

4.Run the following commands:

    composer install
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    php artisan migrate
    php artisan db:seed --class=UserSeeder
    php artisan db:seed --class=CustomerSeeder
    php artisan db:seed --class=MedicationSeeder

Usage

.URL: http://127.0.0.1:8000
.To execute from the command line, navigate to the application  folder and
  run:   
  php artisan serve
  
  The application can then be accessed from http://127.0.0.1:8000/api
  
  User Credentials
  
     Owner:
    Username: owner
    Password: 123456
   
    Manager:
    Username: manager
    Password: 123456
   
    Cashier:
    Username: cashier
    Password: 123456

    Example API Endpoints

    Customers
    Retrieve all customers: GET /api/customers
    Create a new customer: POST /api/customers
    Retrieve a specific customer: GET /api/customers/{id}
    Update a specific customer: PUT /api/customers/{id}
    Delete a specific customer: DELETE /api/customers/{id}
    
    Medications
    Retrieve all medications: GET /api/medications
    Create a new medication: POST /api/medications
    Retrieve a specific medication: GET /api/medications/{id}
    Update a specific medication: PUT /api/medications/{id}
    Delete a specific medication: DELETE /api/medications/{id}

    Postman Collection

    Url:  https://api.postman.com/collections/311122-9fb7eac1-2ea7-488a-b4e6-785b9fecc3a7?access_key=PMAT-01HRAEK9A2QHHZBT8KZX4MZCWR

    Postman Authentication Token Script

    To automate the authentication token setup in Postman, follow these steps:
    1.Send a POST request to the login endpoint to obtain the token
      URL: http://127.0.0.1:8000/api/login
    2.In the Tests tab of the login request, add the following JavaScript code:

        var object = JSON.parse(responseBody);
        pm.environment.set('token', object.token);

    3.This script will automatically set the authentication token in the Postman local environment variable after a successful login request.
      Subsequent requests will use this token for authentication without manual intervention.

    

    
   
