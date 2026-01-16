# Prueba Técnica - Gestión de Libros

Este proyecto corresponde a una prueba técnica que consiste en una API REST desarrollada con Symfony y PostgreSQL, consumida por un frontend web en Vue y una aplicación móvil en React Native.

## Tecnologías utilizadas

### Backend
- PHP 8+
- Symfony
- Doctrine ORM
- PostgreSQL

### Frontend Web
- Vue 3
- TypeScript
- Fetch API

### Mobile
- React Native
- Expo
- TypeScript
## Estructura del proyecto

- backend/: API REST en Symfony
- frontend/: Aplicación web en Vue
- mobile/: Aplicación móvil en React Native

## Backend

El backend expone un endpoint principal:

- GET /api/books

Este endpoint devuelve la lista de libros junto con su rating promedio en formato JSON.

## Instalación Backend
cd tidelit-books-api
composer install
symfony server:start
## Instalación Fronted Web
cd frontend
npm install
npm run dev
## Instalacion Mobile

cd mobile
npm install
npm start



Notas

Para la demo móvil se utilizó Expo Web debido a restricciones de red local en iOS, pero el mismo código es compatible con dispositivos móviles.

Video 
Se adjunta un video donde se explica el funcionamiento del backend, frontend y mobile.
https://drive.google.com/file/d/1hZCn0PqKtU6xhr_mRoKhVVBOAJSC-NKR/view?usp=sharing