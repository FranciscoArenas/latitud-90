<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Program;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Contract;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Crear programas de ejemplo
        $programs = [
            [
                'name' => 'Tour Patagonia Aventura',
                'description' => 'Descubre los paisajes más impresionantes de la Patagonia en este tour de 7 días que incluye trekking, navegación y observación de fauna.',
                'service_type' => 'tours',
                'destination' => 'Patagonia, Chile',
                'departure_date' => Carbon::now()->addDays(30),
                'return_date' => Carbon::now()->addDays(37),
                'duration_days' => 7,
                'capacity' => 20,
                'base_price' => 850000,
                'includes' => 'Transporte, alojamiento, comidas, guía especializado, equipamiento básico',
                'excludes' => 'Vuelos internacionales, seguro de viaje, gastos personales',
                'requirements' => 'Buen estado físico, edad mínima 16 años',
                'itinerary' => 'Día 1: Llegada a Puerto Natales. Día 2-3: Torres del Paine. Día 4-5: El Calafate. Día 6-7: Ushuaia y regreso.',
                'active' => true
            ],
            [
                'name' => 'Excursión Valle del Elqui',
                'description' => 'Recorrido de un día por el místico Valle del Elqui, visitando observatorios astronómicos y viñas pisqueras.',
                'service_type' => 'excursiones',
                'destination' => 'Valle del Elqui, IV Región',
                'departure_date' => Carbon::now()->addDays(15),
                'return_date' => Carbon::now()->addDays(15),
                'duration_days' => 1,
                'capacity' => 45,
                'base_price' => 45000,
                'includes' => 'Transporte, almuerzo, entradas a observatorio, degustación de pisco',
                'excludes' => 'Bebidas adicionales, souvenirs',
                'requirements' => 'No hay restricciones especiales',
                'itinerary' => 'Salida 08:00 desde La Serena. Visita Vicuña, observatorio, almuerzo típico, viña pisquera. Regreso 19:00.',
                'active' => true
            ],
            [
                'name' => 'Programa Intercambio Francia',
                'description' => 'Programa de intercambio estudiantil de 6 meses en París con familia anfitriona y clases de francés.',
                'service_type' => 'intercambio',
                'destination' => 'París, Francia',
                'departure_date' => Carbon::now()->addDays(90),
                'return_date' => Carbon::now()->addDays(270),
                'duration_days' => 180,
                'capacity' => 15,
                'base_price' => 3500000,
                'includes' => 'Alojamiento en familia, clases de francés, seguro médico, apoyo académico',
                'excludes' => 'Pasajes aéreos, visa, gastos personales, excursiones opcionales',
                'requirements' => 'Edad 16-25 años, nivel básico de francés, expediente académico',
                'itinerary' => 'Pre-partida: orientación. Mes 1: integración familiar y clases. Meses 2-5: inmersión académica. Mes 6: evaluación final.',
                'active' => true
            ],
            [
                'name' => 'Crucero Fiordos Patagónicos',
                'description' => 'Navegación de 4 días por los espectaculares fiordos patagónicos desde Puerto Montt a Puerto Natales.',
                'service_type' => 'cruceros',
                'destination' => 'Fiordos Patagónicos',
                'departure_date' => Carbon::now()->addDays(45),
                'return_date' => Carbon::now()->addDays(49),
                'duration_days' => 4,
                'capacity' => 200,
                'base_price' => 680000,
                'includes' => 'Camarote, todas las comidas, excursiones en zodiac, charlas naturalistas',
                'excludes' => 'Bebidas alcohólicas, propinas, traslados terrestres',
                'requirements' => 'No hay restricciones especiales',
                'itinerary' => 'Día 1: Embarque Puerto Montt. Día 2: Glaciar Pío XI. Día 3: Estrecho de Magallanes. Día 4: Desembarque Puerto Natales.',
                'active' => true
            ],
            [
                'name' => 'City Tour Santiago Premium',
                'description' => 'Recorrido premium por los principales atractivos de Santiago con almuerzo en restaurante gourmet.',
                'service_type' => 'tours',
                'destination' => 'Santiago, Chile',
                'departure_date' => Carbon::now()->addDays(7),
                'return_date' => Carbon::now()->addDays(7),
                'duration_days' => 1,
                'capacity' => 25,
                'base_price' => 85000,
                'includes' => 'Transporte privado, guía bilingüe, almuerzo gourmet, entradas a museos',
                'excludes' => 'Propinas, bebidas alcohólicas',
                'requirements' => 'No hay restricciones especiales',
                'itinerary' => 'Plaza de Armas, La Moneda, Cerro San Cristóbal, Barrio Bellavista, almuerzo, Las Condes, compras.',
                'active' => true
            ]
        ];

        foreach ($programs as $programData) {
            Program::create($programData);
        }

        // Crear algunos pasajeros de ejemplo
        $passengers = [
            [
                'program_id' => 1,
                'full_name' => 'María González Pérez',
                'email' => 'maria.gonzalez@email.com',
                'phone' => '+56912345678',
                'document_type' => 'rut',
                'document_number' => '12345678-9',
                'birth_date' => '1990-05-15',
                'address' => 'Av. Providencia 1234, Santiago',
                'emergency_contact_name' => 'Pedro González',
                'emergency_contact_phone' => '+56987654321',
                'dietary_restrictions' => 'Vegetariana',
                'medical_conditions' => null,
                'status' => 'confirmed',
                'registration_date' => now()->subDays(5),
                'individual_price' => 850000
            ],
            [
                'program_id' => 2,
                'full_name' => 'Carlos Rodríguez Silva',
                'email' => 'carlos.rodriguez@email.com',
                'phone' => '+56923456789',
                'document_type' => 'rut',
                'document_number' => '23456789-0',
                'birth_date' => '1985-12-03',
                'address' => 'Calle Los Carrera 567, La Serena',
                'emergency_contact_name' => 'Ana Silva',
                'emergency_contact_phone' => '+56876543210',
                'dietary_restrictions' => null,
                'medical_conditions' => null,
                'status' => 'pending_payment',
                'registration_date' => now()->subDays(2),
                'individual_price' => 45000
            ],
            [
                'program_id' => 1,
                'full_name' => 'Ana Martínez López',
                'email' => 'ana.martinez@email.com',
                'phone' => '+56934567890',
                'document_type' => 'cedula',
                'document_number' => '34567890',
                'birth_date' => '1992-08-22',
                'address' => 'Pasaje Las Flores 123, Valparaíso',
                'emergency_contact_name' => 'Luis Martínez',
                'emergency_contact_phone' => '+56765432109',
                'dietary_restrictions' => null,
                'medical_conditions' => 'Alergia a mariscos',
                'status' => 'confirmed',
                'registration_date' => now()->subDays(10),
                'individual_price' => 850000
            ]
        ];

        foreach ($passengers as $passengerData) {
            $passenger = Passenger::create($passengerData);

            // Crear contrato para cada pasajero
            Contract::create([
                'passenger_id' => $passenger->id,
                'contract_number' => $passenger->program->service_type === 'tours' || $passenger->program->service_type === 'excursiones' 
                    ? 'VOUCHER-' . str_pad($passenger->id, 6, '0', STR_PAD_LEFT)
                    : 'CONT-' . str_pad($passenger->id, 6, '0', STR_PAD_LEFT),
                'contract_type' => $passenger->program->service_type === 'tours' || $passenger->program->service_type === 'excursiones' 
                    ? 'voucher' 
                    : 'contract',
                'total_amount' => $passenger->individual_price,
                'status' => $passenger->status === 'confirmed' ? 'active' : 'pending',
                'issue_date' => $passenger->registration_date
            ]);

            // Crear pagos según el estado del pasajero
            if ($passenger->status === 'confirmed') {
                // Pago completo realizado
                Payment::create([
                    'passenger_id' => $passenger->id,
                    'amount' => $passenger->individual_price,
                    'payment_date' => $passenger->registration_date->addHours(2),
                    'payment_method' => 'online',
                    'gateway' => 'transbank',
                    'gateway_transaction_id' => 'TXN' . random_int(100000, 999999),
                    'status' => 'completed',
                    'installment_number' => 1,
                    'total_installments' => 1,
                    'due_date' => $passenger->registration_date->addDay()
                ]);
            } else {
                // Pago pendiente
                Payment::create([
                    'passenger_id' => $passenger->id,
                    'amount' => $passenger->individual_price,
                    'payment_date' => null,
                    'payment_method' => 'online',
                    'gateway' => 'transbank',
                    'status' => 'pending',
                    'installment_number' => 1,
                    'total_installments' => 1,
                    'due_date' => now()->addDay()
                ]);
            }
        }

        $this->command->info('Datos de prueba creados exitosamente:');
        $this->command->info('- Usuario admin: admin@example.com / password');
        $this->command->info('- 5 programas de diferentes tipos');
        $this->command->info('- 3 pasajeros con pagos y contratos');
    }
}
