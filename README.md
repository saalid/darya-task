# Laravel Weather Job Queue Application

This is a full-stack Laravel 12 application that allows users to submit weather data requests. Jobs are processed asynchronously using a queue, and results are fetched from an external weather API and returned to the user.

---

## Features

- Submit weather requests via city name or coordinates.
- Jobs are queued and processed asynchronously.
- Fetch weather data from an external API (mocked).
- Store and display weather data.
- Responsive frontend with loading state.
- Rate limiting to prevent abuse.
- Dockerized for easy deployment.
- Tests included.
- Error handling for invalid inputs and failed API calls.

---

## Tech Stack

- **Backend**: Laravel 12 (PHP 8.3+)
- **Queue**: Redis
- **Database**: MySQL
- **Frontend**: Vue.js 3 (with Vite)
- **Styling**: Sass
- **Containerization**: Docker + Docker Compose

---

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/saalid/darya-task.git
cd weather-job-app
```
### 2. Copy Environment File

```bash
cp .env.example .env
```


### 3. Build & Run with Docker

```bash
docker-compose up -d --build
```
### 4. Install PHP Dependencies

```bash
docker exec -it app composer install
```

### 5. Generate Application Key

```bash
./vendor/bin/sail artisan key:generate
```
### 6. Run Migrations

```bash
./vendor/bin/sail artisan migrate
```
### 7. Run Queue Worker

```bash
./vendor/bin/sail artisan queue:work
```



