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


### Roles
| Request | Endpoint |	Query Params | Description |
| --- | --- | --- | --- |
| POST | /api/role/update | role, slug, description | Creates a user role. |


### Users/Authentication
| Request | Endpoint |	Query Params | Description |
| --- | --- | --- | --- |
| POST | /api/register | name, email, password, c_password, role_id | Registers a new user. |
| POST | /api/login | email | Logs a user in |
| GET | /api/user | | Returns JSON object of current users |

### Assets
| Request | Endpoint |	Query Params | Description | Response |
| --- | --- | --- | --- | --- |
| GET | /api/asset |  | All Assets | JSON string of current Assets. |
| POST | /api/asset/{id} | id | Single Asset record | JSON string of Assed db row |
| POST | /api/asset/update | title, description, serial | Creates or Updates an existing Asset record in the db. | JSON string of edited Asset record. |
| POST | /api/asset/delete | id | Deletes Asset record in the db. | JSON string - success or fail message |


### Asset Assignment
| Request | Endpoint |	Query Params | Description | Response |
| --- | --- | --- | --- | --- |
| GET | /api/assignment |  | List of assigned Assets | JSON string of current assignments. |
| POST | /api/assignment/update | user_id, asset_id, notes, checked_out, turned_in | Updates and existing Assignment or creates new Assignment | JSON string with information about Assignment |






