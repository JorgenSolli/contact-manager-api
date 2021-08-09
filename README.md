---
title: EcoOnline Contact Manager API
---

# EcoOnline Contact Manager API

## Installation

```
composer require ecoonline/contact-manager-api
```

Add `CONTACT_MANAGER_ENABLE_API_ROUTES` to your `.env` file and set it to `true` to enable the API endpoints


## Testing

### Seeding the database

```
php artisan db:seed --class="EcoOnline\ContactManagerApi\Database\Seeders\ContactSeeder"
```
