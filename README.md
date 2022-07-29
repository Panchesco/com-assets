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

This project is still being developed and the UI is incomplete. 
Policies are not in place, but the following API endpoints are available via Postman:

| Request | Endpoint |	Query Params |
| --- | --- | --- |
| POST | /api/role/update | role, slug, description |



