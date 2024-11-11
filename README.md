
# Funanga AG Application

## System Requirements

- Docker Desktop installed on your machine
- Docker Compose

## Getting Started

Follow these steps to download, set up, and run the application using Docker.

### 1. Clone the Repository

Start by cloning the repository to your local machine.

```bash
git clone git@github.com:grantjm9992/funanga-test.git
cd funanga-test
```

### 2. Automatic Set Up and run Application
Run the following command to build and run the application set up all other components. If you use this, you can skip to #7

```bash
make deploy
```

### 3. Set Up the Application

Before running the application, you need to build the Docker image and install dependencies.

Run the following command to build the application and install dependencies:

```bash
make build
```

This command will:
1. Build the Docker images using `docker-compose`.
2. Run `composer install` inside the Laravel container to install PHP dependencies.

### 4. Running the Application

Once the build process is complete, you can start the application using:

```bash
make run
```

This will start the application container in the background.

### 5. Migrate the Database

To run migrations for the application, use the following command:

```bash
make migrate
```

This will run `php artisan migrate` inside the container to set up your database schema.

### 6. Generate the Laravel Key

To generate the application key, use the following command:

```bash
make generate-key
```

This command will run `php artisan key:generate` inside the container.

### 7. Open the Application in Your Browser

Once the container is running, you can access the application in your web browser.

By default, it will be available at:

```text
http://localhost/login
```

### 8. Stopping the Application

To stop the application and remove the container, run:

```bash
make stop
```

This will stop and remove the Docker container using `docker-compose down`.

### 9. Viewing Logs

To view the logs of the running application, you can use:

```bash
make logs
```

This will tail the logs of the `app` container.

---

## Docker Compose Commands

- **`make build`**: Builds the Docker images and installs dependencies.
- **`make run`**: Starts the Docker containers in the background.
- **`make migrate`**: Runs the Laravel migrations.
- **`make generate-key`**: Generates the Laravel application key.
- **`make stop`**: Stops and removes the Docker containers.
- **`make logs`**: Tails the logs of the application container.

---

## Troubleshooting

If you encounter any issues, try the following:

- Ensure that Docker and Docker Compose are correctly installed and running.
- Check the Docker container logs for errors (`make logs`).
- Ensure that the correct environment variables are set up in the `.env` file.

---

Enjoy building your Laravel application with Docker!
