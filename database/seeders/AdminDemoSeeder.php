<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminDemoSeeder extends Seeder
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

        // Crear programas de ejemplo
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
                'active' => false,
            ],
        ];

        $createdPrograms = [];
        foreach ($programs as $programData) {
            $createdPrograms[] = Program::create($programData);
        }

        // Crear pasajeros de ejemplo
        $passengers = [
            [
                'program_id' => $createdPrograms[0]->id,
                'full_name' => 'María González López',
                'email' => 'maria.gonzalez@email.com',
                'phone' => '+56912345678',
                'document_type' => 'rut',
                'document_number' => '12345678-9',
                'birth_date' => '1985-03-15',
                'address' => 'Av. Providencia 1234, Santiago',
                'emergency_contact_name' => 'José González',
                'emergency_contact_phone' => '+56911111111',
                'dietary_restrictions' => 'Vegetariana',
                'medical_conditions' => 'Ninguna',
                'status' => 'confirmed',
                'registration_date' => now()->subDays(10),
                'individual_price' => 850000,
                'price_adjustments' => 0,
            ],
            [
                'program_id' => $createdPrograms[1]->id,
                'full_name' => 'Carlos Rodríguez Silva',
                'email' => 'carlos.rodriguez@email.com',
                'phone' => '+56987654321',
                'document_type' => 'rut',
                'document_number' => '98765432-1',
                'birth_date' => '1978-11-22',
                'address' => 'Calle Las Flores 567, Valparaíso',
                'emergency_contact_name' => 'Ana Rodríguez',
                'emergency_contact_phone' => '+56922222222',
                'dietary_restrictions' => null,
                'medical_conditions' => 'Hipertensión controlada',
                'status' => 'pending_payment',
                'registration_date' => now()->subDays(15),
                'individual_price' => 1200000,
                'price_adjustments' => -100000,
                'adjustment_reason' => 'Descuento por cliente frecuente',
            ],
            [
                'program_id' => $createdPrograms[2]->id,
                'full_name' => 'Ana Martínez Rojas',
                'email' => 'ana.martinez@email.com',
                'phone' => '+56956789123',
                'document_type' => 'cedula',
                'document_number' => '15975348-6',
                'birth_date' => '1990-07-08',
                'address' => 'Pasaje Los Álamos 890, Concepción',
                'emergency_contact_name' => 'Pedro Martínez',
                'emergency_contact_phone' => '+56933333333',
                'dietary_restrictions' => 'Sin gluten',
                'medical_conditions' => 'Alergia a mariscos',
                'status' => 'cancelled',
                'registration_date' => now()->subDays(25),
                'individual_price' => 680000,
                'price_adjustments' => 0,
            ],
            [
                'program_id' => $createdPrograms[0]->id,
                'full_name' => 'Pedro Silva Vargas',
                'email' => 'pedro.silva@email.com',
                'phone' => '+56923456789',
                'document_type' => 'pasaporte',
                'document_number' => 'AB123456',
                'birth_date' => '1982-12-03',
                'address' => 'Av. O\'Higgins 456, Rancagua',
                'emergency_contact_name' => 'Carmen Silva',
                'emergency_contact_phone' => '+56944444444',
                'dietary_restrictions' => null,
                'medical_conditions' => 'Diabetes tipo 2',
                'status' => 'confirmed',
                'registration_date' => now()->subDays(8),
                'individual_price' => 850000,
                'price_adjustments' => 50000,
                'adjustment_reason' => 'Costo adicional seguro médico',
            ],
            [
                'program_id' => $createdPrograms[2]->id,
                'full_name' => 'Laura Fernández Torres',
                'email' => 'laura.fernandez@email.com',
                'phone' => '+56945678912',
                'document_type' => 'rut',
                'document_number' => '45678912-3',
                'birth_date' => '1987-09-18',
                'address' => 'Los Aromos 123, La Serena',
                'emergency_contact_name' => 'Miguel Fernández',
                'emergency_contact_phone' => '+56955555555',
                'dietary_restrictions' => 'Vegana',
                'medical_conditions' => 'Ninguna',
                'status' => 'pending_payment',
                'registration_date' => now()->subDays(12),
                'individual_price' => 680000,
                'price_adjustments' => -30000,
                'adjustment_reason' => 'Descuento promocional',
            ],
        ];

        $createdPassengers = [];
        foreach ($passengers as $passengerData) {
            $createdPassengers[] = Passenger::create($passengerData);
        }

        // Crear pagos de ejemplo
        $payments = [
            [
                'passenger_id' => $createdPassengers[0]->id,
                'amount' => 850000,
                'payment_date' => now()->subDays(5),
                'payment_method' => 'online',
                'gateway' => 'transbank',
                'gateway_transaction_id' => 'TXN_' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'gateway_response' => json_encode(['status' => 'AUTHORIZED', 'response_code' => '0']),
                'status' => 'completed',
                'installment_number' => 1,
                'total_installments' => 1,
                'invoice_number' => 'INV-2025-0001',
            ],
            [
                'passenger_id' => $createdPassengers[1]->id,
                'amount' => 550000,
                'payment_date' => now()->subDays(12),
                'payment_method' => 'online',
                'gateway' => 'khipu',
                'gateway_transaction_id' => 'KHP_' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'gateway_response' => json_encode(['subject' => 'Pago Torres del Paine', 'state' => 'done']),
                'status' => 'completed',
                'installment_number' => 1,
                'total_installments' => 2,
                'due_date' => now()->addDays(30),
                'invoice_number' => 'INV-2025-0002',
            ],
            [
                'passenger_id' => $createdPassengers[1]->id,
                'amount' => 550000,
                'payment_date' => null,
                'payment_method' => 'online',
                'gateway' => 'khipu',
                'gateway_transaction_id' => null,
                'gateway_response' => null,
                'status' => 'pending',
                'installment_number' => 2,
                'total_installments' => 2,
                'due_date' => now()->addDays(60),
                'invoice_number' => 'INV-2025-0003',
            ],
            [
                'passenger_id' => $createdPassengers[2]->id,
                'amount' => 680000,
                'payment_date' => null,
                'payment_method' => 'transfer',
                'gateway' => null,
                'gateway_transaction_id' => null,
                'gateway_response' => null,
                'status' => 'failed',
                'installment_number' => 1,
                'total_installments' => 1,
                'due_date' => now()->subDays(5),
                'invoice_number' => 'INV-2025-0004',
            ],
            [
                'passenger_id' => $createdPassengers[3]->id,
                'amount' => 450000,
                'payment_date' => now()->subDays(8),
                'payment_method' => 'cash',
                'gateway' => null,
                'gateway_transaction_id' => 'CSH_' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'gateway_response' => json_encode(['method' => 'cash', 'received_by' => 'admin']),
                'status' => 'completed',
                'installment_number' => 1,
                'total_installments' => 2,
                'invoice_number' => 'INV-2025-0005',
            ],
            [
                'passenger_id' => $createdPassengers[3]->id,
                'amount' => 450000,
                'payment_date' => null,
                'payment_method' => 'online',
                'gateway' => 'transbank',
                'gateway_transaction_id' => null,
                'gateway_response' => null,
                'status' => 'pending',
                'installment_number' => 2,
                'total_installments' => 2,
                'due_date' => now()->addDays(15),
                'invoice_number' => 'INV-2025-0006',
            ],
            [
                'passenger_id' => $createdPassengers[4]->id,
                'amount' => 325000,
                'payment_date' => now()->subDays(10),
                'payment_method' => 'online',
                'gateway' => 'transbank',
                'gateway_transaction_id' => 'TXN_' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'gateway_response' => json_encode(['status' => 'AUTHORIZED', 'response_code' => '0']),
                'status' => 'completed',
                'installment_number' => 1,
                'total_installments' => 2,
                'invoice_number' => 'INV-2025-0007',
            ],
            [
                'passenger_id' => $createdPassengers[4]->id,
                'amount' => 325000,
                'payment_date' => null,
                'payment_method' => 'online',
                'gateway' => 'transbank',
                'gateway_transaction_id' => null,
                'gateway_response' => null,
                'status' => 'pending',
                'installment_number' => 2,
                'total_installments' => 2,
                'due_date' => now()->addDays(20),
                'invoice_number' => 'INV-2025-0008',
            ],
        ];

        foreach ($payments as $paymentData) {
            Payment::create($paymentData);
        }

        $this->command->info('✅ Datos de demostración creados exitosamente:');
        $this->command->info('👤 Usuario admin: admin@example.com / password');
        $this->command->info('🏝️  4 programas turísticos (tours, excursiones)');
        $this->command->info('👥 5 pasajeros con diferentes estados y documentos');
        $this->command->info('💳 8 pagos con varios métodos, gateways y cuotas');
        $this->command->info('📊 Sistema listo para probar el panel administrativo');
    }
}
