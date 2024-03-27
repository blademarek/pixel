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