Stock Management Project (Student Project)

This small student project for stock management allows you to list, create, and generate fake data for a PostgreSQL database. The goal is to facilitate the management of items in stock by providing simple and practical features.
Features

    List Stock Items:
        Displays the complete list of stored items, with sorting options.

    Create a New Item:
        Allows you to add a new item to the stock by specifying the name, description, and storage quantity.

    Generate Fake Data:
        Uses the Faker library to generate fake data, facilitating testing and initial database population.

Configuration

    The configuration file is located in the config folder:
        config/conf_connect.json: Contains connection information for the PostgreSQL database.

Dependencies

    This project uses Composer for dependency management.
    Dependencies:
        PostgreSQL: Relational database management system.
        Faker: Library for generating fake data.
        PHP: Programming language used for project development.

Installation Instructions

    Clone the project from the Git repository.

    Run composer install to install dependencies.

    Configure the database connection parameters in the config/conf_connect.json file.

    Ensure PostgreSQL is installed and accessible.

    You can use the project by accessing index.php in your browser.

Note:
This project, created as part of a student project, provides a simple interface for stock management with features for listing, creating, and generating fake data.
