# GSM Services - Complete WordPress Theme

A professional, all-in-one WordPress theme for GSM service providers with enterprise-grade security features, payment integration, and advanced customer management.

## Features

### Core Functionality
- **GSM Services Management** - IMEI unlock, phone unlock, network unlock services
- **Custom Service Types** - Create unlimited service offerings with custom pricing
- **Order Management** - Complete order processing system with status tracking
- **Support Tickets** - Integrated ticketing system for customer support
- **User Dashboard** - Customer account portal with order history and balance

### Security Features
- **Two-Factor Authentication (2FA/TOTP)** - RFC 6238 compliant TOTP implementation
- **Role-Based Access Control (RBAC)** - Custom roles: Administrator, Manager, Support, Customer
- **CSRF Protection** - WordPress nonces on all forms and AJAX requests
- **XSS Prevention** - Comprehensive output escaping and input sanitization
- **SQL Injection Protection** - Prepared statements for all database queries
- **Rate Limiting** - Configurable login attempt limits and API throttling
- **Audit Logging** - Complete activity tracking for security compliance
- **Security Headers** - HSTS, X-Frame-Options, CSP, X-Content-Type-Options

### Payment Integration
- **Stripe Gateway** - Full Stripe payment processing
- **PayPal Support** - PayPal payment integration (ready for configuration)
- **Wallet System** - User balance and credit system
- **Transaction History** - Complete financial audit trail
- **Automated Invoicing** - PDF invoice generation

### Notifications
- **Telegram Integration** - Bot notifications for orders and updates
- **WhatsApp Support** - Ready for WhatsApp Business API integration
- **Email Notifications** - WordPress email system integration
- **Notification Queue** - Background processing for reliable delivery

### Modern UI/UX
- **Responsive Design** - Mobile-first approach, works on all devices
- **Clean Interface** - Modern, professional design with CSS custom properties
- **Smart Forms** - Client-side validation, AJAX submissions
- **Interactive Elements** - Real-time feedback, loading states, animations
- **Accessibility** - WCAG compliant, keyboard navigation support

## Installation

### Requirements
- WordPress 5.8 or higher
- PHP 7.4 or higher
- MySQL 5.7 or higher
- SSL certificate (required for payments)

### Steps

1. **Upload Theme**
   ```bash
   # Via WordPress Admin
   Appearance > Themes > Add New > Upload Theme > Choose File

   # Or via FTP
   Upload to: /wp-content/themes/gsm-theme-complete/
   ```

2. **Activate Theme**
   ```
   Appearance > Themes > GSM Services > Activate
   ```

3. **Database Tables**
   - Tables are created automatically on theme activation
   - Check: Tools > Database to verify installation

4. **Configure Settings**
   ```
   GSM Settings > General Settings
   - Set company information
   - Configure contact details
   - Set timezone
   ```

5. **Setup Payment Gateway**
   ```
   GSM Settings > Payment Settings
   - Enter Stripe API keys
   - Configure PayPal credentials
   - Set currency
   ```

6. **Configure Notifications**
   ```
   GSM Settings > Notifications
   - Add Telegram Bot Token
   - Set chat IDs
   - Configure templates
   ```

## Configuration

### Payment Setup

**Stripe:**
```php
GSM Settings > Payment Settings
- Stripe Publishable Key: pk_test_... (from Stripe Dashboard)
- Stripe Secret Key: sk_test_... (from Stripe Dashboard)
- Test Mode: Enable for testing
```

**PayPal:**
```php
GSM Settings > Payment Settings
- PayPal Client ID: Your PayPal client ID
- PayPal Secret: Your PayPal secret
- PayPal Mode: sandbox or live
```

### Telegram Bot Setup

1. Create bot via @BotFather on Telegram
2. Get bot token
3. Add to GSM Settings > Notifications
4. Get your chat ID (use @userinfobot)
5. Test notification to verify

### Menu Setup

1. Go to Appearance > Menus
2. Create menu: "Primary Menu"
3. Add pages:
   - Home
   - Services
   - My Account
   - Support
   - Contact
4. Assign to "Primary Menu" location

## Usage

### Creating Services

```
GSM Services > Add New
- Title: iPhone 14 Pro Unlock
- Description: Full service description
- Price: 29.99
- Delivery Time: 24 hours
- Category: iPhone Unlocking
```

### Managing Orders

```
GSM Services > Orders
- View all orders
- Update order status
- Add notes
- Process refunds
```

### User Roles

**Administrator**
- Full access to all features
- Manage settings
- View audit logs

**Manager**
- Manage services and orders
- View reports
- Access customer data

**Support**
- View and respond to tickets
- Update order statuses
- Limited settings access

**Customer**
- Place orders
- View order history
- Submit support tickets
- Manage profile and 2FA

### Two-Factor Authentication

**For Users:**
```
My Account > Security Settings
1. Enable Two-Factor Authentication
2. Scan QR code with authenticator app (Google Authenticator, Authy)
3. Enter verification code
4. Save backup codes
```

**For Admins:**
```
Users > Edit User > Two-Factor Authentication
- View 2FA status
- Reset 2FA if user loses access
- Generate new backup codes
```

## Security Best Practices

1. **Enable 2FA** - Require for all admin users
2. **Use HTTPS** - Install SSL certificate
3. **Strong Passwords** - Enforce password policy
4. **Regular Backups** - Backup database and files
5. **Keep Updated** - Update WordPress and theme regularly
6. **Audit Logs** - Review logs weekly (GSM Settings > Audit Logs)
7. **Rate Limiting** - Configure login attempt limits
8. **API Keys** - Use production keys only on live site

## Customization

### Colors

Edit in `style.css`:
```css
:root {
    --primary-color: #3498db;    /* Main brand color */
    --secondary-color: #2ecc71;  /* Success/positive actions */
    --danger-color: #e74c3c;     /* Errors/negative actions */
    --warning-color: #f39c12;    /* Warnings/alerts */
}
```

### Logo

```
Appearance > Customize > Site Identity > Logo
Upload your logo (recommended: 200x60px PNG with transparency)
```

### Custom CSS

```
Appearance > Customize > Additional CSS
Add your custom styles here
```

### Functions

Add custom functions in `functions.php` after the main code:
```php
// Custom functions go at the end
function my_custom_function() {
    // Your code
}
```

## Troubleshooting

### Orders Not Creating

**Check:**
1. User is logged in
2. Service has price set
3. Check browser console for JavaScript errors
4. Verify AJAX endpoint: `admin-ajax.php`

### Payments Failing

**Check:**
1. Stripe keys are correct (test vs live)
2. SSL is enabled
3. Currency is supported
4. Check Stripe Dashboard > Logs

### 2FA Not Working

**Check:**
1. Server time is synchronized (NTP)
2. Authenticator app time is correct
3. Try backup codes
4. Admin can reset user's 2FA

### Telegram Notifications Not Sending

**Check:**
1. Bot token is correct
2. Chat ID is correct
3. Bot is not blocked
4. Test notification button works

### Database Tables Missing

**Fix:**
```
Deactivate and reactivate theme
Or run manually: GSM Settings > Tools > Reinstall Database
```

## Database Schema

**Tables Created:**
- `wp_gsm_services` - Service definitions
- `wp_gsm_orders` - Order records
- `wp_gsm_transactions` - Financial transactions
- `wp_gsm_tickets` - Support tickets
- `wp_gsm_audit_log` - Security audit trail

## API Endpoints

**AJAX Actions:**
```
wp_ajax_gsm_create_order - Create new order
wp_ajax_gsm_process_payment - Process payment
wp_ajax_gsm_verify_totp - Verify 2FA code
wp_ajax_gsm_test_notification - Test notification
```

## Performance

**Optimization Tips:**
1. Use caching plugin (WP Super Cache, W3 Total Cache)
2. Optimize images (WebP format)
3. Enable CDN for static assets
4. Use PHP 8.0+ for better performance
5. Database indexing (already included)

## Support

**Getting Help:**
1. Check this documentation
2. Review audit logs for errors
3. Enable WP_DEBUG for detailed errors
4. Contact theme developer

**Debug Mode:**
```php
// In wp-config.php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

## Changelog

### Version 1.0.0
- Initial release
- Complete GSM services platform
- TOTP/2FA implementation
- Payment integration (Stripe, PayPal)
- Telegram notifications
- Audit logging
- Modern responsive UI
- Complete security features

## Credits

**Technologies Used:**
- WordPress 6.x
- PHP 7.4+
- MySQL 5.7+
- Stripe API v3
- Telegram Bot API
- jQuery 3.x

**Security Standards:**
- OWASP Top 10 compliance
- RFC 6238 (TOTP)
- PCI DSS considerations

## License

This theme is licensed for use on a single WordPress installation.

## File Structure

```
gsm-theme-complete/
├── style.css                 # Main theme stylesheet
├── functions.php             # All theme functionality
├── index.php                 # Blog/post listing
├── header.php                # Site header
├── footer.php                # Site footer
├── single-gsm_service.php    # Single service page
├── archive-gsm_service.php   # Services listing
├── template-account.php      # User dashboard
├── template-checkout.php     # Checkout page
├── assets/
│   ├── css/
│   │   └── admin.css        # Admin panel styles
│   └── js/
│       ├── main.js          # Frontend JavaScript
│       └── admin.js         # Admin JavaScript
├── screenshot.png           # Theme screenshot
└── README.md               # This file
```

## Important Notes

1. **Security**: This theme includes production-ready security features. Keep API keys secure.
2. **Testing**: Use test mode for Stripe/PayPal before going live.
3. **Backups**: Always backup before updates or configuration changes.
4. **SSL Required**: HTTPS is mandatory for payment processing.
5. **Time Sync**: Server time must be accurate for 2FA to work correctly.

## Quick Start Checklist

- [ ] Install and activate theme
- [ ] Configure company information
- [ ] Setup payment gateway (test mode)
- [ ] Configure Telegram bot
- [ ] Create menu
- [ ] Add logo
- [ ] Create first service
- [ ] Test order creation
- [ ] Test payment processing
- [ ] Enable 2FA for admin users
- [ ] Review security settings
- [ ] Test on mobile devices
- [ ] Switch to live payment mode
- [ ] Launch!

---

**Version:** 1.0.0
**Last Updated:** 2025-11-22
**WordPress Tested:** 6.4
**PHP Tested:** 7.4, 8.0, 8.1
