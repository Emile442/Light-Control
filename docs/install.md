# Install

## Setup
!> You need to have installed on your server **PHP** (>= 7.2), **Composer** and **Node.js**

1.  Copy .env
```bash
    cp .env.example .env
```
Please refer to [Env File](#Env-File)

2.  Install Dependencies
```bash
    composer install
```

3.  Setup Laravel
```bash
    php artisan key:generate
    php artisan migrate
```

4.  Install Assets & Generate Assets
```bash
    yarn
    yarn prod
```

5.  Setup Task Schduling
```bash
    # * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
    crontab -e
```

6.  Setup the Queue <br>
Please follow this link for setup with Supervisor
[https://laravel.com/docs/6.x/queues#supervisor-configuration](https://laravel.com/docs/6.x/queues#supervisor-configuration)


## Env File
```env
    # MySQL
    DB_HOST=127.0.0.1       # database host
    DB_PORT=3306            # database prot (def: 3306)
    DB_DATABASE=Light Controls   # database name
    DB_USERNAME=root        # database username
    DB_PASSWORD=root        # database password
    
    # Zigbee
    ZIGBEE_URL=             # Zigbee Api URL / IP
    ZIGBEE_KEY=             # Zigbee Api Key
    
    # Azure OAuth
    # Generate a Applicaiton
    # https://portal.azure.com/#blade/Microsoft_AAD_IAM/AppGalleryApplicationsBlade/category/topapps
    AZURE_CLIENT            # application client
    AZURE_SECRET=           # application secret (You have to generate manually after cerate your application)
    
    # EpiLihts
    DEFAULT_MINUTE_STATE=30 # Default Timer delay for change state
    DAY_HOUR=8              # End of students access
    NIGHT_HOUR = 20         # Start of students access
```
