# Introduction

Docker Config for PMS-API 

## Getting Started

- pro_pms_api folder
    - /data
    - /app
    - /dev-env
    
- `$ cd dev-env`
- `$ cp env.docker.example .env` 
- `$ docker-compose build` 
- `$ docker-compose up -d` 

### Access Database
- [http://localhost:48336/](http://localhost:48336/)
- Server: `env_db`
- Username: `env`
- Password: `env_db@Rikk20`

### Access container
- `$ docker exec -it env_php /bin/sh`