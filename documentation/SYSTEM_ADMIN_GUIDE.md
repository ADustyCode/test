# System Administrator Guide

## 1. System Requirements
-   **Operating System**: Windows, Linux, or macOS.
-   **Software**:
    -   Docker Desktop (or Docker Engine + Docker Compose).
    -   Git.

## 2. Installation Guide

### 2.1 Clone the Repository
```bash
git clone <repository_url>
cd FE-pentawork
```

### 2.2 Environment Configuration
1.  Copy the example environment file:
    ```bash
    cp .env.example .env
    ```
2.  Open `.env` and configure the database credentials if necessary (defaults are set for Docker):
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=user
    DB_PASSWORD=password
    ```

### 2.3 Build and Start Containers
Run the following command to build the Docker images and start the services:
```bash
docker-compose up -d --build
```
This will start:
-   **app**: The Laravel application.
-   **web**: The Nginx web server (exposed on port 8080).
-   **db**: The MySQL database.

### 2.4 Application Setup
Once the containers are running, execute the following commands inside the container:

1.  **Install PHP Dependencies**:
    ```bash
    docker-compose exec app composer install
    ```

2.  **Generate Application Key**:
    ```bash
    docker-compose exec app php artisan key:generate
    ```

3.  **Run Database Migrations**:
    ```bash
    docker-compose exec app php artisan migrate
    ```

4.  **Install Frontend Dependencies & Build**:
    ```bash
    docker-compose exec app npm install
    docker-compose exec app npm run build
    ```

## 3. Configuration Manual

### 3.1 Environment Variables (.env)
-   **APP_NAME**: Name of the application (default: Laravel).
-   **APP_URL**: The URL where the app is hosted (e.g., `http://localhost:8080`).
-   **DB_***: Database connection settings. Ensure `DB_HOST` matches the service name in `docker-compose.yml` (default: `db`).
-   **MAIL_***: SMTP settings for sending emails (Verification, Password Reset).

### 3.2 Web Server
-   The Nginx configuration is located in `./docker/nginx.conf`.
-   The application is accessible at `http://localhost:8080` by default. To change the port, edit `docker-compose.yml` under the `web` service.

## 4. Maintenance
-   **Viewing Logs**:
    ```bash
    docker-compose logs -f
    ```
-   **Stopping services**:
    ```bash
    docker-compose down
    ```
