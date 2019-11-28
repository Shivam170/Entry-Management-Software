# Entry-Management-Software
A web app made in PHP and MySQL which manages the visits of the customer and notify them accordingly. 

#### Set up
1. Change the document root directory to the project directory.
2. Import the db_user.sql file using phpMyAdmin or Command Line and configure changes in connection.php file according to your database.
3. Open the browser and enter http://localhost
4. Login to admin account to change the host details.

And We're done!!

##### Admin Credentials
Username - admin
Password - password

#### Description 
* The web app uses textlocal api to send sms to the user and host. The current attached account has 8 text credits. We can simply buy more credits using account balance.
* The web app uses gmail smtp to send emails to user and host.

#### Workflow of the app

When we open the app, we are presented with two options NewVisitor and Checkout. NewVisitor has to fill his details which will be stored in the database and an email and a sms comprising of visitor details will be triggered to the host . When the same user checkout from the app an email and sms comprising the visit details such check-in time, check-out time etc. will be triggered to the visitor. Host Details can be changed by logging into the admin account using his credentials.
