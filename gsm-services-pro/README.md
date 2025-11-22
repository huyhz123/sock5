# GSM Services Pro - WordPress Theme

**Version:** 1.0.0
**Author:** GSM Services Team
**Contact:** +84386355255 | Telegram: @hzgsm

---

## 📱 Giới Thiệu

GSM Services Pro là theme WordPress chuyên nghiệp dành cho dịch vụ unlock điện thoại, IMEI services, và các dịch vụ GSM. Theme được thiết kế với màu đen chủ đạo, hiện đại và chuyên nghiệp.

### ✨ Tính Năng Nổi Bật

- ✅ **Màu Đen Chủ Đạo** - Thiết kế hiện đại, sang trọng
- ✅ **Responsive 100%** - Tương thích mọi thiết bị
- ✅ **Nút Liên Hệ Nổi** - WhatsApp, Zalo, Telegram, Hotline
- ✅ **Mẫu Sản Phẩm Có Sẵn** - 6 dịch vụ mẫu
- ✅ **Mẫu Bài Viết** - 4 bài blog mẫu
- ✅ **SEO Friendly** - Tối ưu cho công cụ tìm kiếm
- ✅ **Tốc Độ Cao** - Code tối ưu, load nhanh
- ✅ **Dễ Sử Dụng** - Giao diện thân thiện

---

## 📞 Thông Tin Liên Hệ

Theme được cấu hình sẵn với thông tin:

- **Hotline:** +84386355255
- **WhatsApp:** +84386355255
- **Zalo:** +84386355255
- **Telegram:** @hzgsm

---

## 🚀 Cài Đặt Theme

### Yêu Cầu Hệ Thống

- **WordPress:** 5.8 trở lên
- **PHP:** 7.4 trở lên
- **MySQL:** 5.7 trở lên

### Các Bước Cài Đặt

#### Bước 1: Upload Theme

1. Đăng nhập WordPress Admin
2. Vào **Giao diện (Appearance) → Themes**
3. Click **Add New → Upload Theme**
4. Chọn file `gsm-services-pro.zip`
5. Click **Install Now**

#### Bước 2: Kích Hoạt Theme

1. Sau khi upload xong, click **Activate**
2. Theme sẽ tự động tạo:
   - ✅ 6 dịch vụ mẫu
   - ✅ 4 bài viết blog
   - ✅ 2 trang (Giới thiệu, Liên hệ)
   - ✅ 4 danh mục dịch vụ

#### Bước 3: Cấu Hình Menu

1. Vào **Giao diện → Menus**
2. Tạo menu mới: **Primary Menu**
3. Thêm các trang:
   - Trang chủ
   - Dịch vụ
   - Blog
   - Giới thiệu
   - Liên hệ
4. Chọn vị trí: **Primary Menu**
5. Click **Save Menu**

#### Bước 4: Cài Đặt Trang Chủ

1. Vào **Settings → Reading**
2. Chọn **A static page**
3. Homepage: Chọn trang "Trang chủ" (nếu có) hoặc để mặc định
4. Posts page: Chọn "Blog"
5. Click **Save Changes**

---

## ⚙️ Cấu Hình Theme

### Thay Đổi Thông Tin Liên Hệ

1. Vào **Giao diện → Customize → Contact Information**
2. Thay đổi:
   - **Hotline:** Số điện thoại của bạn
   - **Telegram Username:** Tên Telegram của bạn
3. Click **Publish**

### Thêm Logo

1. Vào **Giao diện → Customize → Site Identity**
2. Click **Select Logo**
3. Upload logo của bạn (khuyến nghị: 200x60px, PNG)
4. Click **Publish**

### Thay Đổi Màu Sắc

Nếu muốn thay đổi màu chủ đạo, chỉnh sửa file `style.css`:

```css
:root {
    --primary-color: #000000;        /* Màu đen chính */
    --secondary-color: #ff9800;      /* Màu cam nhấn */
    /* Thay đổi các màu này theo ý bạn */
}
```

---

## 📝 Quản Lý Nội Dung

### Thêm Dịch Vụ Mới

1. Vào **GSM Services → Add New**
2. Nhập:
   - **Tiêu đề:** Tên dịch vụ
   - **Nội dung:** Mô tả chi tiết
   - **Service Details:**
     - Price (VND): Giá dịch vụ
     - Delivery Time: Thời gian xử lý (vd: 1-3 ngày)
     - Success Rate: Tỷ lệ thành công (%)
3. Chọn **Danh mục dịch vụ**
4. Upload **Featured Image** (ảnh đại diện)
5. Click **Publish**

### Thêm Bài Viết Blog

1. Vào **Posts → Add New**
2. Nhập tiêu đề và nội dung
3. Chọn danh mục
4. Upload ảnh đại diện
5. Click **Publish**

### Quản Lý Danh Mục Dịch Vụ

1. Vào **GSM Services → Categories**
2. Có 4 danh mục mặc định:
   - iPhone Unlock
   - Samsung Unlock
   - IMEI Services
   - iCloud Services
3. Có thể thêm/sửa/xóa theo nhu cầu

---

## 🎨 Tùy Chỉnh Giao Diện

### Nút Liên Hệ Nổi (Floating Contacts)

Theme có sẵn 4 nút liên hệ nổi ở góc phải màn hình:

1. **WhatsApp** (màu xanh lá)
2. **Zalo** (màu xanh dương)
3. **Telegram** (màu xanh biển)
4. **Phone** (màu cam, có hiệu ứng nhấp nháy)

Nút này tự động lấy số điện thoại từ **Customize → Contact Information**.

### Chỉnh Sửa Footer

Mở file `footer.php` để chỉnh sửa:
- Thông tin công ty
- Menu footer
- Thông tin liên hệ

### Thêm Widget

Theme hỗ trợ widget ở footer. Vào **Giao diện → Widgets** để thêm.

---

## 📱 Tính Năng Chi Tiết

### 1. Trang Chủ (Front Page)

- **Hero Section:** Banner chính với CTA buttons
- **Dịch Vụ Nổi Bật:** Hiển thị 6 dịch vụ mới nhất
- **Lý Do Chọn Chúng Tôi:** 6 lợi ích
- **Blog & Tin Tức:** 3 bài viết mới nhất
- **Call-to-Action:** Kêu gọi liên hệ

### 2. Trang Dịch Vụ (Services)

- Hiển thị tất cả dịch vụ dạng grid
- Lọc theo danh mục
- Hiển thị: Giá, thời gian, tỷ lệ thành công
- Button đặt dịch vụ

### 3. Chi Tiết Dịch Vụ (Single Service)

- Ảnh/Icon dịch vụ
- Thông tin chi tiết
- Giá cả rõ ràng
- Thời gian xử lý
- Tỷ lệ thành công
- Đặc điểm nổi bật
- Nút liên hệ nhiều kênh
- Dịch vụ liên quan

### 4. Blog

- Danh sách bài viết
- Hình ảnh đại diện
- Ngày đăng, tác giả
- Phân trang

### 5. Chi Tiết Bài Viết

- Nội dung đầy đủ
- Ảnh featured
- Tags
- Bài viết trước/sau
- Bài viết liên quan
- Comments (nếu bật)

---

## 🔧 Tùy Chỉnh Nâng Cao

### Thêm Custom CSS

1. Vào **Giao diện → Customize → Additional CSS**
2. Thêm CSS tùy chỉnh của bạn

Ví dụ:
```css
/* Thay đổi màu nút */
.btn-primary {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
}

/* Thay đổi font chữ */
body {
    font-family: 'Your Font', sans-serif;
}
```

### Chỉnh Sửa JavaScript

File JavaScript chính: `assets/js/main.js`

Các tính năng có sẵn:
- Mobile menu toggle
- Smooth scroll
- Sticky header
- Hover effects
- Loading states
- Form validation
- Back to top button
- Click tracking

### Thêm Google Analytics

Thêm vào `header.php` trước thẻ `</head>`:

```php
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

---

## 📊 Dữ Liệu Mẫu

### Dịch Vụ Mẫu (6 dịch vụ)

1. **iPhone 15 Pro Max Network Unlock** - 2,500,000 VNĐ
2. **iPhone 14 Pro Carrier Unlock** - 1,800,000 VNĐ
3. **Samsung S24 Ultra Network Unlock** - 800,000 VNĐ
4. **IMEI Check & Blacklist Removal** - 500,000 VNĐ
5. **iCloud Unlock Premium** - 3,000,000 VNĐ
6. **iPhone 13 Network Unlock** - 1,500,000 VNĐ

### Bài Viết Mẫu (4 bài)

1. Hướng dẫn kiểm tra IMEI iPhone chính xác nhất 2024
2. So sánh các phương pháp unlock iPhone hiện nay
3. 5 điều cần biết trước khi mua iPhone Lock
4. Cách phân biệt iPhone chính hãng và hàng nhái

### Danh Mục Dịch Vụ (4 categories)

1. iPhone Unlock
2. Samsung Unlock
3. IMEI Services
4. iCloud Services

---

## 🎯 SEO & Marketing

### Tối Ưu SEO

Theme đã tích hợp:
- ✅ Semantic HTML5
- ✅ Schema markup ready
- ✅ Fast loading
- ✅ Mobile-first
- ✅ Clean code

**Khuyến nghị cài thêm:**
- Yoast SEO hoặc Rank Math
- WP Super Cache
- Smush (tối ưu hình ảnh)

### Kênh Liên Hệ

Theme tích hợp sẵn 4 kênh:
1. **Hotline** - Gọi điện trực tiếp
2. **WhatsApp** - Chat WhatsApp
3. **Zalo** - Chat Zalo
4. **Telegram** - Chat Telegram

Tất cả đều có tracking để bạn biết khách hàng click vào đâu (xem Console log).

---

## 🔒 Bảo Mật

Theme tuân thủ các chuẩn bảo mật WordPress:
- ✅ Escape output
- ✅ Sanitize input
- ✅ Nonce verification
- ✅ No direct file access
- ✅ Prepared statements

---

## 🐛 Troubleshooting

### Menu không hiển thị

**Giải pháp:**
1. Vào **Giao diện → Menus**
2. Tạo menu mới
3. Gán vào vị trí "Primary Menu"

### Dịch vụ mẫu không tạo

**Giải pháp:**
1. Deactivate theme
2. Activate lại
3. Hoặc xóa option: `delete_option('gsm_sample_content_created');` trong database

### Nút floating không hiện

**Kiểm tra:**
1. File `functions.php` có hook `wp_footer`
2. File `footer.php` có `<?php wp_footer(); ?>`
3. Clear cache

### Responsive không hoạt động

**Kiểm tra:**
1. Viewport meta tag trong `header.php`
2. Xóa cache browser
3. Test trên incognito mode

---

## 📱 Responsive Breakpoints

```css
@media (max-width: 992px) { /* Tablet */ }
@media (max-width: 768px) { /* Mobile */ }
@media (max-width: 576px) { /* Small Mobile */ }
```

---

## 🎨 Color Palette

```css
--primary-color: #000000        /* Black */
--secondary-color: #ff9800      /* Orange */
--success-color: #4caf50        /* Green */
--danger-color: #f44336         /* Red */
--warning-color: #ffc107        /* Yellow */
--info-color: #2196f3           /* Blue */
```

---

## 📞 Hỗ Trợ

Nếu cần hỗ trợ, liên hệ:

- **Hotline:** +84386355255
- **WhatsApp:** +84386355255
- **Zalo:** +84386355255
- **Telegram:** @hzgsm

Thời gian hỗ trợ: 24/7

---

## 📄 License

Theme này được phát triển cho mục đích sử dụng cá nhân/thương mại.

---

## 🔄 Changelog

### Version 1.0.0 (2024)
- 🎉 Phát hành phiên bản đầu tiên
- ✅ Theme WordPress hoàn chỉnh
- ✅ Màu đen chủ đạo
- ✅ 6 dịch vụ mẫu
- ✅ 4 bài viết mẫu
- ✅ 4 nút liên hệ floating
- ✅ Responsive 100%
- ✅ SEO friendly

---

## 📝 Credits

**Developed by:** GSM Services Team
**Contact:** +84386355255
**Telegram:** @hzgsm
**Date:** 2024

---

**🎉 Cảm ơn bạn đã sử dụng GSM Services Pro Theme!**
