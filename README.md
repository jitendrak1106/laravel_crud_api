# CRUD API using Laravel and MySQL Database

Steps to create laravel application

## Create project using composer

```bash
composer create-project laravel/laravel:^9.0 laravel_crud_api
```

Add the database connection details in .env file

Create Students table and entity

```sh
php artisan make:migration create_students_table
```
Check the Application is working correctly
```
php artisan serve
```
Then open below url in browser

[http://127.0.0.1:8000/](http://127.0.0.1:8000/)


Add the fields in migration file suppose to be used un Students table.
So Open the *create_students_table.php file located in database/migrations folder
The up() function looks like as 

```
public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('course');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });
    }
```
After updating the file, execute the below command
```
php artisan migrate
```
Create the Student model
```
php artisan make:model Student
```
It will then create the Student model file at app/Models/Student.php
Add the required code in it.

Create Cotroller file
```
php artisan make:controller Api/StudentController
```

## _Lets look at below API details_
- `Get All Students data`

   `Endpoint` - http://localhost:8000/api/students

   `Method` - GET
   
   `Body` - 
   
   `Response` - When no records in database
```
{
    "status": 404,
    "students": "No records found."
}
```

  `Response` - When records in database

```
{
    "status": 200,
    "students": [
        {
            "id": 1,
            "name": "Jitendra",
            "course": "Compuuter Sci",
            "email": "jitendrak1106@gmail.com",
            "phone": "9860258741",
            "created_at": "2025-01-26T11:19:42.000000Z",
            "updated_at": "2025-01-26T11:19:42.000000Z"
        }
    ]
}
```
=============================================
- `Create/Save Student data`

   `Endpoint` - http://localhost:8000/api/students

   `Method` - POST
   
   `Body` - 

```
{
    "name": "Jitendra",
    "course": "Computer Sci",
    "email": "testUseremail@gmail.com",
    "phone": 9860258741
}
```
   
   `Response` - 
```
{
    "status": 200,
    "message": "Student information saved successfully."
}
```
=========================================
- `Get particular Student data`

   `Endpoint` - http://localhost:8000/api/students/1

   `Method` - GET
   
   `Body` - 

```

```
   
   `Response` - 
```
{
    "status": 200,
    "student": {
        "id": 1,
        "name": "Jitendra",
        "course": "Computer Sci",
        "email": "testUseremail@gmail.com",
        "phone": "9860258741",
        "created_at": "2025-01-26T11:19:42.000000Z",
        "updated_at": "2025-01-26T11:19:42.000000Z"
    }
}
```
=========================================
- `Edit/Update Student data`

   `Endpoint` - http://localhost:8000/api/students

   `Method` - PUT
   
   `Body` - 

```
{
    "name": "Jitendra",
    "course": "Masters in Computer Sci",
    "email": "testUseremail@gmail.com",
    "phone": 9860258741
}
```
   
   `Response` - 
```
{
    "status": 200,
    "message": "Student information updated successfully."
}
```
=========================================
- `Delete/Purge Student data`

   `Endpoint` - http://localhost:8000/api/students/1

   `Method` - DELETE
   
   `Body` - 

```

```
   
   `Response` - 
```
{
    "status": 200,
    "message": "Student data deleted successfully."
}
```
=========================================
## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)