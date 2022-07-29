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

* This project is under development and the UI is incomplete. 
* Policies are not in place, but the following API endpoints returning JSON objects are available via Postman:


### Roles
| Request | Endpoint |	Query Params | Description | Response |
| --- | --- | --- | --- | --- |
| POST | /api/role/update | role, slug, description | Updates an existing or creates a new user role. | JSON string: Data or role, success/error message |


### Users/Authentication
| Request | Endpoint |	Query Params | Description | Response |
| --- | --- | --- | --- | --- |
| POST | /api/register | name, email, password, c_password, role_id | Registers a new user. | JSON string: User data, success/error message |
| POST | /api/login | email | Logs a user in | JSON string: success/error message |
| GET | /api/user | | List of current users | JSON string: Registered users data |

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






