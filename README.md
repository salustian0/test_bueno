<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Instruções para Configuração e Execução do Projeto

Este projeto requer PHP 8.2 ou versão superior. Siga as instruções abaixo para configurar e executar o projeto.

## Passos Iniciais

1. Execute o comando para instalar as dependências:

    ```bash
    composer install
    ```

2. Crie um banco de dados MySQL com o nome `db_test_bueno` ou ajuste conforme necessário no arquivo `.env`.

3. No arquivo `.env`, ajuste as credenciais do banco de dados de acordo com a sua configuração local.

4. Execute as migrações do banco de dados:

    ```bash
    php artisan migrate
    ```

5. Popule o banco de dados com dados de teste utilizando o comando:

    ```bash
    php artisan db:seed
    ```

6. Inicie o servidor embutido do Laravel:

    ```bash
    php artisan serve
    ```

7. Abra um novo terminal e execute o comando para instalar as dependências do Node.js:

    ```bash
    npm install
    ```

8. Em seguida, execute o comando para compilar os assets:

    ```bash
    npm run dev
    ```

A aplicação estará disponível em [http://localhost:8000](http://localhost:8000).

## Observações

- Para visualizar as notificações por e-mail, crie um usuário com um e-mail válido e faça alguma edição nos dados deste usuário para receber o e-mail com as informações.

- Para experimentar as notificações em tempo real, faça login com um usuário em um navegador e, em seguida, faça login com outro usuário em um navegador diferente. Atualize os dados de um usuário no primeiro navegador para ver as notificações refletidas no segundo navegador.

Lembre-se de ajustar as configurações conforme necessário para o seu ambiente específico.

