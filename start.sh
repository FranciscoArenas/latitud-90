#!/bin/bash

echo "Starting Laravel application setup..."

# Build frontend assets
echo "Building frontend assets with Vite..."
npm run build
if [ $? -ne 0 ]; then
    echo "ERROR: npm run build failed"
    exit 1
fi
echo "✓ Frontend build completed successfully"

# Wait for database
echo "Waiting for database connection..."
sleep 15

# Test database connection
echo "Testing database connection..."
php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null
while [ $? -ne 0 ]; do
    echo "Database not ready, waiting 5 more seconds..."
    sleep 5
    php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null
done
echo "✓ Database connection established"

# Clear any cached config
echo "Clearing Laravel cache..."
php artisan config:clear
php artisan cache:clear

# Generate application key if needed
echo "Ensuring application key is set..."
php artisan key:generate --force

# Run migrations and seeder
echo "Running database migrations..."
php artisan migrate --force
if [ $? -ne 0 ]; then
    echo "ERROR: Migration failed"
    exit 1
fi
echo "✓ Migrations completed successfully"

echo "Running AdminDemoSeeder..."
php artisan db:seed --class=AdminDemoSeeder --force
if [ $? -ne 0 ]; then
    echo "ERROR: AdminDemoSeeder failed"
    exit 1
fi

echo "Running EnhancedDemoSeeder..."
php artisan db:seed --class=EnhancedDemoSeeder --force
if [ $? -ne 0 ]; then
    echo "WARNING: EnhancedDemoSeeder failed, but continuing"
fi
echo "✓ Seeders completed successfully"

# Start the Laravel development server
echo "Starting Laravel server on port 8086..."
echo "🚀 Application will be available at http://localhost:8086"
php artisan serve --host=0.0.0.0 --port=8086
