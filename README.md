# PHP RESTful API

## Overview
This project is a RESTful API built with PHP. It allows clients to perform CRUD (Create, Read, Update, Delete) operations on data through simple HTTP requests.

---

## Features

- RESTful architecture
- Token-based authentication for write operations
- JSON-based request and response
- Lightweight and easy to deploy
- Built using native PHP (no frameworks)

## Setup Instructions

1. **Clone the repository**
   - Open your terminal and navigate to your XAMPP or LAMPP `htdocs` directory:
   ```bash
   cd C:/xampp/htdocs
   ```
   - Clone the repository right inside the htdocs folder
   ```bash
   git clone https://github.com/TaraDesk/php-restful-api.git
   cd php-restful-api
   ```
   - Move all the contents of the repository to the root of htdocs
   ```bash
   mv * ../
   mv .[^.]* ../
   ```


2. **Setting the Database**
   - Import the `quiz_db.sql` file located in the `database/` directory into your MySQL server.
   - Create `src/config/credentials.php` file with your database credentials:
     ```php
     $db_host = 'your_host';
     $db_user = 'your_username';
     $db_pass = 'your_password';
     $db_name = 'your_database_name';
     ```

3. **Update token data**
   - Open your database and navigate to the token table.
   - Input this query to update the token's expiration date:
     ```sql
     INSERT INTO tokens (token, purpose, expires_at)
     VALUES (
     'your-token',
     'Access for API testing',
     DATE_ADD(NOW(), INTERVAL 7 DAY)
     );
     ```

4. **Run the API**
    You can test the API using tools like httpie or curl.

---

## API Endpoints

Here is a list of the available endpoints, the methods they use, and the data they require:

| Method | Endpoint | Description          | Required Data (JSON)                                                                 |
|--------|----------|----------------------|--------------------------------------------------------------------------------------|
| GET    | /        | Fetch all items      | –                                                                                    |
| GET    | /{id}    | Fetch single item    | –                                                                                    |
| POST   | /        | Create new item      | { "token": "your-token", "question": "What is the capital of France?", "category": "Geography", "options": ["Berlin", "Madrid", "Paris", "Rome"], "correct_opt": ["Paris"] } |
| PUT    | /{id}    | Update existing item | { "token": "your-token", "question": "What is the capital of France?", "category": "Geography", "options": ["Berlin", "Madrid", "Paris", "Rome"], "correct_opt": ["Paris"] } |
| DELETE | /{id}    | Delete item          | { "token": "your-token" }                                                            |

## Testing

1. GET Method
   ```bash
   http GET http://localhost/
   ```

2. POST Method
   ```
   http POST http://localhost/ \
   token="your-token" \
   question="Who wrote 'To Kill a Mockingbird'?" \
   category="Literature" \
   options:='["Harper Lee", "Mark Twain", "Ernest Hemingway", "Jane Austen"]' \
   correct_opt:='["Harper Lee"]'
   ```

## Result

Data Acquired with GET Method

```json
{
    "data": [
        {
            "category": "Biology",
            "correct_opt": "Mitochondria",
            "id": 1,
            "option_ids": [
                1,
                2,
                3,
                4
            ],
            "options": [
                "Mitochondria",
                "Nucleus",
                "Chloroplast",
                "Endoplasmic Reticulum"
            ],
            "question": "What is the powerhouse of the cell?"
        },
        ...
    ],
    'status': 200
}    
```
