# Boarding Gi**Technologies Used**

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP (Procedural style)
- **Database**: MySQL with mysqli_connect
- **File Upload**: For gig photos
- **Currency**: Rupees (Rs.)tform - University Project

A simple PHP-based website for posting and browsing boarding gigs with a mock payment gateway.

## Features

- User Registration & Login (Two user types: Gig Posters & Students)
- Post boarding gigs with photos, location, description, and conditions
- Browse available gigs
- View detailed gig information
- Mock payment gateway for gig applications
- Payment success confirmation

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP (Procedural style)
- **Database**: MySQL with mysql_connect
- **File Upload**: For gig photos

## Database Setup

1. **Create the database:**
   - Open phpMyAdmin or MySQL command line
   - Run the SQL commands from `database.sql` file

2. **Configure database connection:**
   - Open `db_config.php`
   - Update the following variables if needed:
     ```php
     $db_host = "localhost";
     $db_user = "root";
     $db_pass = "";
     $db_name = "boarding_gigs";
     ```

## Installation Steps

1. **Install XAMPP/WAMP/MAMP:**
   - Download and install a local server (XAMPP recommended)
   - Start Apache and MySQL services

2. **Copy project files:**
   - Copy all project files to your web server directory
   - For XAMPP: `C:\xampp\htdocs\lathurshan\`
   - For WAMP: `C:\wamp\www\lathurshan\`

3. **Set up the database:**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create a new database named `boarding_gigs`
   - Import or run the SQL from `database.sql`

4. **Set folder permissions:**
   - Make sure the `uploads` folder has write permissions
   - On Windows: Right-click > Properties > Security > Edit
   - On Linux/Mac: `chmod 777 uploads/`

5. **Access the website:**
   - Open browser and go to: `http://localhost/lathurshan/register.php`
   - Create an account and start using the platform

## User Flow

### For Gig Posters:
1. Register as "Gig Poster"
2. Login with credentials
3. Click "Post a Gig" button
4. Fill in gig details (title, description, location, conditions, price, photo)
5. Submit the gig
6. Get redirected to payment gateway
7. Enter payment details to pay the posting fee
8. Gig becomes active after successful payment

### For Students:
1. Register as "Student"
2. Login with credentials
3. Browse available gigs on home page
4. Click "View Details" to see full gig information
5. Contact gig poster directly (details visible on gig page)

## Project Structure

```
lathurshan/
├── database.sql           # Database schema
├── db_config.php          # Database connection
├── register.php           # User registration
├── login.php              # User login
├── logout.php             # User logout
├── index.php              # Home page (browse gigs)
├── post_gig.php           # Post new gig
├── view_gig.php           # View gig details
├── payment.php            # Payment gateway
├── payment_success.php    # Payment confirmation
├── style.css              # Stylesheet
├── script.js              # JavaScript validations
├── uploads/               # Gig photos storage
└── README.md              # This file
```

## Database Tables

### users
- id (Primary Key)
- username
- email
- password (MD5 hashed)
- user_type (poster/student)
- created_at

### gigs
- id (Primary Key)
- user_id (Foreign Key)
- title
- description
- location
- conditions
- photo
- price
- status
- created_at

### payments
- id (Primary Key)
- gig_id (Foreign Key)
- user_id (Foreign Key)
- card_name
- card_number
- amount
- payment_date

## Important Notes

⚠️ **This is a university project for educational purposes only!**

- Uses MySQLi (procedural style) for database connection
- No SQL injection protection (no prepared statements as per requirements)
- Mock payment gateway (not real payment processing)
- MD5 password hashing (not secure for production)
- No input sanitization or validation on server side
- Should NOT be used in production environments
- Gig posters pay posting fees, students browse for free

## Testing

**Test User Accounts:**
Create your own accounts through the registration page.

**Sample Gig Data:**
- Title: "Cozy Room Near Campus"
- Location: "123 University Ave, City"
- Description: "Spacious room with wifi and utilities included"
- Conditions: "Non-smoking, quiet hours after 10pm"
- Price: 5000.00 (in Rupees)

**Mock Payment Details:**
You can use any fake card details:
- Card Name: John Doe
- Card Number: 1234567890123456
- Expiry: 12/25
- CVV: 123

**Note:** Gig posters pay a posting fee when they create a gig. Students can browse and view gigs for free.

## Troubleshooting

**Problem: MySQLi connection errors**
- Make sure MySQL service is running
- Verify database credentials in db_config.php
- Check the port number (default is 3306, yours is 3308)
- Ensure database `boarding_gigs` exists

**Problem: Photos not uploading**
- Check if the `uploads` folder exists and has write permissions
- Verify file size limit in php.ini

**Problem: Cannot connect to database**
- Make sure MySQL service is running
- Verify database credentials in db_config.php
- Ensure database `boarding_gigs` exists

**Problem: Session errors**
- Clear browser cookies and cache
- Restart Apache server

## Contact

For any questions about this project, please contact your instructor or teaching assistant.

---
**Project Created For:** University Web Development Course
**Date:** 2025
**Language:** PHP (Procedural)
**Database:** MySQL
