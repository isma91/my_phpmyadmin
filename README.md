# my_phpmyadmin
##A personnal PHPMyAdmin
Please make sure the project path is writtable by the web server.  
For exemple, the project name is ```my_phpmyadmin``` and he's in ```/var/www/``` :  

```chown -R www-data:www-data /var/www/my_phpmyadmin```


/!\ Don't forget to change the __DocumentRoot__ and the __<Directory__ in the .conf file if your project is not in ```/var/www/my_phpmyadmin/```  
For exemple, you rename the project in ```my_project``` and the path is in ```/home/isma91/```,  
change the .conf file like this :  


    DocumentRoot /home/isma91/my_project/
	<Directory /home/isma91/my_project/>

To use it properly, copy the __my_phpmyadmin.prod.conf__ file to your __apache sites-available folder__  
For exemple :  


    sudo cp my_phpmyadmin.prod.conf /etc/apache2/sites-available/  


    sudo a2ensite my_phpmyadmin.prod.conf  


    sudo service apache2 reload  


After that you can go to your favorite web navigator and write :  


    http://www.my_phpmyadmin.prod/