# COM Assets

## Role-based asset managment project



## Installation

1. Clone the repo and cd into it.
2. Create a database for the project.
3. Copy the .env.example file to a file named .env
4. Update the .env file with the database information.
5. Run composer install.
6. Generate an encryption key: php artisan key:generate.
7. Run migrations: ```php artisan migrate```

## Notes

* This project is still under development and the UI is incomplete. 
* Policies are not in place, but the following API endpoints returning JSON objects are available via Postman:

| Request | Endpoint |	Query Params | Description |
| --- | --- | --- | --- |
| POST | /api/role/update | role, slug, description | Creates a user role. |
| POST | /api/register | name, email, password, c_password, role_id | Registers a new user. |
| POST | /api/login | email | Logs a user in |
| GET | /api/user | | Returns JSON object of current users |




