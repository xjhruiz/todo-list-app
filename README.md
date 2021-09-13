# todo-list-app http://todo-list.app.jruizweb.es/
#Usuario de prueba pepe pepe <br>
pequeño todo-list-app orientado a api con jwt para dar mayor seguridad a los endpoints y que no se puedan modificar los recursos si no se tiene el token, 
Evitamos que se pueda modificar desde postman.

<p>Lo hize en php puro, no soy capaz de aprender un framewrok en 3 días, y menos uno como Zend Framework, con sus diferentes configuraciones, almenos consegí instalarlo en local :->, lo siento.   </p>
<p>Me queda pendiente asignar tareas a grupos y tareas a usuarios y usuarios a grupos </p>
<p>Además de los test unitarios </p>

Gracias por todo, y el feedback que me dió. 
Todo esto me está sirviendo para darme cuenta que me queda mucho que mejorar, y que trabajar con un framework no es solo llamar a 3 métodos. 
Esta experiencia me ha servido bastante, y esta oportunidad para evolucionar y mejorar como profesional. 
Gracias por todo.

Para la instalación de este proyecto en local se creó un virtual host en local que apunta a la carpeta src/web
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

