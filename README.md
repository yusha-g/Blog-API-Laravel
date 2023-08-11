# Blog-API-Laravel

# Table of Contents

## [1. Design](#1-project-design)
&ensp;&ensp; **[1.1. Database Design](#11-database-design)**

&ensp;&ensp; **[1.2. API Endpoints](#12-api-endpoints)**

<hr>

# 1. Project Design

## 1.1. DataBase Design

### A Rough View of the Databases

![databases](/assets/databases.png)

### Users

- user id
- email
- phone

### User Profiles

- user id
- first name
- last name
- role [editor, writer]

### User Password

- user id
- password
- updated at

### Articles

- article id
- title
- post
- creator id

### Comments

- comment id
- article id
- creator id

By default a user is a writer. 

A user can edit their profile to become an editor.

A Writer can -write can make an article -add comments to the articles -view only their articles -view only their comments on their articles

An editor can -view all articles -add comment to articles -view only the comments made by them

## 1.2. API Endpoints
### User Registration

- Method: POST
- End Point: **`/register`**
- Request Body: { "email", "phone", "password", "password_confirmation" }
- Action: Register a new user with the provided credentials.

### User Login
- Method: POST
- Endpoint: **`/login`**
- Request Body: { "email", "password" }
- Action: Authenticate the user and provide an access token.

### User Logout
- Method: POST
- Endpoint: **`/logout`**
- Action: Invalidate the user's access token to log them out.

### View User Profile
- Method: GET
- Endpoint: **`/profile`**
- Action: Retrieve the authenticated user's profile information.

### Create Article
- Method: POST
- Endpoint: **`/articles`**
- Request Body: { "title", "post" }
- Action: Allow a user with the "writer" role to create a new article.

### Read Article
- Method: GET
- Endpoint: **`/articles/{article_id}`**
- Action: Retrieve details of a specific article.

### Update Article
- Method: PUT
- Endpoint: **`/articles/{article_id}`**
- Request Body: { "title", "post" }
- Action: Allow a user with the "writer" role to update an article they created.

### Delete Article
- Method: DELETE
- Endpoint: **`/articles/{article_id}`**
- Action: Allow a user with the "writer" role to delete an article they created.

### Read Comments
- Method: GET
- Endpoint: **`/articles/{article_id}/comments`**
- Action: Allow a user with the "writer" role to read comments on an article they created.
### Read All Articles
- Method: GET
- Endpoint: **`/articles`**
- Action: Allow a user with the "editor" role to read all articles.

### Create Comment
- Method: POST
- Endpoint: **`/articles/{article_id}/comments`**
- Request Body: { "content" }
- Action: Allow a user with the "editor" role to create a comment on an article.

### Delete Comment
- Method: POST
- Endpoint: **`/articles/{article_id}/comments`**
- Request Body: { "content" }
- Action: Allow a user with the "editor" role to create a comment on an article.