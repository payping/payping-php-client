<?php


namespace PayPing;

/**
 * سطح دسترسی های قابل درخواست از سرویس oauth2
 * Class Scopes
 * @package PayPing
 */
class Scopes
{
        const  OPENID = 'openid' ; // اجباری برای تمام درخواست‌ها
        const  PROFILE = 'profile' ; // دسترسی مرتبط با تمام اطلاعات یک کاربر
        const  EMAIL = 'email' ; // دسترسی به مشاهده ایمیل
        const  NATIONAL_CODE = 'nationalcode' ; // دسترسی به مشاهده کدملی کاربر
        const  BIRTHDAY = 'birthday' ; // دسترسی به مشاهده تاریخ تولد کاربر
        const  SHABA = 'shaba' ; // دسترسی به مشاهده شبای بانکی کاربر
        const  PHONE = 'phone' ; // دسترسی به مشاهده شماره تماس کاربر
        const  PAY_READ = 'pay:read' ; // دسترسی فقط خواندنی در سرویس پرداخت
        const  PAY_WRITE = 'pay:write' ; // دسترسی نوشتن و تغییرات در سرویس پرداخت
        const  PRODUCT_READ = 'product:read' ; // دسترسی فقط خواندنی در سرویس آیتم‌های مالی
        const  PRODUCT_WRITE = 'product:write' ; // دسترسی نوشتن و تغییرات در سرویس آیتم‌های مالی
        const  INVOICE_READ = 'invoice:read' ; // دسترسی فقط خواندنی به سرویس فاکتور ها
        const  INVOICE_WRITE = 'invoice:write' ; // دسترسی نوشتن و تغییرات در سرویس فاکتور ها
        const  UPLOAD_WRITE = 'upload:write' ;
}