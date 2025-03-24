# Servicio de Postulaciones
Este servicio muestra la lista de las posiciones abiertas para aplicar, para aplicar previamente el usuario debe registrarse ingresando sus datos personales, experiencia, educación, etc. 
Luego de aplicar a una posición, se registran los datos de la aplicación y se envía un mensaje al servicio de análisis, el cual se encargará de asignar un puntaje a la postulación en base
a que tanto se adapta el perfil del usuario a la posición.

## Instrucciones para iniciar el servicio

<ul>
  <li>
    Clonar el repositorio
  </li>
  
  <li>
    Crear la network de docker: <b><i>docker network create kuali_network</i></b>
  </li>
  
  <li>
    Inicia los contenedores: <b><i>docker-compose up -d --build</i></b>
  </li>
  
  <li>
    Copiar el archivo .env.example a .env
  </li>
  
  <li>
    Instalar composer: <b><i>docker-compose run --rm --user postulaciones composer install</i></b>
  </li>
  
  <li> 
    Ejecutar las migraciones: <b><i>docker-compose run --rm artisan migrate</i></b>
  </li>

  <li>
    Ejecutar los seeders: <b><i>docker-compose run --rm artisan db:seed</i></b>
  </li>

  <li>
    Copiar y guardar el token generado, este token se usará para la autenticación a la api de este servicio, desde el servicio de análisis y de resultados
  </li>

  <li>
    Iniciar el worker para despachar Jobs: <b><i>docker-compose run --rm -d artisan queue:work </i></b>
  </li>
</ul>

Se puede acceder al front end del servicio desde: http://127.0.0.1/
