# todo-list-app http://todo-list.app.jruizweb.es/
# <h1>Usuario de prueba usuario: pepe contraseña : pepe </h1>

pequeño todo-list-app orientado a api con jwt para dar mayor seguridad a los endpoints y que no se puedan modificar los recursos si no se tiene el token, 
Evitamos que se pueda modificar desde postman.

<p>Lo hize en php puro, no soy capaz de aprender un framewrok en 3 días, y menos uno como Zend Framework, con sus diferentes configuraciones, y componentes, almenos consegí instalarlo en local :->.    </p>
<p>Me queda pendiente asignar tareas a grupos y tareas a usuarios y usuarios a grupos </p>
```javascript
//la parte de asginar las tareas a los usuarios y a los grupos no lo implemente, 
    // es un simple todolist que en un principio como lo implementé fue añadir tareas y modificar el estado de estas tareas de pendiente a completada, 
    // y poder eliminar aquellas que no quiera tenerlas registradas
    // si se quiere añadir mayor complejitdad a la app como añadir tareas a grupos de usuarios o a usuarios.
    //se debería de asociar una tarea a un usuario o grupos esta asociación entre tareas y usuarios o grupo, implicaría la creación  una tabla que guarde la referencia de la tarea y el grupo o e usuaraio
    // y en la tabla que muestra todoas las tareas, se tendría que cambiar y mostrar todas las tareas que esten o no asociadas a un grupo o a un usuario.
    // además un usuario puede pertenecer a un grupo o a varios, otra relación que implica la creación de una tabla auxiliar en la que se registre el id del usuario y el id del grupo
    // toda esta complejidad añadida implicaría crear más vistas, una que me permita asociar la tarea a un grupo o a un usuario, 
    // y un usuario a un grupo.
```


<p>Además de los test unitarios </p>

Gracias por todo, y el feedback que me dió. <br>
Todo esto me está sirviendo para darme cuenta que me queda mucho que mejorar, y que trabajar con un framework no es solo llamar a 3 métodos. <br>
Esta experiencia me está sirviendo bastante, y esta oportunidad me servirá para evolucionar y mejorar como profesional.  <br>

Gracias por todo, un saludo. <br>

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

