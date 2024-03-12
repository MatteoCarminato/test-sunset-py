#!/bin/bash

echo "Começando a instalação"

# Criar pasta temp
sudo chmod -R 777 ./storage

# Copiar o .env
cp ./.env.example .env

# Inicia o ambiente usando o docker-compose
echo -e "**Subindo ambiente com docker-compose .\n"
docker-compose up --build -d

# Executar o composer install
echo -e "**Instalando dependências com composer.\n"
composer install

# Executar as migrations
echo -e "**Executando as migrations.\n"
php artisan migrate

echo -e "**Levantando servidor na porta 8000.\n"
php artisan serve
