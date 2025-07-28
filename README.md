# Microclinic Microservices

## Overview

This project represents a microservice architecture with the following features:

- Laravel 11 backend services
- Authentication via Laravel Passport
- RabbitMQ as the event broker
- PostgreSQL database
- Versioned REST API (/api/v1)
- Docker and docker-compose for local development
- NGINX gateway as a reverse proxy

## Services

- `user-service`: user management and authentication
- `appointment-service`: appointment scheduling

## How to run

1. Copy `.env.example` to `.env` in each service and configure as needed
2. Start all containers:

```bash
make up
