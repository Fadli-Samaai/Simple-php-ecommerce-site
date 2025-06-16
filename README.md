A basic PHP e-commerce site for gaming consoles, modernized with a responsive CSS layout and improved back-end logic.

How to run site using docker

Step 1: Clone this repo

Step 2: Add a .env file containing the following => 
                                                    DB_HOST="db" // leave this line as is
                                                    MYSQL_DATABASE="next_gen_supply" // leave this line as is
                                                    MYSQL_USER="Your_UserName_Here" // Can be anything
                                                    MYSQL_PASSWORD="Your_Password_Here" // Can be anything
                                                    MYSQL_ROOT_PASSWORD="Your_Password_Here" // Can be anything

Step 3:  Build and run network by running the following command from the location of the docker-compose.yml file => docker compose up --build 