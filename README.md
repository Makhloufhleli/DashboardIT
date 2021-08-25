# DashboardIT
Application for managing the IT infrastructure of a company

# Common Deployment Tasks

<!--Check Requirements-->
  ▪ Check Requirements
  
      composer require symfony/requirements-checker. 
       
 Then, make sure that the checker is included in your Composer scripts
 
        {
            "...": "...",

            "scripts": {
                "auto-scripts": {
                    "vendor/bin/requirements-checker": "php-script",
                    "...": "..."
                },

                "...": "..."
            }
        }
        
 ▪ Configure Environment Variables
 
   In ".env" file change the execution mode to "prod", and set the database, user and password configurations:
   
    ...
      
      APP_ENV=prod
      DATABASE_URL="mysql://user:password@localhost:3306/dbname?serverVersion=5.7"
      
    ...
      
  # Install/Update Vendors
  
    composer install --no-dev --optimize-autoloader
    
  The --optimize-autoloader flag improves Composer’s autoloader performance significantly by building a “class map”. The --no-dev flag ensures that development packages are not installed in the production environment.
    
 # Clear Symfony Cache
    
    APP_ENV=prod APP_DEBUG=0 symfony console cache:clear
      
 # Upload applcation
 
 Upload the application files to the server root folder, export the database scema from local and import it into the server database.
    
    
