# Share_Contribute_System

## Team info
<p>Team Number: 13</p>
<p>Course: COMP 353</p>
<p>Fall 2019</p>

### Technoloy used
- PHP (barebones since it was a requirement not to use any framework)
- Javascript (including jquery library)
- CSS (including bootstrap library)
- HTML
- MySQL (hosting database)
- Apache (hosting website)

### Website design
<p>The website uses an MVC model for its design pattern</p>
<p>The Database has models (tables and their relationships) and their contained information</p>
<p>Backend php files are used for our controllers which fetch the data represented by our models and deliver them to our views</p>
<p>The views are made from a mix of html and js</p>

### Features added since DEMO
- Finished groups functionality and logic
- Parameterized all (remaining) queries in order to prevent SQL injection
- Made the front end overall more polished with added styling

### Setup
- Project is already setup and running on our assigned school webserver with our assigned school database.
- If you were to attempt to host locally, you would ideally use WAMP for windows and XAMP for MacOS
    - Due note that some configuration files would need to be changed to use the localhost environment instead of the hosted environment on the school webserver
- Use phpmyadmin to help setup local MySQL database