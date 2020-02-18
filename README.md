# Epi Lights

![Laravel Version 6.2.X](https://img.shields.io/badge/Version-6.2.X-success?style=flat&logo=laravel) ![Zigbee](https://img.shields.io/badge/Zigbee-1.0-blue?style=flat) 

Application Web complète permettant de gérer des ampoules utilisant le protocole [Zigbee](https://fr.wikipedia.org/wiki/ZigBee)

 - [x] On / Off les lumières
 - [x]  On / Off des groupes de lumières
 - [x]  On / Off pour X minutes un groupe de lumières
 - [ ]  Mettre en place des routines

## Install

```bash
	cp .env.example .env
	# Fill .env
	# DB_*
	# DECONZ_KEY=  
	# DECONZ_URL=
	
	# Install Dependencies
	composer install

	# Setup Laravel App
	php artisan key:generate
	php artisan migrate

	# Generate Assets
	yarn
	yarn prod

	# Setup Laravel Task Scheduling
	# * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
	crontab -e
```

## Commands
```bash
	# Launch Laravel Queue
	# OR https://laravel.com/docs/6.x/queues#supervisor-configuration
	php artisan queue:work

	# Create a user via CLI
	php artisan setup:user

	# Acces Groups via CLI (Add, Del, Show)
	php artisan zl:groups
	
	# Acces Lights via CLI (Add, Del, Show, On/Off)
	php artisan zl:groups
```

## Crédits
* [Emile LEPETIT](mailto:emile.lepetit@epitech.eu)
* [Paul BUGEON](mailto:paul.bugeon@epitech.eu)
