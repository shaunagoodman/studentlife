 - To access database, create your own database called 'student_db' on phpmyadmin. 
 - Once this is created, import the file 'student_db.sql' to the database. 


## Adding an Admin account ##
- Register as a normal user would, you will then have to access this account on the database and under "u_type" this value should be 1. 

## User deactivate ##
- When the user clicks deactivate on their account, you must go to the database and the isActive value for their account will be 0. If this is changed to 1, it will be reactivated. 