# todo-list-app http://todo-list.app.jruizweb.es/
#Usuario de prueba pepe pepe <br>
pequeño todo-list-app orientado a api con jwt para dar mayor seguridad a los endpoints y que no se puedan modificar los recursos si no se tiene el token, 
Evitamos que se pueda modificar desde postman.

Para la instalación de este proyecto en local se creó un virtual host en local que apunte a la carpeta src/web
```
<VirtualHost *:80>
	ServerName todolist.com
	DocumentRoot "c:\wamp64\www\todolist\src\web"
	<Directory  "c:\wamp64\www\todolist\src\web">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>
```
endpoint que no se ven http://todo-list.app.jruizweb.es/getTask

