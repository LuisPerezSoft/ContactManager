# Steps to up the project: Contact Manager

### 1. **Clone the Project**

Clone the project from:

```bash
git clone https://github.com/LuisPerezSoft/ContactManager
```

### 2. **Install PHP Dependencies**

Install the PHP dependencies using Composer with the following command in the project's directory:

```bash
composer install
```

### 3. **Install JavaScript Dependencies**

Install the JavaScript dependencies by running the following commands

```bash
npm install
```

### 4. **Set Up Database Container (MySQL)**

The project is pre-configured to use MySQL in a Docker container. Start the database container by running:

```bash
docker compose up
```

**Note: If you are working with an Apple Silicon chip (such as M1 or M2), you will need to either delete or rename the existing `docker-compose.yml` file. Then, rename the file `docker-compose.amd.yml` to `docker-compose.yml` in order to ensure compatibility with your system architecture.**

### 5. **Compile Styles and JavaScript (Webpack)**

The project uses Webpack, so to compile all the styles and JavaScript files, we need to execute the following command:

```bash
npm run dev
```

### 6. **Run Database Migrations**

Run the database migrations to set up the necessary tables

```bash
php bin/console doctrine:migrations:migrate
```

### 7. **Start the Symfony Server**

After completing the previous steps, it is time to run our project. To do this, make sure Symfony is installed, and then execute the following command:

```bash
symfony serve
```

The project should now be running at `http://127.0.0.1:8000`

### 8. **Access the Application**

Once the project is up and running, if the user is not authenticated, they will be automatically redirected to the login page. If the user does not have an account, they can create one by clicking "Create an Account!" on the login page.

After logging in, you will be redirected to the dashboard page. On the left side, there is a menu that allows access to the '**Contacts**' section.


*This version includes the required PHP 8.1 and Node.js 10 versions.*