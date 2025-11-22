<!-- portfolio -->
<!-- slug: hotel-hebat -->
<!-- title: Hotel Hebat Reservation System -->
<!-- description: Hotel reservation web application with real-time room availability, email notifications, and comprehensive booking management -->
<!-- image: https://user-images.githubusercontent.com/68214221/167259266-ebf72cd7-d495-4d04-b91f-d98c4fab4e55.png -->
<!-- tags: laravel, php, mysql, bootstrap, reservation-system, email-notifications -->

<p align="center"><a href="" target="_blank"><img src="https://user-images.githubusercontent.com/68214221/167259266-ebf72cd7-d495-4d04-b91f-d98c4fab4e55.png" width="400"></a></p>

# Hotel Hebat Reservation System

A comprehensive hotel room reservation web application built with Laravel 9, featuring real-time room availability tracking, automated email notifications, and a complete booking management system for both customers and hotel staff.

## 📋 Overview

Hotel Hebat is a modern web-based hotel reservation system designed to streamline the booking process for both guests and hotel staff. In today's digital era, hotel reservations become much easier through dedicated web applications that handle bookings for specific dates with real-time room availability.

This application provides Hotel Hebat with an efficient and user-friendly platform for managing room reservations, ensuring smoother operations and better customer experience.

## 🎯 Problem Statement & Challenges

The Hotel Hebat reservation system was developed to simplify the room booking process for both consumers and hotel staff. This application aims to make future reservations more efficient and streamlined. However, several challenges were encountered during development:

### Challenges Faced

- **User Research & Requirements Gathering**: Conducting thorough research and interviews to understand application requirements
- **Complex Room Availability Logic**: Implementing room availability checking with multiple booking scenarios
- **Email Notification System**: Creating automated email notifications for all booking statuses (pending, check-in, check-out, and cancellation)

### Solutions Implemented

- **Targeted Stakeholder Interviews**: Identified and interviewed key stakeholders to ensure the application stays focused and receives correct input
- **Custom Development & Research**: Conducted extensive research and developed custom solutions for room availability features
- **Email Integration**: Implemented email functionality using Laravel 9's built-in features, supplemented with YouTube tutorials and framework documentation

## ✨ Key Features

### For Administrators
- Complete CRUD operations for room types
- Manage room facilities and amenities
- Manage hotel facilities
- User and staff management
- System configuration and settings

### For Receptionists
- **Booking Management Dashboard**


  - Filter reservations by check-in date and guest name
  - Perform check-in for confirmed bookings
  - Cancel bookings when necessary
- **Reservation Details View**
  - View and print reservation receipts
  - Access complete booking information
- **Automated Check-out System**
  - Automatic status update to "checked-out" when the checkout date matches current date
  - Triggered on page refresh for seamless transitions

### For Guests/Customers
- **Browse Hotel Information**
  - View homepage with hotel details
  - Explore available room types and their facilities
  - Check hotel amenities and facilities
- **Room Booking**
  - Easy-to-use booking interface
  - Real-time room availability checking
  - Instant booking confirmation
- **Email Notifications**
  - Receive booking confirmation emails
  - Get status update notifications
  - Booking receipt via email

## 🛠️ Technologies Used

- **Framework**: Laravel 9
- **Language**: PHP 8.0
- **Database**: MySQL
- **Frontend**: Bootstrap, Blade Templates
- **Email Service**: Laravel Mail
- **Server**: Apache (via XAMPP)
- **Tools**: Composer, Webpack Mix

## 📁 Project Structure

```
Hotel-Hebat/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Mail/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   └── assets/
├── routes/
├── public/
└── config/
```

## 🚀 Getting Started

### Prerequisites

1. Composer (latest version)
2. Laravel 9 (with PHPMyAdmin port changed to 8080)
3. XAMPP or similar local server
4. PHP 8.0 or higher

### Installation Steps

1. **Clone and Setup**
   ```bash
   git clone <repository-url>
   cd Hotel-Hebat
   ```

2. **Configure Environment**
   - Rename `.env.example` to `.env`
   - Create database named `hotel_hebat` in PHPMyAdmin
   - Update `.env` file:
   ```env
   DB_DATABASE=hotel_hebat
   MAIL_USERNAME=your_email@example.com
   MAIL_PASSWORD=your_email_password
   ```

3. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

4. **Setup Database**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

6. **Run the Application**
   ```bash
   php artisan serve
   ```

7. **Access the Application**
   - Open browser and visit: `http://127.0.0.1:8000`
   - Admin login: `http://127.0.0.1:8000/login`

## 💻 Usage Guide

### Administrator Features

<img src="https://user-images.githubusercontent.com/68214221/167260281-0c1a8aa3-bc65-467d-84ba-c5f245a10cf3.png" width="500">

Administrators can manage:

1. **Login Access**
   - Navigate to `http://127.0.0.1:8000/login`
   
   <img src="https://user-images.githubusercontent.com/68214221/167260912-979f2157-5490-4b3d-8aa5-356d6ed248e7.png" width="500">

2. **Room Type Management (CRUD)**
   
   <img src="https://user-images.githubusercontent.com/68214221/167260309-bb4e3499-4c4f-47a1-bb88-cc046f10d9bf.png" width="500">

3. **Room Facilities Management (CRUD)**
   
   <img src="https://user-images.githubusercontent.com/68214221/167260308-bd2549d3-1f26-41fa-a647-73a3fc11a556.png" width="500">

4. **Hotel Facilities Management (CRUD)**
   
   <img src="https://user-images.githubusercontent.com/68214221/167260306-3b5022c6-e0d5-4f79-8621-c0486b64cd66.png" width="500">

### Receptionist Features

<img src="https://user-images.githubusercontent.com/68214221/167260695-663dfa0d-2225-4c73-98a5-bc4964ecfcf1.png" width="500">

Receptionists can:

1. **Access System**
   - Login via `http://127.0.0.1:8000/login`

2. **Manage Reservations**
   - Filter by check-in date and guest name
   - Perform check-in for existing reservations
   - Cancel bookings as needed
   
   <img src="https://user-images.githubusercontent.com/68214221/167260698-b6b7f038-065e-434c-b5e1-afb97c753f54.png" width="500">

3. **View Reservation Details**
   - Click "View" button to see reservation receipt
   
   <img src="https://user-images.githubusercontent.com/68214221/167260781-a607e447-e1f6-4867-b32b-18c267294aef.png" width="500">

**Note**: Check-out management is automated. When the current date matches the checkout date, the reservation status automatically changes to "checked-out" upon page refresh.

### Guest/Customer Features

For booking demonstrations, please check the portfolio!

Guests can:

1. **View Homepage**
   
   <img src="https://user-images.githubusercontent.com/68214221/167260914-0a994046-3d0d-4fc0-82c0-ada0a30de3fe.png" width="500">

2. **Browse Room Types and Facilities**
   
   <img src="https://user-images.githubusercontent.com/68214221/167260917-1ce53f31-c128-4f30-8a0c-927b2aa1c527.png" width="500">

3. **View Hotel Facilities**
   
   <img src="https://user-images.githubusercontent.com/68214221/167260910-2f48aefb-2aaf-4dce-a245-15a9675c2352.png" width="500">

4. **Make Room Reservations**
   
   <img src="https://user-images.githubusercontent.com/68214221/167260915-f185eea6-0859-4ff6-afc3-ea5421adfe92.png" width="500">

## 📧 Email Notifications

The system automatically sends email notifications for:
- New booking confirmations
- Check-in notifications
- Check-out confirmations
- Booking cancellations

## 🤝 Contributing

This was developed as a final project for the Industry Certification Exam 2022. If you have suggestions or corrections, please feel free to reach out via the email provided in my portfolio.

## 📞 Contact

For questions, suggestions, or corrections, please contact me through the email address available in my portfolio.

---

**Thank you!** 🔥  
Thank you for visiting this project. Hope you learned something valuable! ❤️

Arigatou. :)
