# 📝 DESAFIO LEADTAX

### Arquitetura 

- PHP 8.0
- Laravel 9.19
- Docker

URL utilizada para extrair informacoes de produtos https://lista.mercadolivre.com.br/notebooks#D[A:notebooks]
### Instalação (Com Docker)

**Passo 1: Clonar o Repositório**

```sh
git clone https://github.com/eduardohor/web-scraping-laravel.git
```

**Passo 2: Entrar na Pasta do Projeto**

```sh
cd web-scraping-laravel
```

**Passo 3: Com o docker em execução criar Imagens e Subir a Aplicação**

```sh
docker-compose up -d
```

**Passo 4: Entrar no Container da Aplicação para Instalar Dependências**
```sh
docker-compose exec app bash
```

**Passo 5: Instalar Dependências no Container**
```sh
composer install
```
**Passo 6: Configurar o Arquivo .env**

Duplique o arquivo .env.example e renomeie a cópia para .env:
```sh
cp .env.example .env
```
**Passo 7: Gerar Nova Chave do Laravel**
```
php artisan key:generate
```
**Passo 8: Configurar o Banco de Dados no Arquivo .env**

Edite o arquivo .env com as informações do seu banco de dados local. Exemplo de configuração:
- DB_CONNECTION=mysql
- DB_HOST=mysql_db
- DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=username
- DB_PASSWORD=userpass
     
**Passo 9: Executar as Migrações**
```
php artisan migrate
```
**Passo 10: Verificar se o Servidor Laravel Está Funcionando**

Acesse: http://localhost:8989/products

**Passo 11: Executar comando artisan para iniciar o scraping**
```
php artisan scrape:products
```

Aguardar até que a mensagem 'Scraping completed.' seja exibida no terminal.

**Passo 12: Acessar banco de dados e verificar na tabela 'products' os dados dos produtos salvos**

Acesse o phpmyadmin em: http://localhost:8080

- Entre com:
   - Usuário: username
   - Senha: userpass
 
**Passo 13: Verificar os novos produtos salvos**

Acesse: http://localhost:8989/products
