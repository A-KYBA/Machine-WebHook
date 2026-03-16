# Machine WebSocket Dashboard

Production line machine monitoring system using the Observer design pattern.

## Stack

- **Backend:** PHP (OOP)
- **Frontend:** React + TypeScript

## Setup

### Backend
```bash
# Task 1 - Observer Pattern (console output)
php backend/main.php

# Challenge Task - WebSocket Server (uses project-local php.ini for sockets extension)
php -c backend/php.ini backend/bin/server.php
```

### Frontend
```bash
cd frontend
npm install
npm run dev
```
