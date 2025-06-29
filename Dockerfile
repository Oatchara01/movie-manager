FROM php:8.1-apache

# ติดตั้ง mysqli สำหรับเชื่อมต่อ MySQL ด้วย PHP
RUN docker-php-ext-install mysqli
