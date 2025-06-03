<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ExtendedDataSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador si no existe
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Crear 20 programas variados
        $programs = [
            [
                'name' => 'Aventura Patagonia Extrema',
                'description' => 'Expedición de 10 días por la Patagonia con trekking avanzado, escalada y camping.',
                'service_type' => 'tours',
                'destination' => 'Patagonia, Chile',
                'departure_date' => Carbon::now()->addDays(45),
                'return_date' => Carbon::now()->addDays(55),
                'duration_days' => 10,
                'capacity' => 15,
                'base_price' => 1200000,
                'includes' => 'Equipamiento técnico, guías especializados, camping, comidas',
                'excludes' => 'Vuelos, seguro personal',
                'requirements' => 'Excelente condición física, experiencia en montaña',
                'active' => true
            ],
            [
                'name' => 'Tour Gastronómico Santiago',
                'description' => 'Experiencia culinaria por los mejores restaurantes y mercados de Santiago.',
                'service_type' => 'tours',
                'destination' => 'Santiago, Chile',
                'departure_date' => Carbon::now()->addDays(15),
                'return_date' => Carbon::now()->addDays(15),
                'duration_days' => 1,
                'capacity' => 20,
                'base_price' => 95000,
                'includes' => 'Degustaciones, chef guía, transporte',
                'excludes' => 'Bebidas alcohólicas adicionales',
                'requirements' => 'Ninguno especial',
                'active' => true
            ],
            [
                'name' => 'Excursión Volcán Villarrica',
                'description' => 'Ascenso al volcán Villarrica con vistas espectaculares y actividad volcánica.',
                'service_type' => 'excursiones',
                'destination' => 'Pucón, IX Región',
                'departure_date' => Carbon::now()->addDays(25),
                'return_date' => Carbon::now()->addDays(25),
                'duration_days' => 1,
                'capacity' => 12,
                'base_price' => 75000,
                'includes' => 'Equipamiento, guía de montaña, transporte',
                'excludes' => 'Almuerzo, equipamiento personal',
                'requirements' => 'Buena condición física',
                'active' => true
            ],
            [
                'name' => 'Intercambio Académico Alemania',
                'description' => 'Programa de intercambio de 1 año en universidades alemanas.',
                'service_type' => 'intercambio',
                'destination' => 'Berlín, Alemania',
                'departure_date' => Carbon::now()->addDays(120),
                'return_date' => Carbon::now()->addDays(485),
                'duration_days' => 365,
                'capacity' => 8,
                'base_price' => 4500000,
                'includes' => 'Matrícula, alojamiento, clases de alemán',
                'excludes' => 'Pasajes, visa, gastos personales',
                'requirements' => 'Promedio mínimo 6.0, nivel básico alemán',
                'active' => true
            ],
            [
                'name' => 'Crucero Fiordos Noruegos',
                'description' => 'Navegación de lujo por los espectaculares fiordos de Noruega.',
                'service_type' => 'cruceros',
                'destination' => 'Fiordos Noruegos',
                'departure_date' => Carbon::now()->addDays(80),
                'return_date' => Carbon::now()->addDays(87),
                'duration_days' => 7,
                'capacity' => 150,
                'base_price' => 2800000,
                'includes' => 'Suite premium, todas las comidas, excursiones',
                'excludes' => 'Vuelos internacionales, propinas',
                'requirements' => 'Pasaporte vigente',
                'active' => true
            ],
            [
                'name' => 'Safari Africano Kenya-Tanzania',
                'description' => 'Safari fotográfico de 14 días por los parques más famosos de África.',
                'service_type' => 'tours',
                'destination' => 'Kenya-Tanzania',
                'departure_date' => Carbon::now()->addDays(95),
                'return_date' => Carbon::now()->addDays(109),
                'duration_days' => 14,
                'capacity' => 16,
                'base_price' => 3200000,
                'includes' => 'Lodges, todas las comidas, safaris, guía local',
                'excludes' => 'Vuelos internacionales, visas, vacunas',
                'requirements' => 'Vacunas obligatorias, seguro médico',
                'active' => true
            ],
            [
                'name' => 'Excursión Desierto de Atacama',
                'description' => 'Exploración de 3 días por el desierto más árido del mundo.',
                'service_type' => 'excursiones',
                'destination' => 'San Pedro de Atacama',
                'departure_date' => Carbon::now()->addDays(35),
                'return_date' => Carbon::now()->addDays(38),
                'duration_days' => 3,
                'capacity' => 22,
                'base_price' => 280000,
                'includes' => 'Alojamiento, desayunos, excursiones, transporte',
                'excludes' => 'Almuerzos, cenas, entradas parques',
                'requirements' => 'Protección solar, ropa adecuada',
                'active' => true
            ],
            [
                'name' => 'Tour Cultural Japón',
                'description' => 'Inmersión cultural de 12 días por Tokio, Kyoto y Osaka.',
                'service_type' => 'tours',
                'destination' => 'Japón',
                'departure_date' => Carbon::now()->addDays(110),
                'return_date' => Carbon::now()->addDays(122),
                'duration_days' => 12,
                'capacity' => 18,
                'base_price' => 2600000,
                'includes' => 'Hoteles, JR Pass, guía local, algunas comidas',
                'excludes' => 'Vuelos internacionales, todas las comidas',
                'requirements' => 'Pasaporte vigente, visa',
                'active' => true
            ],
            [
                'name' => 'Excursión Laguna del Inca',
                'description' => 'Trekking de día completo a la hermosa Laguna del Inca en Portillo.',
                'service_type' => 'excursiones',
                'destination' => 'Portillo, V Región',
                'departure_date' => Carbon::now()->addDays(20),
                'return_date' => Carbon::now()->addDays(20),
                'duration_days' => 1,
                'capacity' => 25,
                'base_price' => 55000,
                'includes' => 'Transporte, guía, almuerzo picnic',
                'excludes' => 'Equipamiento personal',
                'requirements' => 'Condición física regular',
                'active' => true
            ],
            [
                'name' => 'Intercambio Cultural Francia',
                'description' => 'Programa de inmersión cultural de 3 meses en Lyon.',
                'service_type' => 'intercambio',
                'destination' => 'Lyon, Francia',
                'departure_date' => Carbon::now()->addDays(75),
                'return_date' => Carbon::now()->addDays(165),
                'duration_days' => 90,
                'capacity' => 10,
                'base_price' => 1800000,
                'includes' => 'Alojamiento familia, clases francés, actividades',
                'excludes' => 'Vuelos, comidas fin de semana',
                'requirements' => 'Nivel básico francés, edad 18-30',
                'active' => true
            ],
            [
                'name' => 'Crucero Antártico Expedición',
                'description' => 'Expedición única de 11 días al continente blanco.',
                'service_type' => 'cruceros',
                'destination' => 'Antártica',
                'departure_date' => Carbon::now()->addDays(140),
                'return_date' => Carbon::now()->addDays(151),
                'duration_days' => 11,
                'capacity' => 100,
                'base_price' => 4800000,
                'includes' => 'Camarote, todas las comidas, excursiones zodiac',
                'excludes' => 'Vuelos a Ushuaia, ropa polar',
                'requirements' => 'Seguro médico especial, buena salud',
                'active' => true
            ],
            [
                'name' => 'Tour Histórico Grecia',
                'description' => 'Recorrido arqueológico de 9 días por los sitios históricos de Grecia.',
                'service_type' => 'tours',
                'destination' => 'Grecia',
                'departure_date' => Carbon::now()->addDays(65),
                'return_date' => Carbon::now()->addDays(74),
                'duration_days' => 9,
                'capacity' => 24,
                'base_price' => 1750000,
                'includes' => 'Hoteles, desayunos, guía arqueólogo, entradas',
                'excludes' => 'Vuelos, almuerzos, cenas',
                'requirements' => 'Interés en historia antigua',
                'active' => true
            ],
            [
                'name' => 'Excursión Salto del Laja',
                'description' => 'Día completo explorando las cascadas del Salto del Laja.',
                'service_type' => 'excursiones',
                'destination' => 'Salto del Laja, VIII Región',
                'departure_date' => Carbon::now()->addDays(12),
                'return_date' => Carbon::now()->addDays(12),
                'duration_days' => 1,
                'capacity' => 30,
                'base_price' => 35000,
                'includes' => 'Transporte, guía, entrada parque',
                'excludes' => 'Comidas, actividades opcionales',
                'requirements' => 'Ninguno especial',
                'active' => true
            ],
            [
                'name' => 'Tour Aventura Nueva Zelanda',
                'description' => 'Aventura extrema de 15 días por las dos islas de Nueva Zelanda.',
                'service_type' => 'tours',
                'destination' => 'Nueva Zelanda',
                'departure_date' => Carbon::now()->addDays(130),
                'return_date' => Carbon::now()->addDays(145),
                'duration_days' => 15,
                'capacity' => 14,
                'base_price' => 3800000,
                'includes' => 'Alojamiento, auto rental, actividades extremas',
                'excludes' => 'Vuelos internacionales, comidas',
                'requirements' => 'Licencia de conducir, seguro aventura',
                'active' => true
            ],
            [
                'name' => 'Excursión Termas de Chillán',
                'description' => 'Relajante día en las termas naturales de Chillán.',
                'service_type' => 'excursiones',
                'destination' => 'Termas de Chillán',
                'departure_date' => Carbon::now()->addDays(18),
                'return_date' => Carbon::now()->addDays(18),
                'duration_days' => 1,
                'capacity' => 35,
                'base_price' => 65000,
                'includes' => 'Transporte, entrada termas, almuerzo',
                'excludes' => 'Masajes adicionales, souvenirs',
                'requirements' => 'Traje de baño',
                'active' => true
            ],
            [
                'name' => 'Intercambio Deportivo Brasil',
                'description' => 'Programa de intercambio deportivo de 2 meses en academias brasileñas.',
                'service_type' => 'intercambio',
                'destination' => 'Río de Janeiro, Brasil',
                'departure_date' => Carbon::now()->addDays(55),
                'return_date' => Carbon::now()->addDays(115),
                'duration_days' => 60,
                'capacity' => 12,
                'base_price' => 1200000,
                'includes' => 'Alojamiento, entrenamientos, clases portugués',
                'excludes' => 'Vuelos, comidas fin de semana',
                'requirements' => 'Aptitud deportiva, edad 16-25',
                'active' => true
            ],
            [
                'name' => 'Crucero Mediterráneo Clásico',
                'description' => 'Crucero de 8 días por las capitales del Mediterráneo.',
                'service_type' => 'cruceros',
                'destination' => 'Mediterráneo',
                'departure_date' => Carbon::now()->addDays(85),
                'return_date' => Carbon::now()->addDays(93),
                'duration_days' => 8,
                'capacity' => 200,
                'base_price' => 1900000,
                'includes' => 'Camarote balcón, todas las comidas, entretenimiento',
                'excludes' => 'Vuelos, excursiones en puertos, bebidas',
                'requirements' => 'Pasaporte vigente',
                'active' => true
            ],
            [
                'name' => 'Tour Fotográfico Islandia',
                'description' => 'Expedición fotográfica de 10 días por los paisajes únicos de Islandia.',
                'service_type' => 'tours',
                'destination' => 'Islandia',
                'departure_date' => Carbon::now()->addDays(100),
                'return_date' => Carbon::now()->addDays(110),
                'duration_days' => 10,
                'capacity' => 12,
                'base_price' => 2900000,
                'includes' => 'Alojamiento, vehículo 4x4, guía fotógrafo',
                'excludes' => 'Vuelos, equipamiento fotográfico, comidas',
                'requirements' => 'Cámara profesional, ropa térmica',
                'active' => true
            ],
            [
                'name' => 'Excursión Valles Centrales',
                'description' => 'Recorrido de 2 días por los valles vitivinícolas centrales.',
                'service_type' => 'excursiones',
                'destination' => 'Valle Central, Chile',
                'departure_date' => Carbon::now()->addDays(28),
                'return_date' => Carbon::now()->addDays(30),
                'duration_days' => 2,
                'capacity' => 28,
                'base_price' => 180000,
                'includes' => 'Alojamiento, degustaciones, transporte',
                'excludes' => 'Compras vinos, cenas gourmet',
                'requirements' => 'Mayor de edad para degustaciones',
                'active' => true
            ],
            [
                'name' => 'Tour Místico Perú',
                'description' => 'Expedición espiritual de 13 días por los sitios sagrados del Perú.',
                'service_type' => 'tours',
                'destination' => 'Perú',
                'departure_date' => Carbon::now()->addDays(70),
                'return_date' => Carbon::now()->addDays(83),
                'duration_days' => 13,
                'capacity' => 16,
                'base_price' => 2200000,
                'includes' => 'Hoteles, guía espiritual, ceremonias, comidas típicas',
                'excludes' => 'Vuelos internacionales, donaciones opcionales',
                'requirements' => 'Mente abierta, respeto cultural',
                'active' => true
            ]
        ];

        $createdPrograms = [];
        foreach ($programs as $programData) {
            $createdPrograms[] = Program::create($programData);
        }

        // Generar nombres chilenos realistas
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

        $emails_domains = ['gmail.com', 'outlook.com', 'yahoo.com', 'hotmail.com', 'email.cl'];

        // Crear 40 pasajeros
        $createdPassengers = [];
        for ($i = 0; $i < 40; $i++) {
            $nombreCompleto = $nombres[$i % count($nombres)];
            $apellidoCompleto = $apellidos[$i % count($apellidos)];
            $email = strtolower(str_replace(' ', '.', $nombreCompleto)) . '.' .
                     strtolower(explode(' ', $apellidoCompleto)[0]) . '@' .
                     $emails_domains[array_rand($emails_domains)];

            $passenger = Passenger::create([
                'full_name' => $nombreCompleto . ' ' . $apellidoCompleto,
                'email' => $email,
                'phone' => '+569' . rand(10000000, 99999999),
                'document_type' => 'rut',
                'document_number' => rand(10000000, 19999999) . '-' . rand(0, 9),
                'birth_date' => Carbon::now()->subYears(rand(18, 65))->subDays(rand(1, 365)),
                'address' => 'Calle ' . chr(rand(65, 90)) . rand(100, 9999) . ', ' .
                           ['Santiago', 'Valparaíso', 'Concepción', 'La Serena', 'Temuco'][rand(0, 4)],
                'emergency_contact_name' => $nombres[rand(0, count($nombres)-1)] . ' ' .
                                          explode(' ', $apellidos[rand(0, count($apellidos)-1)])[0],
                'emergency_contact_phone' => '+569' . rand(10000000, 99999999),
                'dietary_restrictions' => rand(0, 100) < 20 ?
                    ['Vegetariano', 'Vegano', 'Sin gluten', 'Sin lactosa'][rand(0, 3)] : null,
                'medical_conditions' => rand(0, 100) < 15 ?
                    ['Diabetes', 'Hipertensión', 'Asma', 'Alergias'][rand(0, 3)] : null,
                'status' => ['pending_payment', 'confirmed', 'confirmed'][rand(0, 2)], // Más probabilidad de confirmado
                'registration_date' => Carbon::now()->subDays(rand(1, 30)),
                'individual_price' => 0, // Se calculará con base en los programas
                'program_id' => 1 // Campo legacy, lo mantenemos pero usaremos la tabla pivot
            ]);

            $createdPassengers[] = $passenger;
        }

        // Asignar 3 programas distintos a cada pasajero usando la tabla pivot
        foreach ($createdPassengers as $passenger) {
            // Seleccionar 3 programas aleatorios distintos
            $selectedProgramIds = collect($createdPrograms)->pluck('id')->shuffle()->take(3);

            foreach ($selectedProgramIds as $programId) {
                $program = collect($createdPrograms)->firstWhere('id', $programId);

                // Calcular precio individual (con variación de ±20%)
                $basePrice = $program->base_price;
                $variation = rand(-20, 20) / 100;
                $individualPrice = $basePrice * (1 + $variation);

                // Posible ajuste de precio
                $priceAdjustment = rand(0, 100) < 30 ? rand(-50000, 100000) : 0;
                $adjustmentReason = $priceAdjustment > 0 ? 'Servicios adicionales' :
                                  ($priceAdjustment < 0 ? 'Descuento promocional' : null);

                // Insertar en tabla pivot
                $passenger->programs()->attach($programId, [
                    'individual_price' => $individualPrice,
                    'price_adjustments' => $priceAdjustment,
                    'adjustment_reason' => $adjustmentReason,
                    'status' => ['pending_payment', 'confirmed', 'confirmed'][rand(0, 2)],
                    'registration_date' => Carbon::now()->subDays(rand(1, 30)),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Crear contrato para cada relación pasajero-programa
                Contract::create([
                    'passenger_id' => $passenger->id,
                    'contract_number' => $program->service_type === 'tours' || $program->service_type === 'excursiones'
                        ? 'VOUCHER-' . str_pad($passenger->id, 4, '0', STR_PAD_LEFT) . '-' . str_pad($programId, 3, '0', STR_PAD_LEFT)
                        : 'CONT-' . str_pad($passenger->id, 4, '0', STR_PAD_LEFT) . '-' . str_pad($programId, 3, '0', STR_PAD_LEFT),
                    'contract_type' => $program->service_type === 'tours' || $program->service_type === 'excursiones'
                        ? 'voucher'
                        : 'contract',
                    'total_amount' => $individualPrice + $priceAdjustment,
                    'paid_amount' => rand(0, 100) < 60 ? $individualPrice + $priceAdjustment : rand(0, $individualPrice),
                    'pending_amount' => 0, // Se calculará automáticamente
                    'status' => 'active',
                    'issue_date' => Carbon::now()->subDays(rand(1, 20))
                ]);

                // Crear pagos
                $totalAmount = $individualPrice + $priceAdjustment;
                $paymentStatus = ['pending', 'completed', 'completed'][rand(0, 2)];

                if ($paymentStatus === 'completed') {
                    Payment::create([
                        'passenger_id' => $passenger->id,
                        'amount' => $totalAmount,
                        'payment_date' => Carbon::now()->subDays(rand(1, 15)),
                        'payment_method' => ['online', 'cash', 'transfer'][rand(0, 2)],
                        'gateway' => rand(0, 1) ? 'transbank' : 'khipu',
                        'gateway_transaction_id' => 'TXN' . rand(100000, 999999),
                        'status' => 'completed',
                        'installment_number' => 1,
                        'total_installments' => 1,
                        'due_date' => Carbon::now()->subDays(rand(1, 10))
                    ]);
                } else {
                    Payment::create([
                        'passenger_id' => $passenger->id,
                        'amount' => $totalAmount,
                        'payment_date' => null,
                        'payment_method' => 'online',
                        'gateway' => rand(0, 1) ? 'transbank' : 'khipu',
                        'status' => 'pending',
                        'installment_number' => 1,
                        'total_installments' => 1,
                        'due_date' => Carbon::now()->addDays(rand(1, 30))
                    ]);
                }
            }
        }

        $this->command->info('Datos extendidos creados exitosamente:');
        $this->command->info('- 20 programas variados');
        $this->command->info('- 40 pasajeros con 3 programas cada uno');
        $this->command->info('- Contratos y pagos correspondientes');
        $this->command->info('- Relaciones many-to-many implementadas');
    }
}
