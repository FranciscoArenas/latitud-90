<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EnhancedDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Crear programas de ejemplo más variados
        $programs = [
            [
                'name' => 'Tour Isla de Pascua 5 días',
                'description' => 'Descubre los misterios de Rapa Nui en este increíble tour de 5 días. Incluye visitas a Moai, Rano Raraku, volcán Rano Kau y las principales atracciones de la isla.',
                'service_type' => 'tours',
                'destination' => 'Isla de Pascua',
                'departure_date' => now()->addDays(30)->format('Y-m-d'),
                'return_date' => now()->addDays(35)->format('Y-m-d'),
                'duration_days' => 5,
                'capacity' => 20,
                'base_price' => 850000,
                'includes' => 'Vuelos, alojamiento, desayunos, tours guiados, traslados',
                'excludes' => 'Almuerzos, cenas, gastos personales',
                'requirements' => 'Pasaporte vigente, estado físico bueno para caminatas',
                'active' => true,
            ],
            [
                'name' => 'Torres del Paine 7 días',
                'description' => 'Aventura completa en el Parque Nacional Torres del Paine. Trekking, avistamiento de fauna y paisajes únicos en la Patagonia chilena.',
                'service_type' => 'excursiones',
                'destination' => 'Torres del Paine, Patagonia',
                'departure_date' => now()->addDays(45)->format('Y-m-d'),
                'return_date' => now()->addDays(52)->format('Y-m-d'),
                'duration_days' => 7,
                'capacity' => 15,
                'base_price' => 1200000,
                'includes' => 'Transporte, alojamiento en refugios, guía especializado, equipos de trekking',
                'excludes' => 'Comidas no especificadas, seguro de viaje, equipos personales',
                'requirements' => 'Excelente condición física, experiencia en trekking',
                'active' => true,
            ],
            [
                'name' => 'Desierto de Atacama 4 días',
                'description' => 'Explora el desierto más árido del mundo. Géiseres del Tatio, Valle de la Luna, Lagunas Altiplánicas y increíbles cielos estrellados.',
                'service_type' => 'tours',
                'destination' => 'Desierto de Atacama',
                'departure_date' => now()->addDays(20)->format('Y-m-d'),
                'return_date' => now()->addDays(24)->format('Y-m-d'),
                'duration_days' => 4,
                'capacity' => 25,
                'base_price' => 680000,
                'includes' => 'Alojamiento, desayunos, tours, traslados desde aeropuerto',
                'excludes' => 'Vuelos, almuerzos, cenas, entrance fees parques',
                'requirements' => 'Ropa abrigada para madrugadas, protección solar',
                'active' => true,
            ],
            [
                'name' => 'Chiloé Mágico 3 días',
                'description' => 'Conoce la cultura y tradiciones de Chiloé. Iglesias patrimoniales, palafitos, mercados artesanales y gastronomía típica.',
                'service_type' => 'tours',
                'destination' => 'Chiloé',
                'departure_date' => now()->addDays(60)->format('Y-m-d'),
                'return_date' => now()->addDays(63)->format('Y-m-d'),
                'duration_days' => 3,
                'capacity' => 18,
                'base_price' => 450000,
                'includes' => 'Alojamiento, desayunos, tours culturales, ferry',
                'excludes' => 'Almuerzos, cenas, compras artesanales',
                'requirements' => 'Ninguno en particular',
                'active' => true,
            ],
            [
                'name' => 'Excursión Valle del Elqui',
                'description' => 'Recorrido de un día por el místico Valle del Elqui, visitando observatorios astronómicos y viñas pisqueras.',
                'service_type' => 'excursiones',
                'destination' => 'Valle del Elqui, IV Región',
                'departure_date' => now()->addDays(15)->format('Y-m-d'),
                'return_date' => now()->addDays(15)->format('Y-m-d'),
                'duration_days' => 1,
                'capacity' => 45,
                'base_price' => 45000,
                'includes' => 'Transporte, almuerzo, entradas a observatorio, degustación de pisco',
                'excludes' => 'Bebidas adicionales, souvenirs',
                'requirements' => 'No hay restricciones especiales',
                'active' => true,
            ],
            [
                'name' => 'Crucero Fiordos Patagónicos',
                'description' => 'Navegación de 4 días por los espectaculares fiordos patagónicos desde Puerto Montt a Puerto Natales.',
                'service_type' => 'cruceros',
                'destination' => 'Fiordos Patagónicos',
                'departure_date' => now()->addDays(75)->format('Y-m-d'),
                'return_date' => now()->addDays(79)->format('Y-m-d'),
                'duration_days' => 4,
                'capacity' => 200,
                'base_price' => 780000,
                'includes' => 'Camarote, todas las comidas, excursiones en zodiac, charlas naturalistas',
                'excludes' => 'Bebidas alcohólicas, propinas, traslados terrestres',
                'requirements' => 'No hay restricciones especiales',
                'active' => true,
            ],
            [
                'name' => 'Intercambio Francia 6 meses',
                'description' => 'Programa de intercambio estudiantil de 6 meses en París con familia anfitriona y clases de francés.',
                'service_type' => 'intercambio',
                'destination' => 'París, Francia',
                'departure_date' => now()->addDays(90)->format('Y-m-d'),
                'return_date' => now()->addDays(270)->format('Y-m-d'),
                'duration_days' => 180,
                'capacity' => 15,
                'base_price' => 3500000,
                'includes' => 'Alojamiento en familia, clases de francés, seguro médico, apoyo académico',
                'excludes' => 'Pasajes aéreos, visa, gastos personales, excursiones opcionales',
                'requirements' => 'Edad 16-25 años, nivel básico de francés, expediente académico',
                'active' => true,
            ],
            [
                'name' => 'Safari Kenia 10 días',
                'description' => 'Safari fotográfico por los parques más famosos de Kenia. Masai Mara, Amboseli y reservas naturales.',
                'service_type' => 'tours',
                'destination' => 'Kenia, África',
                'departure_date' => now()->addDays(120)->format('Y-m-d'),
                'return_date' => now()->addDays(130)->format('Y-m-d'),
                'duration_days' => 10,
                'capacity' => 16,
                'base_price' => 2800000,
                'includes' => 'Lodges, todas las comidas, safaris diarios, guía local',
                'excludes' => 'Vuelos internacionales, visas, vacunas, propinas',
                'requirements' => 'Vacunas obligatorias, seguro médico internacional',
                'active' => true,
            ]
        ];

        $createdPrograms = [];
        foreach ($programs as $programData) {
            $createdPrograms[] = Program::create($programData);
        }

        // Nombres y apellidos chilenos para generar pasajeros realistas
        $nombres = [
            'María José', 'José Luis', 'Carlos Eduardo', 'Ana María', 'Luis Fernando',
            'Carla Alejandra', 'Diego Andrés', 'Francisca Belén', 'Rodrigo Ignacio', 'Valentina Isidora',
            'Sebastián Matías', 'Javiera Nicole', 'Felipe Nicolás', 'Catalina Paz', 'Gonzalo Patricio',
            'Fernanda Sofía', 'Cristián Alonso', 'Constanza Antonia', 'Matías Benjamín', 'Isidora Emilia',
            'Nicolás Gabriel', 'Macarena Ignacia', 'Tomás Joaquín', 'Amanda Josefina', 'Agustín Lucas',
            'Florencia Magdalena', 'Vicente Manuel', 'Esperanza Marcela', 'Maximiliano Martín', 'Trinidad Natalia',
            'Leonardo Oscar', 'Rosario Paulina', 'Esteban Rafael', 'Soledad Rosa', 'Hernán Salvador',
            'Pilar Teresa', 'Orlando Vicente', 'Luz Verónica', 'Patricio Wenceslao', 'Ximena Yolanda'
        ];

        $apellidos = [
            'González Pérez', 'Rodríguez Silva', 'Martínez López', 'García Hernández', 'López González',
            'Hernández Rodríguez', 'Pérez Martínez', 'Silva García', 'Muñoz Fernández', 'Rojas Morales',
            'Fernández Muñoz', 'Morales Rojas', 'Torres Jiménez', 'Jiménez Torres', 'Vargas Castillo',
            'Castillo Vargas', 'Ortega Vega', 'Vega Ortega', 'Mendoza Ruiz', 'Ruiz Mendoza',
            'Herrera Soto', 'Soto Herrera', 'Aguilar Guerrero', 'Guerrero Aguilar', 'Medina Paredes',
            'Paredes Medina', 'Castro Reyes', 'Reyes Castro', 'Romero Flores', 'Flores Romero',
            'Gutiérrez Ramos', 'Ramos Gutiérrez', 'Díaz Campos', 'Campos Díaz', 'Moreno Peña',
            'Peña Moreno', 'Alvarez Cruz', 'Cruz Alvarez', 'Gómez Santander', 'Santander Gómez'
        ];

        $ciudades = ['Santiago', 'Valparaíso', 'Concepción', 'La Serena', 'Temuco', 'Antofagasta', 'Iquique', 'Puerto Montt'];
        $dominios = ['gmail.com', 'outlook.com', 'yahoo.com', 'hotmail.com', 'email.cl'];
        $restriccionesDieteticas = [null, null, null, 'Vegetariano', 'Vegano', 'Sin gluten', 'Sin lactosa'];
        $condicionesMedicas = [null, null, null, null, 'Diabetes', 'Hipertensión', 'Asma', 'Alergias alimentarias'];
        $tiposDocumento = ['rut', 'rut', 'rut', 'cedula', 'pasaporte'];
        $estados = ['pending_payment', 'confirmed', 'confirmed', 'confirmed']; // Más probabilidad de confirmado

        // Crear 40 pasajeros con datos realistas
        $createdPassengers = [];
        for ($i = 0; $i < 40; $i++) {
            $nombre = $nombres[$i % count($nombres)];
            $apellido = $apellidos[$i % count($apellidos)];
            $nombreCompleto = $nombre . ' ' . $apellido;

            // Generar email basado en el nombre
            $emailBase = strtolower(str_replace(' ', '.', $nombre)) . '.' .
                        strtolower(explode(' ', $apellido)[0]);
            $email = $emailBase . '@' . $dominios[array_rand($dominios)];

            // Generar RUT chileno válido
            $rut = rand(10000000, 25000000);
            $documentNumber = $rut . '-' . rand(0, 9);

            // Seleccionar programa aleatorio
            $programa = $createdPrograms[array_rand($createdPrograms)];

            $passenger = Passenger::create([
                'program_id' => $programa->id,
                'full_name' => $nombreCompleto,
                'email' => $email,
                'phone' => '+569' . rand(10000000, 99999999),
                'document_type' => $tiposDocumento[array_rand($tiposDocumento)],
                'document_number' => $documentNumber,
                'birth_date' => now()->subYears(rand(18, 65))->subDays(rand(1, 365))->format('Y-m-d'),
                'address' => 'Av. ' . chr(rand(65, 90)) . rand(100, 9999) . ', ' . $ciudades[array_rand($ciudades)],
                'emergency_contact_name' => $nombres[array_rand($nombres)] . ' ' . explode(' ', $apellidos[array_rand($apellidos)])[0],
                'emergency_contact_phone' => '+569' . rand(10000000, 99999999),
                'dietary_restrictions' => $restriccionesDieteticas[array_rand($restriccionesDieteticas)],
                'medical_conditions' => $condicionesMedicas[array_rand($condicionesMedicas)],
                'status' => $estados[array_rand($estados)],
                'registration_date' => now()->subDays(rand(1, 45)),
                'individual_price' => $programa->base_price,
                'price_adjustments' => rand(0, 100) < 20 ? rand(-100000, 100000) : 0,
                'adjustment_reason' => rand(0, 100) < 20 ? ['Descuento promocional', 'Cliente frecuente', 'Seguro adicional'][rand(0, 2)] : null,
            ]);

            $createdPassengers[] = $passenger;
        }

        // Crear pagos para los pasajeros
        foreach ($createdPassengers as $index => $passenger) {
            if ($passenger->status === 'confirmed') {
                // Pago completado
                Payment::create([
                    'passenger_id' => $passenger->id,
                    'amount' => $passenger->individual_price + $passenger->price_adjustments,
                    'payment_date' => $passenger->registration_date->addHours(rand(2, 48)),
                    'payment_method' => ['online', 'cash', 'transfer'][rand(0, 2)],
                    'gateway' => rand(0, 1) ? 'transbank' : 'khipu',
                    'gateway_transaction_id' => 'TXN_' . str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                    'gateway_response' => json_encode(['status' => 'AUTHORIZED', 'response_code' => '0']),
                    'status' => 'completed',
                    'installment_number' => 1,
                    'total_installments' => rand(1, 3),
                    'invoice_number' => 'INV-2025-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                ]);
            } else {
                // Pago pendiente
                Payment::create([
                    'passenger_id' => $passenger->id,
                    'amount' => $passenger->individual_price + $passenger->price_adjustments,
                    'payment_date' => null,
                    'payment_method' => 'online',
                    'gateway' => rand(0, 1) ? 'transbank' : 'khipu',
                    'gateway_transaction_id' => null,
                    'gateway_response' => null,
                    'status' => 'pending',
                    'installment_number' => 1,
                    'total_installments' => 1,
                    'due_date' => now()->addDays(rand(1, 30)),
                    'invoice_number' => 'INV-2025-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                ]);
            }
        }

        $this->command->info('✅ Datos mejorados creados exitosamente:');
        $this->command->info('👤 Usuario admin: admin@example.com / password');
        $this->command->info('🏝️  8 programas variados (tours, excursiones, intercambios, cruceros)');
        $this->command->info('👥 40 pasajeros con datos realistas chilenos');
        $this->command->info('💳 40 pagos con diferentes estados y métodos');
        $this->command->info('📊 Sistema robusto listo para pruebas completas');
    }
}
