# CustomCraft - Laravel E-Commerce Platform

> A comprehensive e-commerce website for CustomCraft printing services with modern admin panel and dynamic content management.

![CustomCraft]

## 🚀 Features

### 🛍️ **E-Commerce Core**

-   **Product Catalog** - Complete product listing with search and filtering
-   **Product Detail Pages** - Multi-image galleries with detailed descriptions
-   **Portfolio Showcase** - Dynamic portfolio with project details
-   **Contact System** - Advanced contact form with admin notifications

### 🎛️ **Admin Panel (Filament)**

-   **Dashboard** - Real-time statistics and insights
-   **Product Management** - CRUD operations with image uploads
-   **Banner Management** - Homepage banner carousel control
-   **Portfolio Management** - Project showcase administration
-   **Team Management** - Dynamic team member profiles
-   **Contact Management** - Message tracking with read/unread status
-   **User Management** - User accounts with role-based access

### 🎨 **Modern UI/UX**

-   **Responsive Design** - Mobile-first approach with Tailwind CSS
-   **Interactive Components** - Smooth animations and hover effects
-   **SEO Optimized** - Proper meta tags and structured data
-   **Performance Optimized** - Lazy loading and image optimization

## 📋 Requirements

-   **PHP** >= 8.1
-   **Composer** >= 2.0
-   **Node.js** >= 16.x
-   **MySQL** >= 8.0 or **MariaDB** >= 10.4
-   **Git** for version control

## 🛠️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/mochamadAmirulIkhsani/CustomCraft-QA.git
cd CustomCraft-Laravel_CRUD
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Configuration

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=customcraft
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Create Database

Create a new MySQL database named `customcraft` or use your preferred name.

### 7. Storage Setup

```bash
# Create storage link
php artisan storage:link
```

### 8. Run Migrations & Seeders

```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 9. Build Frontend Assets

```bash
# For development
npm run dev

# For production
npm run build
```

### 10. Start Development Server

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

## 🔐 Default Admin Access

After seeding, you can access the admin panel:

-   **URL**: http://localhost:8000/admin
-   **Email**: admin@customcraft.com
-   **Password**: password

## 📁 Project Structure

```
CustomCraft-Laravel_CRUD/
├── app/
│   ├── Filament/           # Admin panel resources
│   ├── Http/Controllers/   # Application controllers
│   ├── Models/            # Eloquent models
│   └── Rules/             # Custom validation rules
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
├── public/
│   ├── images/           # Static images
│   └── storage/          # Symlinked storage
└── routes/               # Application routes
```

## 🎯 Usage Guide

### For Administrators

1. **Login to Admin Panel**: Navigate to `/admin` and login with admin credentials
2. **Manage Products**: Add, edit, or delete products with multiple images
3. **Update Banners**: Control homepage banner carousel
4. **Manage Portfolio**: Showcase completed projects
5. **Team Management**: Add/edit team member profiles
6. **Handle Contacts**: View and manage customer inquiries

### For Visitors

1. **Browse Products**: Explore the product catalog
2. **View Details**: Check detailed product information
3. **Contact Business**: Use the contact form for inquiries
4. **WhatsApp Integration**: Direct messaging via WhatsApp buttons

## 🔧 Configuration

### File Uploads

Configure file upload settings in `config/filesystems.php`:

```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
],
```

### Email Configuration

For contact form notifications, configure mail in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

## 🚀 Deployment

### Production Checklist

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Configure proper database credentials
4. Run `php artisan config:cache`
5. Run `php artisan route:cache`
6. Run `php artisan view:cache`
7. Set proper file permissions
8. Configure web server (Apache/Nginx)

### Recommended Server Configuration

-   **PHP**: Enable required extensions (pdo_mysql, gd, fileinfo, etc.)
-   **Web Server**: Configure document root to `/public`
-   **SSL**: Use HTTPS for production
-   **Backup**: Regular database and file backups

## 🛡️ Security Features

-   **CSRF Protection** - Built-in Laravel CSRF tokens
-   **SQL Injection Protection** - Eloquent ORM with parameter binding
-   **Password Hashing** - Bcrypt password hashing
-   **File Upload Validation** - Secure file upload handling
-   **Role-Based Access** - Admin authentication required

## 🔍 Troubleshooting

### Common Issues

**Storage Link Error**

```bash
php artisan storage:link --force
```

**Permission Issues**

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

**Cache Issues**

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

**Migration Issues**

```bash
php artisan migrate:fresh --seed
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

-   **Laravel Framework** - The PHP framework for web artisans
-   **Filament** - Modern admin panel for Laravel
-   **Tailwind CSS** - Utility-first CSS framework
-   **Font Awesome** - Icon library

## 📞 Support

For support and questions:

-   **Email**: support@customcraft.com
-   **GitHub Issues**: [Create an issue](https://github.com/mochamadAmirulIkhsani/CustomCraft-QA/issues)

---

Made with ❤️ by the CustomCraft team
