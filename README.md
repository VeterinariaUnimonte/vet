# About
In this work, our group make the process of partially developing a tool that will add benefits such as agility, integrity and modernization to the Veterinary Clinic - Sao Judas. A real project, for a real client, using knowledge acquired through the course of Systems Analysis and Development, based on database fundamentals and web development, using as tools, Visual Studio Code, SQL Server/MYSQL, and the Apache XAAMP or similar. The current scenario is manual and requires time and physical resources, as well as storage space. The proposed tool will automate the scheduling of consultations, examinations and surgeries of the Sao Judas's Veterinary Hospital, Unimonte Campus, allowing the professionals involved, effective control and better care to the animals.

# Prerequisites

- `PHP` *_essential_*
	- version: `>=7.0` (recommended)
	-  extension`pdo_mysql` required
  - Is recommendable enable `shell_exec`
  
- `MySQL` *_essential_*
	- version `>=5.6` (recommended)
  
- `Composer` *_essential_*
	- Version `>=1.2` (recommended)
	- extensions `mbstring` and `dom` required

	 <small>*Composer to install the dependencies needed to run*...</small>
   
## Components that composer loaded
- `jQuery`
	- Version `^3.3`
- `Bootstrap`
	- Version `^4`
- `Font Awesome`
	- Version `^4.7`
- `Jquery Inputmask`
	- Version `^3`
- `Datatables`
	- Version `^1.10`
- `Fullcalendar`
	- Version `^3.9`

# Installation

## First step, install composer
### On Linux

##### Fast installation (if you use ubuntu/debian)
<pre>sudo apt-get install composer</pre>

##### Normal Instalation

<pre>php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"</pre>

### On Windows
<a href="https://getcomposer.org/doc/00-intro.md#installation-windows" target="_blank">https://getcomposer.org/doc/00-intro.md#installation-windows</a>

## Second step, get dependencies via composer
Navigate to the apache folder where the project files are via terminal/cmd and type:
<pre>composer install --no-dev</pre>

After it, two folders named `vendor` and `components` are generated containing all the necessary dependencies.

## Third step, configure MYSQL
Create a new database in your mysql server named `bd_veterinaria` and upload the sql file which is located in `db/mariadb-mysql/BD_Veterinaria.sql` in the same.

## Four step, integrate PHP with MYSQL
Access `conf/database.php` and put your mysql configurations.
<pre>
$conf = array(
        "server" => "localhost",   
        "db_name" => "bd_veterinaria",
        "db_user" => "root",  
        "db_password" => "root",
); 
</pre>

## Five step, configure the navigation
Access `conf/navigation.php` and edit the information to your liking.
<pre>
$config = array(
        "name" => "CMV - Veterinaria Unimonte",
        "url" => "http://localhost/vet"
); 
</pre>
<small>in `url` var, put your *application link*.</small>

After this step, the application has configured perfectly, do not forget to enable apache and mysql server.

# Screenshots
 





	

  
  
  
  

