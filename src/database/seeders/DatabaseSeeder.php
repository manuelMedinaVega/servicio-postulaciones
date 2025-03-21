<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Position;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (App::environment() == 'local') {
            User::truncate();
            Position::truncate();
            Company::truncate();
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
            /*$user = User::factory()->create([
                'name' => 'Manuel medina',
                'email' => 'manu@medi.com',
                'experience' => 'Web Developer
                    Freelance
                    |
                    December 2024 - Present
                    Learning platform project developed with Laravel 11, MySQL, Pest, Livewire, Tailwind, deployed on AWS.
                    Support ticket creation API developed with Laravel 11, MySQL, Pest, Tailwind, Postman.
                    Microservices architecture and APIs project for restaurant sales management, developed with Laravel 11, MySQL, RabbitMQ, Docker, deployed on AWS.
                    Web Developer
                    Montagne
                    |
                    August 2022 – November 2024
                    Development of reporting pages for the marketing and accounting departments.
                    Analysis and resolution of production bugs.
                    Implementation of updates, fixes, and improvements to Prestashop modules.
                    Maintenance and improvements to the module responsible for making calls to the Mercadolibre API for creating and updating listings.
                    Maintenance and improvements to the Laravel project for customer registration in physical stores.
                    Development of a module to store daily sales and product stock history and implement an algorithm to estimate future sales.
                    Integration of the MODO payment gateway.
                    Maintenance of the MercadoPago payment gateway.
                    Web Developer
                    EQUOM
                    |
                    March 2016 – July 2022
                    Analysis and design of MySQL databases for the development of a collaborative ecommerce platform and other projects.
                    Development of a collaborative ecommerce platform and other projects using the Laravel framework.
                    Unit and feature testing using PHP Unit.
                    Integration of frontend with backend using Vue.js.
                    Integration of the MercadoPago payment gateway.
                    Design of web architecture for deployment using AWS services.
                    Maintenance, debugging, and documentation of projects.',
                'education' => 'IT Engineer
                    National University of Trujillo - Perú -October 2018
                    Bachelors Degree in Computer Science - National University of Trujillo - Perú - March 2011 - April 2016
                    Certificate of Competency in English – Level B2 - ECCE - May 2015'
            ]);
            $user = User::factory()->create([
                'name' => 'Tester Dos',
                'email' => 'tester@example.com',
                'experience' => 'Web Developer
                    Desarrollador de software orientado al buen diseño, trabajo en equipo y mejores prácticas de programación. He creado aplicaciones y sitios web desde cero. Por otro lado, he participado en proyectos nacionales e internacionales generando una excelentes resultados. Por último, soy un entusiasta de la tecnología y el aprendizaje, ya que creo que no hay excusas para no aprender algo nuevo. Saludos cordiales.

                    Principales tecnologías: React, Angular, .NET y Java.
                    Habilidades blandas: Trabajo en equipo, empatía y creatividad. 
                    Funciones principales:
                    - Desarrollé nuevos requerimientos para mejorar la adaptabilidad de la plataforma, incrementando su flexibilidad ante nuevas necesidades de los usuarios.
                    - Refactoricé módulos clave del sistema, lo que redujo en un 20% los problemas reportados y mejoró la estabilidad general.
                    - Proporcioné soporte continuo, resolviendo problemas operativos rápidamente para mantener las funcionalidades críticas.
                    - Participé en la incorporación de nuevas herramientas tecnológicas, mejorando la productividad del equipo en un 15%.',
                'education' => 'EducaciónEducación
                    Universidad Nacional del Santa
                    Universidad Nacional del Santa
                    Bachelors degree, Ingeniería de Sistemas e Informática'
            ]);*/
            Company::create([
                'name' => 'Kuali',
                'logo' => 'https://placehold.co/640x480?text=K'
            ]);
            Position::create([
                'company_id' => 1,
                'slug' => 'programador-backend-php',
                'title' => 'Programador Backend PHP',
                'description' => 'Estamos en busca de un 
                    Programador Backend PHP que pueda liderar el 
                    desarrollo y optimización de nuestras aplicaciones 
                    web con una arquitectura basada en Microservicios. 
                    Serás responsable de definir la arquitectura, 
                    garantizar buenas prácticas de desarrollo y 
                    colaborar con equipos multidisciplinarios para 
                    ofrecer soluciones escalables y eficientes. 
                    Requisitos Técnicos

                    - Experiencia: +3 años en desarrollo web fullstack.
                    - Frontend: Vue.js, JavaScript/TypeScript, Tailwind o Sass.
                    - Backend: PHP (Laravel), Node.js.
                    - Bases de Datos: PostgreSQL, MySQL.
                    - Infraestructura: Docker, Kubernetes (básico), integración con AWS o GCP.
                    - Metodologías:*Git, Scrum, buenas prácticas de desarrollo seguro.
                    - Arquitectura:*Experiencia en el mantenimiento de una infraestructura basada en Microservicios.',
                'location' => 'Lima, Perú',
                'opened_at' => now(),
            ]);
            Position::factory()->count(3)->create();
            $token = $user->createToken('POSTULACIONES_API_TOKEN')->plainTextToken;
            $this->command->info('Postulaciones API token: '.$token);
        }

    }
}
