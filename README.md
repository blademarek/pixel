# Intro

- This is an implementation of simple Blog in Symfony
- Data is stored in MySQL DB
- The project is dockerized
- Both Bootstrap and Font Awesome are utilized
- Xdebug is configured inside the container for easier debugging
- Nginx is employed as a proxy

# Setup

#### To run this project live, few steps must be followed:

1. Start docker-compose (prerequisite is installed docker)
    ```
    docker compose up
    ```

2. Enter application docker container
    ```
    docker compose exec app /bin/bash
    ```
   Following commands will be run inside `app` container.

3. Install composer packages.
   ```
   composer install
   ```

4. Create DB
   ```
   php bin/console doctrine:database:create
   ```

5. Run DB migrations
   ```
   php bin/console doctrine:migrations:migrate
   ```

#### Optional:

If You want to access the page with different url than localhost - lets say `pixel.local`, make sure to add hosts entry in `/etc/hosts`:
```
127.0.0.1 pixel.local
```

# Task description

Build a simple blog in Symfony. The blog should contain the following:

- Overview of blog messages with title, description, date, author with email and number of comments
- Blog detail page with title, content, date, an overview of comments with content, author with email and date
- Page to add a blog post with the above data and validation in the form
- Form to add comments

Nothing else, authentication is not needed.

### Constraints

- Use a MySQL database
- Use pagination for the overviews
- There is no need to care about frontend, plain HTML is enough
- Write your code as clean and straightforward as possible, feel free to use DDD tactical patterns, if you know how
- Use Doctrine ORM as persistence layer
- Write a readme for local installation


- Bonus points: The site should run on Docker
- Bonus points: Write Unit tests for code from the Model layer