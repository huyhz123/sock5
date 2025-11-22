# GSM Pro Ultimate - WordPress Theme

**Version:** 2.0.0
**Author:** GSM Services Team
**Contact:** +84386355255 | Telegram: @hzgsm

---

## 🌟 TÍNH NĂNG NỔI BẬT

### ✅ Đa Ngôn Ngữ (Multi-Language)
- **3 ngôn ngữ:** English, Tiếng Việt, 中文 (Chinese)
- Chuyển đổi ngôn ngữ ngay lập tức
- Lưu lựa chọn bằng cookie
- Translation system tích hợp sẵn

### ✅ Đa Tiền Tệ (Multi-Currency)
- **3 loại tiền:** USD ($), VND (₫), CNY (¥)
- Tự động chuyển đổi giá
- Hiển thị chính xác theo định dạng
- Tỷ giá có thể cập nhật

### ✅ 4 Loại Sản Phẩm
1. **Services** (Dịch vụ) - Unlock, IMEI, iCloud
2. **Accounts** (Tài khoản) - Gaming, Social, Premium
3. **Phones** (Điện thoại) - iPhone, Samsung, Xiaomi
4. **Parts** (Linh kiện) - Màn hình, Pin, Ốp lưng

### ✅ Giao Diện Flat Design
- Thiết kế phẳng hiện đại
- Màu đen - xám sáng chuyên nghiệp
- 100% responsive (Mobile + PC)
- Không shadow, clean và sharp

### ✅ Customizer Hoàn Chỉnh
- **General Settings** - Thông tin chung
- **Contact Information** - Hotline, WhatsApp, Zalo, Telegram
- **Banner Settings** - Tiêu đề, mô tả banner
- **SEO Settings** - Meta description, keywords
- **Language Settings** - Ngôn ngữ mặc định
- **Currency Settings** - Tiền tệ mặc định

### ✅ SEO Optimization
- Meta tags (description, keywords)
- Open Graph tags cho Facebook/Social
- Semantic HTML5 structure
- SEO-friendly URLs
- Image optimization ready

### ✅ Performance Optimized
- CSS Variables cho render nhanh
- Flat design = ít CSS code
- Grid layout GPU-accelerated
- Image lazy loading ready
- Minification ready

---

## 📦 CẤU TRÚC THEME

```
gsm-pro-ultimate/
├── style.css                    # CSS chính (1500+ lines)
├── functions.php                # Backend logic (600+ lines)
├── header.php                   # Header với language/currency switchers
├── footer.php                   # Footer đa ngôn ngữ
├── front-page.php               # Trang chủ với banner chuyên nghiệp
├── index.php                    # Blog listing
├── single.php                   # Single blog post
├── archive.php                  # Product archive với filters
├── single-product.php           # Product detail template
├── single-gsm_service.php       # Service (redirect)
├── single-gsm_account.php       # Account (redirect)
├── single-gsm_phone.php         # Phone (redirect)
├── single-gsm_part.php          # Part (redirect)
├── template-parts/
│   └── product-card.php         # Product card component
├── assets/
│   └── js/
│       └── main.js              # JavaScript (300+ lines)
└── README.md                    # File này
```

---

## 🚀 CÀI ĐẶT THEME

### Yêu Cầu Hệ Thống

- **WordPress:** 5.8+
- **PHP:** 7.4+ (khuyến nghị 8.0+)
- **MySQL:** 5.7+
- **SSL:** Khuyến nghị (cho bảo mật)

### Các Bước Cài Đặt

#### Bước 1: Upload Theme

```
WordPress Admin → Giao diện → Themes → Add New
→ Upload Theme → Chọn gsm-pro-ultimate.zip
→ Install Now → Activate
```

#### Bước 2: Kiểm Tra Sample Content

Sau khi activate, theme tự động tạo:
- ✅ **8 sản phẩm mẫu** (2 mỗi loại)
- ✅ **3 bài viết blog**
- ✅ **Categories** cho tất cả product types
- ✅ **Sample data** (giá, SKU, warranty, stock)

Kiểm tra bằng cách vào:
- **Services** menu
- **Accounts** menu
- **Phones** menu
- **Parts** menu
- **Posts** menu

#### Bước 3: Cấu Hình Customizer

```
Giao diện → Customize
→ Contact Information: Nhập số điện thoại, Telegram
→ Banner Settings: Nhập tiêu đề banner
→ SEO Settings: Nhập meta description, keywords
→ Language Settings: Chọn ngôn ngữ mặc định
→ Currency Settings: Chọn tiền tệ mặc định
→ Publish
```

#### Bước 4: Tạo Menu

```
Giao diện → Menus → Create Menu: "Primary Menu"
→ Thêm trang:
   - Trang chủ (Home)
   - Dịch vụ (Services)
   - Tài khoản (Accounts)
   - Điện thoại (Phones)
   - Linh kiện (Parts)
   - Blog
   - Liên hệ (Contact)
→ Assign to "Primary Menu"
→ Save Menu
```

#### Bước 5: Thiết Lập Trang Chủ

```
Settings → Reading
→ A static page (chọn)
→ Homepage: Front page (hoặc để mặc định)
→ Posts page: Chọn "Blog" (nếu đã tạo)
→ Save Changes
```

---

## ⚙️ CẤU HÌNH CHI TIẾT

### 1. Thay Đổi Thông Tin Liên Hệ

**Via Customizer (Khuyến nghị):**
```
Customize → Contact Information
- Hotline: +84386355255 (mặc định)
- WhatsApp: +84386355255
- Zalo: +84386355255
- Telegram: @hzgsm
→ Publish
```

**Hoặc edit `functions.php`:**
```php
define('GSM_HOTLINE', '+84386355255');
define('GSM_TELEGRAM', '@hzgsm');
```

### 2. Thêm Logo

```
Customize → Site Identity → Select Logo
→ Upload logo (khuyến nghị: 200x60px, PNG với nền trong suốt)
→ Publish
```

### 3. Cấu Hình Banner

```
Customize → Banner Settings
- Banner Title: "Professional GSM Services"
- Banner Subtitle: "Unlock, IMEI, Accounts, Phones & Parts"
→ Publish
```

### 4. Cấu Hình SEO

```
Customize → SEO Settings
- Meta Description: Mô tả trang web (160 ký tự)
- Meta Keywords: Từ khóa cách nhau bởi dấu phẩy
→ Publish
```

### 5. Chọn Ngôn Ngữ & Tiền Tệ Mặc Định

```
Customize → Language Settings
- Default Language: Chọn EN, VI, hoặc ZH
→ Publish

Customize → Currency Settings
- Default Currency: Chọn USD, VND, hoặc CNY
→ Publish
```

---

## 🛒 QUẢN LÝ SẢN PHẨM

### Thêm Sản Phẩm Mới

#### Service (Dịch vụ)

```
GSM Services (menu) → Add New
- Title: Tên dịch vụ (e.g., "iPhone 15 Unlock")
- Content: Mô tả chi tiết
- Product Details:
  - Price (USD): 99
  - Old Price (USD): 149 (nếu có giảm giá)
  - Stock Status: In Stock / Out of Stock
  - SKU: GSM-001 (mã sản phẩm)
  - Warranty: 12 months
- Category: Chọn hoặc tạo category
- Featured Image: Upload ảnh
→ Publish
```

#### Account (Tài khoản)

```
Accounts → Add New
- Title: "Netflix Premium 4K"
- Content: Mô tả account
- Price: 5 USD
- Warranty: 1 month
→ Publish
```

#### Phone (Điện thoại)

```
Phones → Add New
- Title: "iPhone 14 Pro 256GB"
- Price: 799 USD
- Old Price: 999 USD (để show giảm giá)
→ Publish
```

#### Part (Linh kiện)

```
Parts → Add New
- Title: "iPhone 13 OLED Screen"
- Price: 89 USD
- Warranty: 6 months
→ Publish
```

### Quản Lý Categories

Mỗi product type có taxonomy riêng:
- **gsm_service_category** - Service Categories
- **gsm_account_category** - Account Categories
- **gsm_phone_category** - Phone Categories
- **gsm_part_category** - Part Categories

Tạo category:
```
Services → Categories → Add New Category
- Name: "iPhone Unlock"
- Slug: iphone-unlock
- Description: (optional)
→ Add New Category
```

---

## 🌍 HỆ THỐNG ĐA NGÔN NGỮ

### Cách Hoạt Động

1. **User chọn ngôn ngữ** qua Language Switcher (EN/VI/ZH)
2. **Cookie lưu lựa chọn** (`gsm_language`)
3. **Page reload** với ngôn ngữ mới
4. **Tất cả text** tự động translate

### Ngôn Ngữ Được Hỗ Trợ

- **English (EN)** - Default cho thị trường quốc tế
- **Tiếng Việt (VI)** - Thị trường Việt Nam
- **中文 (ZH)** - Thị trường Trung Quốc

### Thêm Translation Mới

Edit `functions.php`, class `GSM_Multi_Language`, method `get_translations()`:

```php
'en' => array(
    'your_key' => 'English Text',
),
'vi' => array(
    'your_key' => 'Văn bản tiếng Việt',
),
'zh' => array(
    'your_key' => '中文文本',
),
```

Sử dụng trong template:
```php
echo gsm_t('your_key');
```

### Các Key Translation Có Sẵn

```
home, services, accounts, phones, parts, blog, contact, about
buy_now, view_details, add_to_cart, call_now
all_products, latest_posts, read_more, search
price, in_stock, out_of_stock
```

---

## 💱 HỆ THỐNG ĐA TIỀN TỆ

### Cách Hoạt Động

1. **Giá gốc lưu bằng USD** trong database
2. **Auto convert** khi hiển thị
3. **User chọn tiền tệ** qua Currency Switcher
4. **Cookie lưu lựa chọn** (`gsm_currency`)

### Tỷ Giá Mặc Định

```php
USD: 1 (base)
VND: 24,000 VND = 1 USD
CNY: 7.2 CNY = 1 USD
```

### Cập Nhật Tỷ Giá

Edit `functions.php`, class `GSM_Multi_Currency`:

```php
private static $currencies = array(
    'USD' => array('symbol' => '$', 'rate' => 1, 'decimals' => 2),
    'VND' => array('symbol' => '₫', 'rate' => 25000, 'decimals' => 0), // Cập nhật rate
    'CNY' => array('symbol' => '¥', 'rate' => 7.3, 'decimals' => 2),
);
```

### Ví Dụ Conversion

Input: `$99 USD`

Outputs:
- **USD:** `$99.00`
- **VND:** `2,376,000 ₫`
- **CNY:** `¥712.80`

---

## 🎨 TÙY CHỈNH GIAO DIỆN

### Thay Đổi Màu Sắc

Edit `style.css` section `:root`:

```css
:root {
    --color-primary: #ff9800;        /* Màu chính (cam) */
    --color-secondary: #2196f3;      /* Màu phụ (xanh) */
    --color-success: #4caf50;        /* Màu success (xanh lá) */

    /* Đổi sang màu khác */
    --color-primary: #e74c3c;        /* Đỏ */
    --color-secondary: #9b59b6;      /* Tím */
}
```

### Thay Đổi Font Chữ

```css
:root {
    --font-family: 'Your Font', Arial, sans-serif;
}
```

Sau đó thêm Google Font vào `header.php`:
```html
<link href="https://fonts.googleapis.com/css2?family=Your+Font&display=swap" rel="stylesheet">
```

### Thêm Custom CSS

```
Customize → Additional CSS
→ Nhập CSS tùy chỉnh
→ Publish
```

---

## 📱 RESPONSIVE

### Breakpoints

```css
Desktop: > 992px
Tablet: 768px - 992px
Mobile: 576px - 768px
Small Mobile: < 576px
```

### Mobile Optimizations

- ✅ Hamburger menu tự động
- ✅ Stack layout trên mobile
- ✅ Touch-friendly buttons (minimum 48px)
- ✅ Optimized images
- ✅ Reduced spacing

### Test Responsive

1. Chrome DevTools (F12)
2. Toggle device toolbar (Ctrl+Shift+M)
3. Test: iPhone, iPad, Desktop

---

## ⚡ PERFORMANCE

### Optimizations Included

1. **CSS Variables** - Fast rendering
2. **Flat Design** - Less CSS = faster
3. **Grid Layout** - GPU-accelerated
4. **No Shadows** - Faster paint
5. **Lazy Loading Ready** - Image attribute
6. **Transform Optimization** - translateZ(0)

### Recommended Plugins

1. **WP Super Cache** hoặc **W3 Total Cache** - Caching
2. **Autoptimize** - Minify CSS/JS
3. **EWWW Image Optimizer** - Optimize images
4. **WP Rocket** - Premium caching (khuyến nghị nhất)

### Speed Tips

```
1. Enable caching plugin
2. Use CDN (Cloudflare, etc.)
3. Optimize images (WebP format)
4. Minify CSS/JS
5. Use PHP 8.0+
6. Enable GZIP compression
7. Lazy load images
```

---

## 🔍 SEO

### Features Included

- ✅ Meta description tag
- ✅ Meta keywords tag
- ✅ Open Graph tags (Facebook/Social)
- ✅ Semantic HTML5 structure
- ✅ Clean URLs
- ✅ Image alt text ready
- ✅ Fast loading (good for SEO)

### Recommended SEO Plugins

**Option 1: Yoast SEO** (Free)
```
Plugins → Add New → Search "Yoast SEO"
→ Install → Activate
→ Configure SEO settings
```

**Option 2: Rank Math** (Free, Recommended)
```
Plugins → Add New → Search "Rank Math"
→ Install → Activate
→ Run setup wizard
```

### SEO Best Practices

1. **Title Tags:** 50-60 characters
2. **Meta Description:** 150-160 characters
3. **H1 Tag:** 1 per page (done automatically)
4. **Alt Text:** Thêm cho tất cả images
5. **Internal Links:** Link giữa các trang
6. **Mobile-Friendly:** Theme đã responsive
7. **Fast Loading:** < 3 seconds (optimize images)

---

## 🐛 TROUBLESHOOTING

### Language Switcher Không Hoạt Động

**Nguyên nhân:** JavaScript chưa load

**Giải pháp:**
```
1. Kiểm tra main.js đã được enqueue
2. Clear browser cache (Ctrl+Shift+Delete)
3. Disable cache plugins tạm thời
4. Check console errors (F12)
```

### Currency Không Chuyển Đổi

**Nguyên nhân:** Cookie bị block

**Giải pháp:**
```
1. Cho phép cookies trong browser
2. Test trên incognito mode
3. Disable cache plugins
4. Check browser cookie settings
```

### Sample Content Không Tạo

**Nguyên nhân:** Function chỉ chạy 1 lần

**Giải pháp:**
```
1. Deactivate theme
2. Activate lại
3. Hoặc xóa option trong database:
   DELETE FROM wp_options WHERE option_name = 'gsm_ultimate_sample_created';
4. Reload trang
```

### Menu Không Hiển Thị

**Giải pháp:**
```
1. Giao diện → Menus
2. Tạo menu mới
3. Assign to "Primary Menu" location
4. Save Menu
```

### CSS Không Load

**Nguyên nhân:** Permalink chưa flush

**Giải pháp:**
```
1. Settings → Permalinks
2. Click "Save Changes" (không cần thay đổi gì)
3. Refresh page
```

### Images Không Hiển Thị

**Giải pháp:**
```
1. Check file path đúng chưa
2. Regenerate thumbnails (plugin)
3. Check file permissions (755)
```

---

## 📞 4 NÚT LIÊN HỆ NỔI

### Features

- Fixed position (góc phải dưới màn hình)
- 4 nút: WhatsApp, Zalo, Telegram, Phone
- Màu sắc riêng cho từng nút
- Hover effects smooth
- Phone button có pulse animation
- Auto mobile responsive

### Customization

Via **Customize → Contact Information**

### Tắt Floating Buttons

Nếu không muốn dùng, edit `functions.php`:

```php
// Comment out dòng này:
// add_action('wp_footer', 'gsm_floating_contacts');
```

---

## 📊 SAMPLE CONTENT

### 8 Sản Phẩm Mẫu

**Services (2):**
1. iPhone 15 Pro Max Unlock - $99
2. Samsung S24 Ultra Unlock - $49

**Accounts (2):**
1. Premium Spotify - 12 Months - $15
2. Netflix Premium 4K - 1 Month - $5

**Phones (2):**
1. iPhone 14 Pro 256GB - Like New - $799
2. Samsung Galaxy S23 128GB - $599

**Parts (2):**
1. iPhone 13 OLED Screen Assembly - $89
2. Samsung S21 Battery - $25

### 3 Bài Blog Mẫu

1. How to Check iPhone IMEI - Complete Guide 2024
2. Best Gaming Accounts to Buy in 2024
3. iPhone vs Samsung: Which Phone to Buy?

### Xóa Sample Content

Nếu muốn xóa:
```
1. Services → All Services → Select All → Move to Trash
2. Accounts → All Accounts → Select All → Move to Trash
3. Phones → All Phones → Select All → Move to Trash
4. Parts → All Parts → Select All → Move to Trash
5. Posts → All Posts → Select All → Move to Trash
```

---

## 🔒 SECURITY

### Security Features

- ✅ Nonce verification trên forms
- ✅ Sanitization cho tất cả inputs
- ✅ Escaping cho outputs
- ✅ Prepared statements (SQL injection prevention)
- ✅ CSRF protection
- ✅ XSS prevention

### Security Best Practices

```
1. Dùng strong passwords
2. Update WordPress core thường xuyên
3. Update theme khi có version mới
4. Cài security plugin (Wordfence, iThemes Security)
5. Enable 2FA cho admin
6. Regular backups
7. Use SSL certificate (HTTPS)
```

---

## 📝 CHANGELOG

### Version 2.0.0 (Current)

**New Features:**
- ✅ Multi-language system (EN, VI, ZH)
- ✅ Multi-currency system (USD, VND, CNY)
- ✅ 4 product types (Services, Accounts, Phones, Parts)
- ✅ Flat design UI
- ✅ Complete Customizer integration
- ✅ SEO optimization
- ✅ Performance optimization
- ✅ Sample content auto-creation

**Technical:**
- 1500+ lines CSS
- 600+ lines PHP
- 300+ lines JavaScript
- 13 PHP template files
- Zero syntax errors
- 100% responsive

---

## 💡 TIPS & TRICKS

### 1. Tối Ưu Images

```
- Dùng WebP format
- Compress trước khi upload
- Recommended sizes:
  - Products: 800x800px
  - Blog: 1200x675px
  - Logo: 200x60px
```

### 2. Backup Thường Xuyên

```
- Cài plugin UpdraftPlus
- Schedule: Daily hoặc Weekly
- Backup to: Google Drive, Dropbox
- Include: Database + Files
```

### 3. Monitor Performance

```
- Use GTmetrix.com
- Target: < 3 seconds load time
- Optimize: Images, CSS, JS
- Enable: Caching, CDN
```

### 4. Test Trên Nhiều Devices

```
- Desktop (Chrome, Firefox, Safari, Edge)
- Tablet (iPad, Android)
- Mobile (iPhone, Android)
- Check: Layout, Speed, Functionality
```

---

## 🆘 HỖ TRỢ

### Liên Hệ

- **Hotline:** +84386355255
- **WhatsApp:** +84386355255
- **Zalo:** +84386355255
- **Telegram:** @hzgsm

**Thời gian hỗ trợ:** 24/7

### Tài Liệu

- **README.md** - File này
- **GSM-PRO-ULTIMATE-SUMMARY.md** - Technical summary
- **Inline comments** - Trong code

---

## ⭐ CREDITS

**Developed by:** GSM Services Team
**Contact:** +84386355255 | @hzgsm
**Date:** November 2025
**Version:** 2.0.0

**Technologies Used:**
- WordPress 5.8+
- PHP 7.4+
- MySQL 5.7+
- jQuery 3.x
- Font Awesome 6.4.0

---

## 📄 LICENSE

GNU General Public License v2 or later
http://www.gnu.org/licenses/gpl-2.0.html

---

**🎉 Cảm ơn bạn đã sử dụng GSM Pro Ultimate Theme!**

Chúc bạn kinh doanh thành công! 🚀
